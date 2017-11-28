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
            ->setMethods(['check'])
            ->getMockForTrait();
    }

    /**
     * @covers ::pass
     */
    public function testCanPass()
    {
        $passwordFixture = 'abcdefg1!';

        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->input = ['confirm' => $passwordFixture];
        $this->sut->subject = $passwordFixture;

        $this->sut->pass('confirm', __FUNCTION__);
    }

    /**
     * @covers ::pass
     */
    public function testCanFailWhenNotLongEnough()
    {
        $passwordFixture = 'a';

        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->input = ['confirm' => $passwordFixture];
        $this->sut->subject = $passwordFixture;

        $this->sut->pass('confirm', __FUNCTION__);
    }

    /**
     * @covers ::pass
     */
    public function testCanFailWhenNotContainNumber()
    {
        $passwordFixture = 'abcdefg!';

        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->input = ['confirm' => $passwordFixture];
        $this->sut->subject = $passwordFixture;

        $this->sut->pass('confirm', __FUNCTION__);
    }

    /**
     * @covers ::pass
     */
    public function testCanFailWhenNotContainSymbol()
    {
        $passwordFixture = 'abcdefg1';

        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->input = ['confirm' => $passwordFixture];
        $this->sut->subject = $passwordFixture;

        $this->sut->pass('confirm', __FUNCTION__);
    }

    /**
     * @covers ::pass
     * @expectedException \Exception
     */
    public function testCanThrowException()
    {
        $this->sut->input = [];

        $this->sut->pass('confirm', __FUNCTION__);
    }
}
