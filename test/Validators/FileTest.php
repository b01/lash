<?php namespace Whip\Lash\Test\Validators;

/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validators\File;
use PHPUnit\Framework\TestCase;
use const Whip\Tests\FIXTURES_DIR;

/**
 * Class FileTest
 *
 * @package \Whip\Lash\Test\Validators
 * @coversDefaultClass \Whip\Lash\Validators\File
 */
class FileTest extends TestCase
{
    /** @var \Whip\Lash\Validators\RegExp|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(File::class)
            ->setMethods(['check'])
            ->getMockForTrait();
    }

    /**
     * @covers ::fileEtx
     */
    public function testFileEtxCanPass()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = FIXTURES_DIR . 'file_1.txt';

        $this->sut->fileEtx(['php'],  __FUNCTION__);
    }

    /**
     * @covers ::fileEtx
     */
    public function testFileSizeCanPass()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = FIXTURES_DIR . 'file_1.txt';

        $this->sut->fileSize(1, 8,  __FUNCTION__);
    }
}
