<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

/**
 * Class Password
 *
 * @package \Whip\Lash\Validators
 */
trait Password
{
    /**
     * @param string|null $messageKey
     * @return static
     */
    public function pass(string $compare, string $messageKey) : self
    {
        if (!\array_key_exists($compare, $this->input)) {
            throw new \Exception(
                "Could not find ${compare} field in the input."
            );
        }

        $confirm = $this->input[$compare];

        // at least 8 chars long
        $c1 = \strlen($this->subject) >= 8;
        // at least one digit
        $c2 = 1 === @\preg_match('/[0-9]/', $this->subject);
        // at least one symbol;
        $c3 = 1 === @\preg_match('/[^a-zA-z0-9]/', $this->subject);
        // matches confirmation entry
        $c4 = \strcmp($confirm, $this->subject) === 0;

        $isMet = $c1 && $c2 && $c3 && $c4;

        $this->check($isMet, $messageKey);

        return $this;
    }
}
