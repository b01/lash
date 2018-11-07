<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz.
 */

/**
 * Class Password
 *
 * @package \Whip\Lash\Validators
 */
trait Password
{
    /**
     * @param string $value
     * @param string $constraint
     * @param array $input
     * @return bool
     * @throws \Exception
     */
    public function pass(string $value, string $constraint, & $input) : bool
    {
        if (!\array_key_exists($constraint, $input)) {
            throw new \Exception(
                "Could not find {$constraint} field in the input."
            );
        }

        $confirm = $input[$constraint];

        // at least 8 chars long
        $c1 = \strlen($value) >= 8;
        // at least one digit
        $c2 = \preg_match('/[0-9]/', $value) === 1;
        // at least one symbol;
        $c3 = \preg_match('/[^a-zA-Z0-9]/', $value) === 1;
        // at least one letter;
        $c5 = \preg_match('/[a-zA-Z]/', $value) === 1;
        // matches confirmation entry
        $c4 = \strcmp($confirm, $value) === 0;

        return $c1 && $c2 && $c3 && $c4 && $c5;
    }
}
