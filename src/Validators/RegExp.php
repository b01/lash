<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz.
 */

/**
 * Class RegExp
 *
 * @package Whip\Lash\Validators
 */
trait RegExp
{
    /**
     * @param string $value
     * @param string $constraint
     * @return bool
     * @throws \Exception
     */
    private function regex(string $value, string $constraint)
    {
        try {
            $rV = \preg_match($constraint, $value);
        } catch (\Exception $err) {
            $errMsg = $err->getMessage();
            // Get the name of the constant for the error code.
            $pcreConst = \get_defined_constants(true)['pcre'];
            $lastErr = \preg_last_error();
            $errorConstName = \array_flip($pcreConst)[$lastErr];
            $message = 'There may is a problem with the regex, and the'
                . " subject cannot be validated.\n"
                . "\tregex error: {$errorConstName}\n"
                . "\tsubject: {$value}\n"
                . "\tpattern: {$constraint}"
                . "\terror message: {$errMsg}";

            throw new \Exception($message);
        }

        return $rV === 1;
    }
}
