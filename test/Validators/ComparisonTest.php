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
            ->getMockForTrait();
    }

    /**
     * @covers ::gt
     */
    public function testGreaterThanPasses()
    {
        $this->sut->subject = 1;

        $actual = $this->sut->gt(1, 0);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::gt
     */
    public function testGreaterThanFails()
    {
        $actual = $this->sut->gt(1, 2);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::lt
     */
    public function testLessThanPasses()
    {
        $actual = $this->sut->lt(1, 2);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::lt
     */
    public function testLessThanFails()
    {
        $actual = $this->sut->lt(1, 0);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::eq
     */
    public function testEqualFails()
    {
        $actual = $this->sut->eq(1, 0);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::eq
     */
    public function testEqualSucceeds()
    {
        $actual = $this->sut->eq(1, 1);

        $this->assertTrue($actual);
    }
}
