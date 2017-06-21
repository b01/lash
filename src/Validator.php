<?php namespace Whip\Lash;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validators\Comparison;
use Whip\Lash\Validators\File;
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
    use File;
    use RegExp;
    use Strings;

    /** @var array Errors messages added when validation fails. */
    private $errors;

    /** @var array Input to be checked against constraints. */
    private $input;

    /** @var string Subject index in the input. */
    private $key;

    /** @var array Message to display when assertions fail. */
    private $messages;

    /** @var mixed Value to assert. */
    private $subject;

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->errors = [];
        $this->messages = [
            'length' => 'input does not meet string length requirements',
            'regExp' => 'input does not pass set constraints.',
            'greaterThan' => 'input is greater than expected.',
            'lessThan' => 'input is less than expected.',
            'size' => 'does not meet file size requirements.',
            'ext' => 'does not pass extension constraints.',
        ];
    }

    public function __call($name, $arguments)
    {
        if (\array_key_exists($name, $this->validators)) {

        }

        throw new \Exception($name . ' method undefined.');
    }

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
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set error messages for assertions.
     *
     * @param array $messages
     * @return \Whip\Lash\Validator
     */
    public function withErrorMessages(array $messages)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Set input to validate.
     *
     * @param array $input
     * @return \Whip\Lash\Validator
     */
    public function withInput(array $input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * @param bool $isMet
     * @param $failMessage
     */
    private function check(string $method, bool $isMet, $failMessage)
    {
        if (!$isMet) {
            $msg = is_string($failMessage) ? $failMessage : $this->getErrorMessage($method);
            $this->errors[$this->key] = $msg;
        }
    }

    /**
     * @param string $method
     * @return string
     */
    private function getErrorMessage(string $method)
    {
        // We doe not fail gracefully here for 2 reasons:
        // 1. Every assertion method should always have an error message in this array.
        // 2. To alert the the developer ASAP when one is not present.

        return $this->messages[$method];
    }
}
