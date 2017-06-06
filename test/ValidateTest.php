<?php namespace Whip\Lash\Test;

use PHPUnit\Framework\TestCase;
use Whip\Lash\Validate;

/**
 * Class ValidateTest
 *
 * @package \Whip\Tests
 * @coversDefaultClass \Whip\Lash\Validate
 */
class ValidateTest extends TestCase
{
    /**
     * @covers ::validate
     */
    public function testCanValidateValidInput()
    {
        $fixtureInput = [
            'first_name' => 'McTest'
        ];

        $validate = new Validate();

        $validate->setInput($fixtureInput);

        $validate->addValidation('account_name')
            ->length('name must be between 2-26 chars.', 2, 26)
            ->regExp('can only contain spaces & letters.', '/^[a-zA-Z]+$/g');

        $validate->addValidation('balance')
            ->length('name must be between 2-26 chars.', 2, 26)
            ->regExp('can only contain spaces & letters.', '/^[a-zA-Z]+$/g');

        $errors = $validate->validate();

        $this->assertCount(0, $errors);
    }
}
