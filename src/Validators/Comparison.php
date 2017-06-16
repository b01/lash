<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validator;

/**
 * Trait Comparison
 *
 * @package \Whip\Lash\Validators
 */
trait Comparison
{
    /**
     * Verify that the subject is greater than an expected value.
     *
     * @param $value
     * @param string $failMessage
     * @return \Whip\Lash\Validator
     */
    public function greaterThan($value, string $failMessage = null) : Validator
    {
        $isMet = $this->subject > $value;

        $this->check(__FUNCTION__, $isMet, $failMessage);

        return $this;
    }

    /**
     * Verify the subject is less than an expected value.
     *
     * @param $value
     * @param string $failMessage
     * @return \Whip\Lash\Validator
     */
    public function lessThan($value, string $failMessage = null) : Validator
    {
        $isMet = $this->subject < $value;

        $this->check(__FUNCTION__, $isMet, $failMessage);

        return $this;
    }
}