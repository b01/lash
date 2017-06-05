<?php namespace Whip\Lash;
/**
 * @see LICENSE.md
 */

/**
 * Class Validation
 */
class Validation
{
    /**
     * Add string length validation.
     *
     * @param string $failMessage
     * @param int $min
     * @param int|null $max
     * @return \Whip\Lash\Validation
     */
    public function length(string $failMessage, int $min, int $max = null) : Validation
    {
        return $this;
    }

    /**
     * Add regular expression validation.
     *
     * @param string $failMessage
     * @param string $regExp
     * @return \Whip\Lash\Validation
     */
    public function regExp(string $failMessage, string $regExp) : Validation
    {
        return $this;
    }
}
