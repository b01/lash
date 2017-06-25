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
     * @return static
     */
    public function fileEtx(array $extensions, string $messageKey) : self
    {
        $regex = '/(' . \implode('|', $extensions) . ')$/';
        $pattern = \trim($regex, '|');

        $isMet = \preg_match($pattern, $this->subject);

        $this->check($isMet, $messageKey);

        return $this;
    }

    /**
     * Verify a file has the expected size range.
     *
     * @param int $min Minimum file size in bytes.
     * @param int $max Maximum file size in bytes.
     * @param string $messageKey
     * @return static
     */
    public function fileSize(int $min, int $max, string $messageKey) : self
    {
        $isMet = false;

        $this->check($isMet, $messageKey);

        return $this;
    }
}
