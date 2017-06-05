<?php namespace Whip\Lash;
/**
 * @see LICENSE.md
 */

/**
 * Class Validate
 *
 * @package \Whip\Lash
 */
class Validate
{
    const
        D_KEYS = 'dependencyKeys',
        V_KEY = 'validation';

    /** @var string */
    private $currentSubject;

    /** @var array */
    private $subjects;

    public function addValidation(string $subject, array $dependencyKeys = [])
    {
        $validation = new Validation();
        $this->currentSubject = $subject;
        $this->subjects[$this->currentSubject] = [
            self::D_KEYS => $dependencyKeys,
            self::V_KEY => $validation
        ];

        return $validation;
    }

    public function validate(array $input)
    {
        $errors = [];

        foreach ($this->subjects as $subject => $stuff) {
            $dependencyKeys = $stuff['dependencyKeys'];
            $validation = $stuff['validation'];
        }

        return $errors;
    }
}
