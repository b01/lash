<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

/**
 * Trait RegExp
 *
 * @package \Whip\Lash\Validators
 */
trait RegExp
{
    /**
     * @param string|null $messageKey
     * @return static
     */
    public function email(string $messageKey) : self
    {
        // see: https://www.w3.org/TR/2012/WD-html-markup-20120320/input.email.html
        $exp = '/^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';

        return $this->regExp($exp, $messageKey);
    }

    /**
     * @param string|null $messageKey
     * @return static
     */
    public function name(string $messageKey) : self
    {
        return $this->regExp('/^[a-zA-Z]+$/', $messageKey);
    }

    /**
     * @param string|null $messageKey
     * @return static
     */
    public function username(string $messageKey) : self
    {
        return $this->regExp(
            '/^[a-zA-Z][a-zA-Z0-9]{3,26}$/',
            $messageKey
        );
    }

    /**
     * Assert with a regular expression.
     *
     * @param string $pattern
     * @param string $messageKey Error message key to lookup in the list of error messages.
     * @return static
     * @throws \Exception
     */
    public function regExp(string $pattern, string $messageKey) : self
    {
        $result = @\preg_match($pattern, $this->subject);

        if ($result === false) {
            // Get the name of the constant for the error code.
            $errorConstName = \array_flip(\get_defined_constants(true)['pcre'])[\preg_last_error()];
            $errorMessage = 'There may is a problem with the regex, and the'
                . " subject cannot be validated.\n"
                . "\tregex error: {$errorConstName}\n"
                . "\tsubject: {$this->subject}\n"
                . "\tpattern: {$pattern}";
            throw new \Exception($errorMessage);
        }

        $isMet = $result === 1;

        $this->check($isMet, $messageKey);

        return $this;
    }
}
