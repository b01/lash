<?php namespace Whip\Lash\Validators;

use PHPUnit\Framework\TestCase;

/**
 * Class BasicTest
 *
 * @package Whip\Lash\Validators
 * @coversDefaultClass \Whip\Lash\Validators\Basic
 */
class BasicTest extends TestCase
{
    /** @var \Whip\Lash\Validators\Basic|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(Basic::class)
            ->getMockForTrait();
    }

    /**
     * @covers ::englishName
     */
    public function testEnglishNameValidates()
    {
        $actual = $this->sut->englishName('Elroy Jr.', 'default')
            && $this->sut->englishName('O\'Conner', 'default');

        $this->assertTrue($actual);
    }

    /**
     * @covers ::englishName
     */
    public function testEnglishNameInvalidatesNumbers()
    {
        $actual = $this->sut->englishName('Conner the 3rd', 'default');

        $this->assertFalse($actual);
    }

    /**
     * @covers ::username
     */
    public function testUsername()
    {
        $actual = $this->sut->username('The_Number1', 'default');

        $this->assertTrue($actual);
    }

    /**
     * @covers ::email
     */
    public function testEmail()
    {
        $actual = $this->sut->email('test@example.com', 'default');

        $this->assertTrue($actual);
    }
}
