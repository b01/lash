<?php namespace Whip\Lash;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validators\Comparison;
use Whip\Lash\Validators\RegExp;
use Whip\Lash\Validators\Strings;

/**
 * Class Validator
 *
 * All the methods that do the actual assertions are kept as traits in the
 * Validators namespace to keep this class organized.
 *
 * @package \Whip\Lash
 */
class Validator
{
    use Comparison;
    use RegExp;
    use Strings;

    /** @var array Errors messages added when validation fails. */
    private $errors;

    /** @var array Input to be checked against constraints. */
    private $input;

    /** @var string Subject index in the input. */
    private $key;

    /** @var mixed Value to assert. */
    private $subject;

    /** @var array */
    private $subjects;

    /**
     * Value to assert meets some conditions.
     *
     * @param string $key
     * @return $this
     */
    public function assert(string $key)
    {
        if (empty($this->input)) {
            throw new \Exception('Attempting to assert with no input given. Please call withInput first.');
        }

        if (empty($key)) {
            throw new \Exception('The assert first argument must ba a key from the input array.');
        }

        $this->key = $key;
        $this->subject = $this->input[$key];

        return $this;
    }

    /**
     * @param bool $isMet
     * @param $failMessage
     */
    private function check(bool $isMet, $failMessage)
    {
        if (!$isMet) {
            $msg = is_string($failMessage) ? $failMessage : $this->getErrorMessage($this->method);
            $this->errors[$this->key] = $msg;
        }
    }

    /**
     * Set input to validate.
     *
     * @param array $input
     */
    public function withInput(array $input)
    {
        $this->input = $input;
    }

    /**
     * Run all validation.
     *
     * @param array $input
     * @return array
     */
    public function validate(array $input)
    {
        $errors = [];

        foreach ($this->subjects as $subject => $stuff) {
            $value = $input[$subject];
            $dependencyKeys = $stuff['dependencyKeys'];
            $validation = $stuff['validation'];

            $validation->run($value, $dependencyKeys);
        }

        return $errors;
    }

    /**
     * Extract values from an array.
     *
     * @param $input
     * @param $keys
     */
    private function extractValues($input, $keys)
    {
        $values = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $input)) {
                $values[$key] = $input[$key];
            }
        }
    }
}
