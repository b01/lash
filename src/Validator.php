<?php namespace Whip\Lash;
/**
 * @see LICENSE.md
 */

/**
 * Class Validator
 *
 * @package \Whip\Lash
 */
class Validator
{
    const
        D_KEYS = 'dependencyKeys',
        V_KEY = 'validation';

    /** @var array Input to be checked against constraints. */
    private $input;

    /** @var array */
    private $subjects;

    public function addValidation(string $subject, array $dependencyKeys = [])
    {
        // Just values that will be used with certain constraints, such as Validation::equalTo
        $dependencies = $this->extractValues($this->input, $dependencyKeys);

        $validation = new Validation($subject, $dependencies);

        $this->subjects[$subject] = $validation;

        return $validation;
    }

    public function validate(array $input)
    {
        $errors = [];

        foreach ($this->subjects as $subject => $stuff) {
            $value = $input[$subject];
            $dependencyKeys = $stuff['dependencyKeys'];
            $validation = $stuff['validation'];

            $validation->run($value, $dependencyKeys);
        }

        return $errors;
    }

    private function extract
}
