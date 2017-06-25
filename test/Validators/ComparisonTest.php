<?php namespace Whip\Lash\Test\Validators;

/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use PHPUnit\Framework\TestCase;
use Whip\Lash\Validators\Comparison;

/**
 * Class ComparisonTest
 *
 * @package \Whip\Lash\Validators
 * @coversDefaultClass \Whip\Lash\Validators\Comparison
 */
class ComparisonTest extends TestCase
{
    /** @var \Whip\Lash\Validators\Comparison|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(Comparison::class)
            ->setMethods(['check'])
            ->getMockForTrait();
    }

    /**
     * @covers ::greaterThan
     */
    public function testGreaterThanPasses()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 1;

        $this->sut->greaterThan(0, __FUNCTION__);
    }

    /**
     * @covers ::greaterThan
     */
    public function testGreaterThanFails()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 1;

        $this->sut->greaterThan(2, __FUNCTION__);
    }

    /**
     * @covers ::lessThan
     */
    public function testLessThanPasses()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 1;

        $this->sut->lessThan(2, __FUNCTION__);
    }

    /**
     * @covers ::lessThan
     */
    public function testLessThanFails()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = 1;

        $this->sut->lessThan(0, __FUNCTION__);
    }
}
