<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

/**
 * Trait Comparison
 *
 * @package \Whip\Lash\Validators
 */
trait Comparison
{
    /**
     * Verify that the value is greater than an expected value.
     *
     * @param $value
     * @param $constraint
     * @return bool
     */
    public function gt($value, $constraint) : bool
    {
        return $value > $constraint;
    }

    /**
     * Verify the subject is less than an expected value.
     *
     * @param $value
     * @param string $constraint
     * @return bool
     */
    public function lt($value, $constraint) : bool
    {
        return $value < $constraint;
    }
}
