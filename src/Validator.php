<?php namespace Whip\Lash;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

/**
 * Class Validator
 *
 * All the methods that do the actual assertions are kept as traits in the
 * Validators namespace to keep this class organized.
 *
 * @package \Whip\Lash
 */
interface Validator
{
    /**
     * Add your own custom validation.
     *
     * @param string $name
     * @param callable $validator
     * @return static
     */
    public function addCustomValidator(string $name, callable $validator) : Validator;

    /**
     * Add a rule for a named value (ex, a name can be a field in a form post).
     *
     * NOTE: Rules can contain the following keys:
     *  * self::RULE_KEY_VALIDATOR - The name of a validator. Will throw an
     *  \Exception when missing.
     *  * self::RULE_KEY_CONSTRAINT - The matching constraint fo the validator.
     *  Will throw an \Exception when missing.
     *  * self::RULE_KEY_ERR - An error message when the value does not meet the
     *  constraint. Will use the default error message for the validator when
     *  missing.
     *
     * @param string $name
     * @param string $validator
     * @param mixed $constraints
     * @param string $err
     * @return bool
     * @throws \Exception
     */
    public function addRule(
        string $name,
        string $validator,
        $constraints,
        string $err
    ) : bool;

    /**
     * Add multiple rules to validate named values.
     *
     * NOTE: When adding rules this way, the "err" key in the rules is REQUIRED.
     *
     * @see $this->addRule()
     * @param array $rules
     * @return int
     * @throws \Exception
     */
    public function addRules(array $rules) : int;

    /**
     * Add rules via an index instead of a key. The index has a specific order:
     * 0 = self::RULE_IDX_VALIDATOR
     * 1 = self::RULE_IDX_CONSTRAINT
     * 2 = self::RULE_IDX_ERR_MSG
     * 3 = self::RULE_IDX_MASK
     *
     * WARNING: Please make sure your elements are in the correct order or
     * proper validation cannot be guaranteed.
     *
     * @param array $rules
     * @return int
     * @throws \Exception
     */
    public function addRulesByIndex(array $rules) : int;

    /**
     * Get the errors for fields that failed validation.stringLen
     *
     * @return array
     */
    public function getErrors() : array;

    /**
     * @param array $values
     * @return bool
     * @throws \Exception
     */
    public function validate(array $values) : bool;
}
