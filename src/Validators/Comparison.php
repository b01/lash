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
     * Verify that the subject is greater than an expected value.
     *
     * @param $value
     * @param string $messageKey
     * @return static
     */
    public function greaterThan($value, string $messageKey) : self
    {
        $isMet = $this->subject > $value;

        $this->check($isMet, $messageKey);

        return $this;
    }

    /**
     * Verify the subject is less than an expected value.
     *
     * @param $value
     * @param string $messageKey
     * @return static
     */
    public function lessThan($value, string $messageKey) : self
    {
        $isMet = $this->subject < $value;

        $this->check($isMet, $messageKey);

        return $this;
    }
}