<?php namespace Whip\Lash\Test;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

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
     * @covers ::withInput
     */
    public function testCanSetInputToAssert()
    {
        $i = $fixtureInput = [
            'first_name' => 'First',
            'down_payment' => '10000',
            'purchase_price' => '100000',
        ];

        $validator = new Validator();

        $validator->withInput($fixtureInput);

        $validator->assert('first_name')
            ->length(1, 26, 'name must be between 1-26 chars.')
            ->regExp('/^[a-zA-Z]+$/', 'can only contain spaces & letters.');

        $validator->assert('down_payment')
            ->greaterThan(0, 'your down payment must be greater than the purchase price.')
            ->lessThan($i['purchase_price'], 'your down payment must be less than the purchase price.');

        $actual = $validator->getErrors();

        $this->assertCount(0, $actual);
    }

    /**
     * @covers ::withErrorMessages
     * @uses \Whip\Lash\Validator::getErrors
     * @uses \Whip\Lash\Validator::withInput
     */
    public function testCanOverrideDefaultMessage()
    {
        $fixtureInput = [
            'first_name' => ''
        ];

        $fixtureMsg = [
            'length' => 'message override'
        ];

        $validator = new Validator();

        $validator->withErrorMessages($fixtureMsg)
            ->withInput($fixtureInput);

        $validator->assert('first_name')
            ->length(1, 26);

        $actual = $validator->getErrors();

        $this->assertEquals($fixtureMsg[0], $actual[0]);
    }

    /**
     *
     */
    public function testCanUseCustomValidation()
    {
        $i = $fixtureInput = [
            'first_name' => 'First',
            'down_payment' => '10000',
            'purchase_price' => '100000',
        ];

        $validator = new Validator();

        $validator->withInput($fixtureInput);

        $validator->assert('first_name')
            ->length(1, 26, 'name must be between 1-26 chars.')
            ->regExp('/^[a-zA-Z]+$/g', 'can only contain spaces & letters.');

        $validator->assert('down_payment')
            ->greaterThan(0, 'your down payment must be greater than the purchase price.')
            ->lessThan($i['purchase_price'], 'your down payment must be less than the purchase price.');

        $actual = $validator->getErrors();

        $this->assertCount(0, $actual);
    }

    public function testCanOverrideDefaultMessage()
    {
        $fixtureInput = [
            'first_name' => ''
        ];

        $fixtureMsg = [
            'length' => 'message override'
        ];

        $validator = new Validator();

        $validator->withErrorMessages($fixtureMsg)
            ->withInput($fixtureInput);

        $validator->assert('first_name')
            ->length(1, 26);

        $actual = $validator->getErrors();

        $this->assertEquals($fixtureMsg[0], $actual[0]);
    }

    public function testCanUseCustomValidation()
    {
        $fixtureInput = [
            'first_name' => ''
        ];

        $validator = new Validator();

        $validator->withErrorMessages($fixtureMsg)
            ->withInput($fixtureInput);

        $validator->assert('first_name')
            ->length(1, 26);

        $actual = $validator->getErrors();

        $this->assertEquals($fixtureMsg[0], $actual[0]);
    }

    // TODO: Test each validator trait for this.
    public function testCanUseOnTheFlyErrorMessage()
    {
        $fixtureInput = [
            'first_name' => ''
        ];

        $fixtureMsg = 'name must be between 1-26 chars.';

        $validation = new Validator();

        $validation->withInput($fixtureInput);

        $validation->assert('first_name')
            ->length(1, 26, $fixtureMsg);

        $actual = $validation->getErrors();

        $this->assertEquals($fixtureMsg, $actual[0]);
    }
}
