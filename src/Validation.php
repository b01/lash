<?php namespace Whip\Lash;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

/**
 * Class Validation
 */
class Validation
{
    /** @var string The subject to be validated. */
    private $subject;

    /** @var array Values needed to perform validation. */
    private $dependencies;

    /**
     * Validation constructor.
     *
     * @param string $subject
     * @param array $dependencies
     */
    public function __construct(string $subject, array $dependencies = null)
    {
        $this->subject = $subject;
        $this->dependencies = $dependencies;
    }
}
