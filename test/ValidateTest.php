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

        $validate->addValidation('first_name')
            ->length('name be be between 2-26 chars.', 2, 26)
            ->regExp('can only contain letters.', '/^[a-zA-Z]/g');

        $errors = $validate->validate($fixtureInput);

        $this->assertCount(0, $errors);
    }
}
