<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

/**
 * Class FileUpload
 *
 * @package \Whip\Lash\Validators
 */
trait FileUpload
{
    /**
     * Verify a filename contains one of the expected extensions.
     *
     * @param array $extensions
     * @param string $messageKey
     * @return static
     */
    public function uploadHasExt($value, array $constraint) : bool
    {
        $regex = '/(' . \implode('|', $constraint) . ')$/';
        $pattern = \trim($regex, '|');

        return \preg_match($pattern, $value->getClientFilename());
    }

    /**
     *
     * @param $value
     * @param string $pattern
     * @return bool
     */
    public function uploadName($value, string $pattern) : bool
    {
        $filename = \basename($value->getClientFilename());

        return \preg_match($pattern, $filename) === 1;
    }

    /**
     * Verify a file size is within (inclusive) an expected range.
     *
     * @param $value
     * @param array $constraint
     * @return bool
     */
    public function uploadHasSize($value, array $constraint) : bool
    {
        $fileSize = $value->getSize();

        return $fileSize >= $constraint[0] && $fileSize <= $constraint[1];
    }
}
