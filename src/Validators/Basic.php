<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

/**
 * Trait Basic
 *
 * @package \Whip\Lash\Validators
 */
trait Basic
{
    use RegExp;

    /**
     * Verify that the value is equal to an expected value.
     *
     * @param string $value
     * @param string $constraint A regular expression.
     * @return bool
     */
    public function email(string $value, string $constraint) : bool
    {
        if ($constraint === 'default') {
            // see: https://www.w3.org/TR/2012/WD-html-markup-20120320/input.email.html
            $constraint = '/^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';
        }

        return $this->regex($value, $constraint);
    }

    /**
     * Verify that the value is equal to an expected value.
     *
     * @param string $value
     * @param string $constraint A regular expression.
     * @return bool
     */
    public function englishName(string $value, string $constraint) : bool
    {
        if ($constraint === 'default') {
            $constraint = '/^[a-zA-Z -.\']{1,26}$/';
        }

        return $this->regex($value, $constraint);
    }

    /**
     * Verify that the value is equal to an expected value.
     *
     * @param string $value
     * @param string $constraint A regular expression.
     * @return bool
     */
    public function username(string $value, string $constraint) : bool
    {
        if ($constraint === 'default') {
            $constraint = '/^[a-zA-Z][a-zA-Z0-9-._]*$/';
        }

        return $this->regex($value, $constraint);
    }
}
