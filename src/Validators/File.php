<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validator;

/**
 * Class File
 *
 * @package \Whip\Lash\Validators
 */
trait File
{
    /**
     * Verify a filename contains one of the expected extensions.
     *
     * @param array $extensions
     * @return \Whip\Lash\Validator
     */
    public function ext(array $extensions, string $failMessage) : Validator
    {
        $isMet = false;

        $this->check(__FUNCTION__, $isMet, $failMessage);

        return $this;
    }

    /**
     * Verify a file has the expected size range.
     *
     * @param int $min Minimum file size in bytes.
     * @param int $max Maximum file size in bytes.
     * @return \Whip\Lash\Validator
     */
    public function size(int $min, int $max, string $failMessage) : Validator
    {
        $isMet = false;

        $this->check(__FUNCTION__, $isMet, $failMessage);

        return $this;
    }
}
