<?php namespace Whip\Lash\Test;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validation;
use PHPUnit\Framework\TestCase;

/**
 * Class ValidationTest
 *
 * @package \Whip\Lash\Test
 * @coversDefaultClass \Whip\Lash\Validator
 */
class ValidationTest extends TestCase
{

    /**
     * @covers ::__construct
     */
    public function testCanConstructWithNoConfiguration()
    {
        $actual = new Validation();

        $this->assertInstanceOf(Validation::class, $actual);
    }

    /**
     * @covers ::withInput
     * @covers ::assert
     * @covers ::getErrors
     * @uses \Whip\Lash\Validator::__construct
     * @uses \Whip\Lash\Validator::withErrorMessages
     * @uses \Whip\Lash\Validator::check
     */
    public function testCanSetInputToAssert()
    {
        $validation = new Validation();

        $nput = [
            'fname' => 'First',
        ];
        $messages = [
            'fname' => 'name must be between 1-26 chars.',
            'fname_re' => 'can only contain spaces & letters.'
        ];

        $validation->withInput($nput)
            ->withErrorMessages($messages);

        $validation->assert('fname')
            ->strLen(1, 26, 'fname')
            ->regExp('/^[a-zA-Z]+$/', 'fname_re');

        $errors = $validation->getErrors();

        $this->assertCount(0, $errors);
    }

    /**
     * @covers ::withErrorMessages
     * @covers ::check
     * @covers ::getErrorMessage
     * @covers ::getErrors
     * @uses \Whip\Lash\Validator::withInput
     * @uses \Whip\Lash\Validator::assert
     */
    public function testCanOverrideDefaultMessage()
    {
        $key = 'fname';

        $fixtureInput = [
            $key => ''
        ];

        $fixtureMsgs = [
            $key => 'message override'
        ];

        $validation = new Validation();

        $validation->withErrorMessages($fixtureMsgs)
            ->withInput($fixtureInput);

        $validation->assert($key)
            ->strLen(1, 26, $key);

        $actual = $validation->getErrors();

        $this->assertEquals($fixtureMsgs[$key], $actual[$key][0]);
    }

    /**
     * @covers ::custom
     * @uses \Whip\Lash\Validator::__construct
     * @uses \Whip\Lash\Validator::withErrorMessages
     * @uses \Whip\Lash\Validator::withInput
     * @uses \Whip\Lash\Validator::assert
     * @uses \Whip\Lash\Validator::check
     * @uses \Whip\Lash\Validator::getErrors
     */
    public function testCanUseCustomValidation()
    {
        $key = 'fname';
        $fixtureInput = [
            $key => ''
        ];
        $fixtureMessages = [
            $key => 'custom message'
        ];
        $validation = new Validation();

        $validation->withErrorMessages($fixtureMessages)
            ->withInput($fixtureInput);

        $validation->assert($key)
            ->custom(function () {
                return false;
            }, $key);

        $actual = $validation->getErrors();

        $this->assertEquals($fixtureMessages[$key], $actual[$key][0]);
    }
}
