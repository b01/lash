<?php namespace Whip\Lash\Test\Validators;

/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validators\File;
use PHPUnit\Framework\TestCase;

use const Whip\Lash\Test\FIXTURES_DIR;
/**
 * Class FileTest
 *
 * @package \Whip\Lash\Test\Validators
 * @coversDefaultClass \Whip\Lash\Validators\File
 */
class FileTest extends TestCase
{
    /** @var \Whip\Lash\Validators\File|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(File::class)
            ->setMethods(['check'])
            ->getMockForTrait();
    }

    /**
     * @covers ::fileExt
     */
    public function testFileEndsWithTheExpectedExtension()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->sut->subject = FIXTURES_DIR . 'file_1.txt';

        $this->sut->fileExt(['txt'],  __FUNCTION__);
    }

    /**
     * @covers ::fileExt
     */
    public function testFileDoesNotEndWithTheExpectedExtension()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = FIXTURES_DIR . 'file_1.txt';

        $this->sut->fileExt(['php'],  __FUNCTION__);
    }

    /**
     * @covers ::fileExt
     */
    public function testFileContainsExtensionButDoesNotEndWithWithIt()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = FIXTURES_DIR . 'file_.php.txt';

        $this->sut->fileExt(['php'],  __FUNCTION__);
    }

    /**
     * @covers ::fileSize
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
