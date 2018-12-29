<?php namespace Whip\Lash\Tests\Validators;

/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validators\Password;
use PHPUnit\Framework\TestCase;

/**
 * Class PasswordTest
 *
 * @package \Whip\Lash\Tests\Validators
 * @coversDefaultClass \Whip\Lash\Validators\Password
 */
class PasswordTest extends TestCase
{
    /** @var \Whip\Lash\Validators\Password|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(Password::class)
            ->getMockForTrait();
    }

    /**
     * @covers ::password
     */
    public function testCanPass()
    {
        $passwordFixture = 'abcdefg1!';

        $input = ['confirm' => $passwordFixture];

        $actual = $this->sut->password($passwordFixture, 'confirm', $input);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::password
     */
    public function testCanFailWhenNotLongEnough()
    {
        $passwordFixture = 'a';

        $input = ['confirm' => $passwordFixture];

        $actual = $this->sut->password($passwordFixture, 'confirm', $input);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::password
     */
    public function testCanFailWhenNotContainNumber()
    {
        $passwordFixture = 'abcdefg!';

        $input = ['confirm' => $passwordFixture];

        $actual = $this->sut->password($passwordFixture, 'confirm', $input);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::password
     */
    public function testCanFailWhenNotContainSymbol()
    {
        $passwordFixture = 'abcdefg1';

        $input = ['confirm' => $passwordFixture];

        $actual = $this->sut->password($passwordFixture, 'confirm', $input);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::password
     * @expectedException \Exception
     */
    public function testCanThrowException()
    {
        $input = [];

        $actual = $this->sut->password('wqre', 'confirm', $input);

        $this->assertFalse($actual);
    }
}
