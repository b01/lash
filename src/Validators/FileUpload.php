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
    public function uploadHasExt(array $extensions, string $messageKey) : self
    {
        $regex = '/(' . \implode('|', $extensions) . ')$/';
        $pattern = \trim($regex, '|');

        $isMet = \preg_match($pattern, $this->subject->getClientFilename());

        $this->check($isMet, $messageKey);

        return $this;
    }

    /**
     * @param string $pattern
     * @param string $messageKey
     * @return static
     */
    public function uploadName(string $pattern, string $messageKey) : self
    {
        $filename = basename($this->subject->getClientFilename());

        $isMet = \preg_match($pattern, $filename);

        $this->check($isMet, $messageKey);

        return $this;
    }

    /**
     * Verify a file size is within (inclusive) an expected range.
     *
     * @param int $min Minimum file size in bytes.
     * @param int $max Maximum file size in bytes.
     * @param string $messageKey
     * @return static
     */
    public function uploadHasSize(int $min, int $max, string $messageKey) : self
    {
        $fileSize = $this->subject->getSize();
        $isMet = $fileSize >= $min && $fileSize <= $max;

        $this->check($isMet, $messageKey);

        return $this;
    }
}
