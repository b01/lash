<?php namespace Whip\Lash\Tests\Validators;

/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use PHPUnit\Framework\TestCase;
use Whip\Lash\Validators\Strings;

/**
 * Class StringsTest
 *
 * @package \Whip\Lash\Tests\Validators
 * @coversDefaultClass \Whip\Lash\Validators\Strings
 */
class StringsTest extends TestCase
{
    /** @var \Whip\Lash\Validators\Strings|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(Strings::class)
            ->setMethods(['check'])
            ->getMockForTrait();
    }

    /**
     * @covers ::strlen
     */
    public function testCanAssertLengthInBounds()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 'a';

        $this->sut->strLen(1, 2, __FUNCTION__);
    }

    /**
     * @covers ::strlen
     */
    public function testCanAssertLengthUnderBounds()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = '';

        $this->sut->strLen(1, 2, __FUNCTION__);
    }

    /**
     * @covers ::strlen
     */
    public function testCanAssertLengthOverBounds()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 'abc';

        $this->sut->strLen(1, 2, __FUNCTION__);
    }

    /**
     * @covers ::minStrLen
     */
    public function testCanAssertMinLengthInBounds()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 'abc';

        $this->sut->minStrLen(1, __FUNCTION__);
    }

    /**
     * @covers ::minStrLen
     */
    public function testCanAssertMinLengthUnderBounds()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = '';

        $this->sut->minStrLen(1, __FUNCTION__);
    }

    /**
     * @covers ::maxStrLen
     */
    public function testCanAssertMaxLengthInBounds()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 'a';

        $this->sut->maxStrLen(1, __FUNCTION__);
    }

    /**
     * @covers ::maxStrLen
     */
    public function testCanAssertMaxLengthOverBounds()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 'ab';

        $this->sut->maxStrLen(1, __FUNCTION__);
    }
}
