<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

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
     * @param string $messageKey
     * @return bool
     */
    public function fileExt($value, array $constraint) : bool
    {
        $regex = '/(' . \implode('|', $constraint) . ')$/';
        $pattern = \trim($regex, '|');

        return \preg_match($pattern, $value) === 1;
    }

    /**
     * Verify a file size is within (inclusive) an expected range.
     *
     * @param string $value path to a file.
     * @param array $constraint the min and Maximum file size in bytes.
     * @return bool
     */
    public function fileSize(string $value, $constraint) : bool
    {
        $stats = \stat($value);
        $fileSize = $stats['size'];

        return $fileSize >= $constraint[0] && $fileSize <= $constraint[1];
    }
}
