<?php namespace Whip\Lash;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz.
 */

use Whip\Lash\Validators\Basic;
use Whip\Lash\Validators\Comparison;
use Whip\Lash\Validators\File;
use Whip\Lash\Validators\FileUpload;
use Whip\Lash\Validators\Password;
use Whip\Lash\Validators\RegExp;

/**
 * Class Validation
 * If you need to mock this class, just mock the \Whip\Lash\Validator interface,
 * which should server the same purpose.
 *
 * @package \Whip\Lash
 */
final class Validation implements Validator
{
    use Basic, File, RegExp {
        RegExp::regex insteadof Basic, File;
    }
    use Comparison;
    use FileUpload;
    use Password;

    const RULE_IDX_CUSTOM = '0';
    const RULE_IDX_CONSTRAINT = '1';
    const RULE_IDX_ERR_MSG = '2';
    const RULE_IDX_MASK = '3';
    const RULE_IDX_VALIDATOR = '0';

    const RULE_KEY_CONSTRAINT = 'constraint';
    const RULE_KEY_CUSTOM = 'custom';
    const RULE_KEY_ERR_MSG = 'err';
    const RULE_KEY_MASK = 'mask';
    const RULE_KEY_VALIDATOR = 'validator';
    const RULE_NAME_REGEX = '/^[a-zA-Z][a-zA-Z0-9-._]*$/';
    const DEFAULT_ERR_MSG = 'Could not validate %1$s = %2$s against validator "%3$s" with a constraint of "%4$s".';

    /** @var array A custom validation method. */
    private $customValidators;

    /** @var array Error messages from failing validation. */
    private $errors;

    /** @var array Map of fields to rules. */
    private $rules;

    /**
     * Validation constructor
     */
    public function __construct()
    {
        $this->rules = [];
        $this->errors = [];
        $this->customValidators = [];
    }

