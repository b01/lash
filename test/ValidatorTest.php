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
    /** @var \Whip\Lash\Validator|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    public function setUp()
    {
        $this->sut = $this->getMockForAbstractClass(Validator::class);
    }

    /**
     * @covers ::__construct
     */
    public function testCanConstructWithNoConfiguration()
    {
        $this->assertInstanceOf(Validator::class, $this->sut);
    }

    /**
     * @covers ::withInput
     * @covers ::assert
     * @covers ::getErrors
     * @uses \Whip\Lash\Validator::__construct
     * @uses \Whip\Lash\Validator::check
     */
    public function testCanSetInputToAssert()
    {
        $fixtureInput = [
            'fname' => 'First',
        ];
        $validator = $this->sut;

        $validator->withInput($fixtureInput);

        $validator->assert('fname')
            ->custom(function () {
                return true;
            }, '');

        $actual = $validator->getErrors();

        $this->assertCount(0, $actual);
    }

    /**
     * @covers ::assert
     * @covers ::getErrors
     * @uses \Whip\Lash\Validator::__construct
     * @uses \Whip\Lash\Validator::check
     * @uses \Whip\Lash\Validator::withInput
     * @expectedException \Exception
     * @expectedExceptionMessage fname was not found in the input array.
     */
    public function testCannotAssertUndefinedIndex()
    {
        $fixtureInput = [];
        $validator = $this->sut;

        $validator->withInput($fixtureInput);

        $validator->assert('fname')
            ->custom(function () {
                return true;
            }, '');

        $actual = $validator->getErrors();

        $this->assertCount(0, $actual);
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

        $validator = $this->sut;

        $validator->withErrorMessages($fixtureMsgs)
            ->withInput($fixtureInput);

        $validator->assert($key)
            ->custom(function () {
                return false;
            }, $key);

        $actual = $validator->getErrors();

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
        $validator = $this->sut;

        $validator->withErrorMessages($fixtureMessages)
            ->withInput($fixtureInput);

        $validator->assert($key)
            ->custom(function () {
                return false;
            }, $key);

        $actual = $validator->getErrors();

        $this->assertEquals($fixtureMessages[$key], $actual[$key][0]);
    }

    /**
     * @covers ::assertOptional
     * @uses \Whip\Lash\Validator::__construct
     * @uses \Whip\Lash\Validator::withErrorMessages
     * @uses \Whip\Lash\Validator::withInput
     * @uses \Whip\Lash\Validator::custom
     * @uses \Whip\Lash\Validator::getErrors
     * @uses \Whip\Lash\Validator::check
     */
    public function testCanAssertOptionalFieldWhenPresent()
    {
        $key = 'ofield';
        $fixtureInput = [
            $key => 'hasValue'
        ];
        $fixtureMessages = [
            $key => 'custom message'
        ];

        $this->sut->withErrorMessages($fixtureMessages)
            ->withInput($fixtureInput)
            ->assertOptional($key)
            ->custom(function () {
                return false;
            }, $key);

        $actual = $this->sut->getErrors();

        $this->assertEquals($fixtureMessages[$key], $actual[$key][0]);
    }

    /**
     * @covers ::assertOptional
     * @uses \Whip\Lash\Validator::__construct
     * @uses \Whip\Lash\Validator::withInput
     * @uses \Whip\Lash\Validator::custom
     * @uses \Whip\Lash\Validator::getErrors
     * @uses \Whip\Lash\Validator::check
     */
    public function testWillNotAssertAnOptionalFieldWhenMissing()
    {
        $key = 'ofield';
        $fixtureInput = [];

        $this->sut->withInput($fixtureInput)
            ->assertOptional($key)
            ->custom(function () {
                return false;
            }, $key);

        $actual = $this->sut->getErrors();

        $this->assertEmpty($actual);
    }

    /**
     * @covers ::assertOptional
     * @uses \Whip\Lash\Validator::__construct
     * @uses \Whip\Lash\Validator::withErrorMessages
     * @uses \Whip\Lash\Validator::withInput
     * @uses \Whip\Lash\Validator::assert
     * @uses \Whip\Lash\Validator::check
     * @uses \Whip\Lash\Validator::custom
     * @uses \Whip\Lash\Validator::getErrors
     */
    public function testWillNotAssertAnOptionalFieldWhenPresentButEmpty()
    {
        $key = 'ofield';
        $fixtureInput = [
            $key => ''
        ];
        $fixtureMessages = [
            $key => 'custom message'
        ];
        $validator = $this->sut;

        $validator->withErrorMessages($fixtureMessages)
            ->withInput($fixtureInput)
            ->assertOptional($key)
            ->custom(function () {
                return false;
            }, $key);

        $actual = $validator->getErrors();

        $this->assertEmpty($actual);
    }
}
