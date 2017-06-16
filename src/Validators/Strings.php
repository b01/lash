<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validator;

/**
 * Trait Strings
 *
 * @package \Whip\Lash\Validators
 */
trait Strings
{
    /**
     * Add string length validation.
     *
     * @param string $failMessage
     * @param int $min
     * @param int|null $max
     * @return \Whip\Lash\Validator
     */
    public function length(
        int $min,
        int $max = null,
        string $failMessage = null
    ) : Validator {

        $len = \strlen($this->subject);

        $isMet = $len < $min || $len > $max;

        $this->check($isMet, $failMessage);

        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultErrorMessages()
    {
        return [
            'length' => '%s name must be between 1-26 chars.'
        ];
    }
}
