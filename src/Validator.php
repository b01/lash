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
abstract class Validator
{
    /** @var array Errors messages added when validation fails. */
    protected $errors;

    /** @var array Input to be checked against constraints. */
    protected $input;

    /** @var string Subject index in the input. */
    protected $key;

    /** @var array Message to display when assertions fail. */
    protected $messages;

    /** @var mixed Value to assert. */
    protected $subject;

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->errors = [];
        $this->input = [];
        $this->messages = [];
    }

    /**
     * Value to assert meets some conditions.
     *
     * @param string $key
     * @return $this
     */
    public function assert(string $key)
    {
        if (!\array_key_exists($key, $this->input)) {
            throw new \Exception("{$key} was not found in the input array.");
        }

        // We doe not fail gracefully here for the following reasons:
        // 1. Every assertion key should be present in the input array.
        // 2. It could be that some misspelled the key.
        // 3. It could be that the validation is no longer needed.
        // 4. It could be unintentional and just overlooked for removal.
        // 5. Alerts the dev that its missing immediately.

        $this->key = $key;
        $this->subject = $this->input[$key];

        return $this;
    }

    /**
     * @param callable $validator
     * @param string $messageKey
     */
    public function custom(callable $validator, string $messageKey)
    {
        $isMet = $validator($this->subject, $this->key, $this->input);

        $this->check($isMet, $messageKey);

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
     * @param string $method
     * @param bool $isMet
     * @param string $messageKey
     * @return void
     */
    protected function check(bool $isMet, string $messageKey)
    {
        if (!$isMet) {
            $msg = $this->getErrorMessage($messageKey);
            $this->errors[$this->key][] = $msg;
        }
    }

    /**
     * Get an error message from the
     * @param string $messageKey
     * @return mixed
     * @throws \Exception
     */
    protected function getErrorMessage(string $messageKey)
    {
        // We doe not fail gracefully here for 2 reasons:
        // 1. Every assertion should always be supplied a valid fail message via a key.
        // 2. Alert the developer ASAP when one is not present.

        return $this->messages[$messageKey];
    }
}
