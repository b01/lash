<?php namespace Whip\Lash\Validators;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Psr\Http\Message\UploadedFileInterface;

/**
 * Class FileUpload
 *
 * @package \Whip\Lash\Validators
 */
trait FileUpload
{
    /**
     * @param string $value
     * @param array $constraint
     * @return bool
     */
    public function upload(UploadedFileInterface $value, array $constraint) : bool
    {
        return $this->uploadHasExt($value, $constraint[0])
            && $this->uploadHasSize($value, $constraint[1])
            && $this->uploadName($value, '/^[a-zA-Z0-9._-]+$/');
    }

    /**
     * Verify a filename contains one of the expected extensions.
     *
     * @param array $extensions
     * @param string $messageKey
     * @return static
     */
    public function uploadHasExt(
        UploadedFileInterface $value,
        array $constraint
    ) : bool {
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
    public function uploadName(
        UploadedFileInterface $value,
        string $pattern
    ) : bool {
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
    public function uploadHasSize(
        UploadedFileInterface $value,
        array $constraint
    ) : bool {
        $fileSize = $value->getSize();

        return $fileSize >= $constraint[0] && $fileSize <= $constraint[1];
    }
}
