<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validator;

/**
 * Trait RegExp
 *
 * @package \Whip\Lash\Validators
 */
trait RegExp
{

    /**
     * Assert with a regular expression.
     *
     * @param string $pattern
     * @param string $failMessage
     * @return \Whip\Lash\Validator
     * @throws \Exception
     */
    public function regExp(string $pattern, string $failMessage) : Validator
    {
        $result = \preg_match($pattern, $this->subject);

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

        $isMet = (bool) $result === false;
        
        $this->check($isMet, $failMessage);

        return $this;
    }
}