    /**
     * @inheritdoc
     */
    public function addCustomValidator(string $name, callable $validator) : Validator
    {
        $this->customValidators[$name] = $validator;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addRule(
        string $name,
        string $validator,
        $constraints,
        string $err = self::DEFAULT_ERR_MSG,
        bool $mask = false
    ) : bool {
        if (\preg_match(self::RULE_NAME_REGEX, $name) !== 1) {
            throw new \Exception("Trying to add a rule with an invalid name: \"{$name}\"");
        }

        // Don't allow accidental empty error messages.
        // Force the end-user to use a simple "-" to purposely remove an error.
        if ($err === '-') {
            $err = '';
        } else if (empty(\trim($err))) {
            $err = self::DEFAULT_ERR_MSG;
        }

        $this->rules[$name] = [
            self::RULE_KEY_VALIDATOR => $validator,
            self::RULE_KEY_CONSTRAINT => $constraints,
            self::RULE_KEY_ERR_MSG => $err,
            self::RULE_KEY_MASK => $mask
        ];

        return true;
    }

    /**
     * @inheritdoc
     */
    public function addRules(array $rules) : int
    {
        $counter = 0;
        $i = -1;

        // It is on purpose that there is no checking if the key exists in the
        // rules array so that your program fails immediately and you find out
        // ASAP so that you can correct it.
        // In other words, it should prevent you from ever adding invalid rules.
        foreach ($rules as $name => $rule) {
            $i++;
            $this->throwOnMissingKey($rule, $i);

            $validator = \array_key_exists(self::RULE_KEY_CUSTOM, $rule)
                ? $rule[self::RULE_KEY_CUSTOM]
                : $rule[self::RULE_KEY_VALIDATOR];

            // side-effect of allowing custom validation to be adding
            // when using this method.
            if (\array_key_exists(self::RULE_KEY_CUSTOM, $rule)) {
                $this->addCustomValidator($validator, $rule[self::RULE_KEY_CONSTRAINT]);
            }

            $added = $this->addRule(
                $name,
                $validator,
                $rule[self::RULE_KEY_CONSTRAINT],
                $rule[self::RULE_KEY_ERR_MSG],
                \array_key_exists(self::RULE_KEY_MASK, $rule)
            );

            if ($added) {
                $counter += 1;
            }
        }

        return $counter;
    }

    /**
     * @inheritdoc
     */
    public function addRulesByIndex(array $rules) : int
    {
        $counter = 0;
        $i = -1;

        foreach ($rules as $name => $rule) {
            $i++;
            $this->throwOnMissingIndex($rule, $i, $name);

            $added = $this->addRule(
                $name,
                $rule[self::RULE_IDX_VALIDATOR],
                $rule[self::RULE_IDX_CONSTRAINT],
                $rule[self::RULE_IDX_ERR_MSG],
                \array_key_exists(self::RULE_IDX_MASK, $rule)
            );

            if ($added) {
                $counter += 1;
            }
        }

        return $counter;
    }

    /**
     * @inheritdoc
     */
    public function getErrors() : array
    {
        return $this->errors;
    }

    /**
     * @inheritdoc
     */
    public function validate(array $values) : bool
    {
        $rV = true;

        foreach ($values as $name => $value) {
            $rule = $this->getRule($name);
            $validator = $rule[self::RULE_KEY_VALIDATOR];
            $constraint = $rule[self::RULE_KEY_CONSTRAINT];

            // Get the validation method.
            if (\method_exists($this, $validator)) {
                $callable = [$this, $validator];
            } else if (\array_key_exists($validator, $this->customValidators)) {
                $callable = $this->customValidators[$validator];
            } else {
                throw new \Exception("Could not find the validator \"{$validator}\"");
            }

            // TODO: Decide if the value should be passed by reference to the validator so that filters/modifications can be applied.
            // Validate the value.
            $result = \call_user_func_array($callable, [$value, $constraint, $values]);

            if ($result === true) {
                continue;
            }

            $rV = false;
            $cValue = $rule[self::RULE_KEY_MASK]
                ? '*'
                : $value;

            $this->errors[$name] = \sprintf(
                $rule[self::RULE_KEY_ERR_MSG],
                $name,
                $cValue,
                \print_r($validator, true),
                \print_r($constraint, true)
            );
        }

        return $rV;
    }

    /**
     * Return a rule from the list of rules stored.
     *
     * @internal
     * @param string $name
     * @return array
     * @throws \Exception
     */
    private function getRule(string $name)
    {
        if (empty($name) || !\array_key_exists($name, $this->rules)) {
            throw new \Exception("No rule found matching the name \"{$name}\"", 2);
        }

        $rV = $this->rules[$name];

        return $rV;
    }

    /**
     * Validate a number is within a range.
     *
     * @param $value
     * @param array $constraint
     * @return bool
     */
    private function range($value, array $constraint)
    {
        return $value >= $constraint[0] && $value <= $constraint[1];
    }

    /**
     * Validate an item is part of set.
     *
     * @param string $value
     * @param array $constraint
     * @return bool
     */
    private function inSet(string $value, array $constraint)
    {
        return \in_array($value, $constraint);
    }

    /**
     * Validate a string is as long as a specified length.
     *
     * @param string $value
     * @param int $constraint
     * @return bool
     */
    private function length(string $value, int $constraint)
    {
        return \strlen($value) >= $constraint;
    }

    /**
     * @param array $rule
     * @param int $i
     * @throws \Exception
     */
    private function throwOnMissingKey(array $rule, int $i) : void
    {
        $message = 'Missing "%s" key at rule index %s';

        // TODO: Dry this code out.
        if (!\array_key_exists(self::RULE_KEY_VALIDATOR, $rule)
            && !\array_key_exists(self::RULE_KEY_CUSTOM, $rule)) {
            $message = \sprintf($message, self::RULE_KEY_VALIDATOR, $i);
            throw new \Exception($message);
        }

        if (!\array_key_exists(self::RULE_KEY_CONSTRAINT, $rule)) {
            $message = \sprintf($message, self::RULE_KEY_CONSTRAINT, $i);
            throw new \Exception($message);
        }

        if (!\array_key_exists(self::RULE_KEY_ERR_MSG, $rule)) {
            $message = \sprintf($message, self::RULE_KEY_ERR_MSG, $i);
            throw new \Exception($message);
        }
    }

    /**
     * @param array $rule
     * @param int $i
     * @throws \Exception
     */
    private function throwOnMissingIndex(array $rule, int $i, $name) : void
    {
        $message = 'Missing "%s" index at rule index %s';

        // TODO: Dry this code out.
        if (!\array_key_exists(self::RULE_IDX_VALIDATOR, $rule)) {
            $message = \sprintf($message, self::RULE_IDX_VALIDATOR, $name);
            throw new \Exception($message);
        }

        if (!\array_key_exists(self::RULE_IDX_CONSTRAINT, $rule)) {
            $message = \sprintf($message, self::RULE_IDX_CONSTRAINT, $i);
            throw new \Exception($message);
        }

        if (!\array_key_exists(self::RULE_IDX_ERR_MSG, $rule)) {
            $message = \sprintf($message, self::RULE_IDX_ERR_MSG, $i);
            throw new \Exception($message);
        }
    }
}