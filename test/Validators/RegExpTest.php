<?php namespace Whip\Lash\Test\Validators;

/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validators\RegExp;
use PHPUnit\Framework\TestCase;

/**
 * Class RegExpTest
 *
 * @package \Whip\Lash\Test\Validators
 * @coversDefaultClass \Whip\Lash\Validators\RegExp
 */
class RegExpTest extends TestCase
{
    /** @var \Whip\Lash\Validators\RegExp|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(RegExp::class)
            ->setMethods(['check'])
            ->getMockForTrait();
    }

    /**
     * @covers ::regExp
     */
    public function testCanPass()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 'a';

        $this->sut->regExp('/[a-z]/', __FUNCTION__);
    }

    /**
     * @covers ::regExp
     */
    public function testCanFail()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = '1';

        $this->sut->regExp('/[a-z]/', __FUNCTION__);
    }

    /**
     * @covers ::regExp
     * @expectedException \Exception
     */
    public function testCanThrowException()
    {
        $this->sut->subject = 'a';

        $this->sut->regExp('/[a-z/', __FUNCTION__);
    }
}
