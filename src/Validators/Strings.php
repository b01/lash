<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

/**
 * Trait Strings
 *
 * @package \Whip\Lash\Validators
 */
trait Strings
{
    /**
     * Check string length.
     *
     * @param string $messageKey
     * @param int $min
     * @param int $max
     * @return static
     */
    public function strLen(int $min, int $max, string $messageKey) : self
    {
        $len = \strlen($this->subject);

        $isMet = $len >= $min && $len <= $max;

        $this->check($isMet, $messageKey);

        return $this;
    }

    /**
     * @param int $min
     * @param string|null $messageKey
     * @return static
     */
    public function minStrLen(int $min, string $messageKey) : self
    {
        $len = \strlen($this->subject);

        $isMet = $len >= $min;

        $this->check($isMet, $messageKey);

        return $this;
    }

    /**
     * @param int $max
     * @param string|null $messageKey
     * @return static
     */
    public function maxStrLen(int $max, string $messageKey) : self
    {
        $len = \strlen($this->subject);

        $isMet = $len <= $max;

        $this->check($isMet, $messageKey);

        return $this;
    }
}
