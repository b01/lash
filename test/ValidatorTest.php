<?php namespace Whip\Lash\Test;

use PHPUnit\Framework\TestCase;
use Whip\Lash\Validator;

/**
 * Class ValidatorTest
 *
 * @package \Whip\Tests
 * @coversDefaultClass \Whip\Lash\Validator
 */
class ValidatorTest extends TestCase
{
    /**
     * @covers ::validate
     */
    public function testCanValidateValidInput()
    {
        $fixtureInput = [
            'first_name' => 'McTest'
        ];

        $validator = new Validator();

        $validator->setInput($fixtureInput);

        $validator->addValidation('account_name')
            ->length('name must be between 2-26 chars.', 2, 26)
            ->regExp('can only contain spaces & letters.', '/^[a-zA-Z]+$/g');

        $validator->addValidation('balance')
            ->greaterThan('name must be between 2-26 chars.', 2, 26)
            ->regExp('can only contain spaces & letters.', '/^[a-zA-Z]+$/g');

        $errors = $validator->validate();

        $this->assertCount(0, $errors);
    }
}
