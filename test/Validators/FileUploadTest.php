<?php namespace Whip\Lash\Test\Validators;

/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Psr\Http\Message\UploadedFileInterface;
use const Whip\Lash\Test\FIXTURES_DIR;
use Whip\Lash\Validators\FileUpload;
use PHPUnit\Framework\TestCase;

/**
 * Class FileUploadTest
 *
 * @package \Whip\Lash\Test\Validators
 * @coversDefaultClass \Whip\Lash\Validators\FileUpload
 */
class FileUploadTest extends TestCase
{
    /** @var \Whip\Lash\Validators\File|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    /** @var \Psr\Http\Message\UploadedFileInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $mockUploadedFile;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(FileUpload::class)
            ->setMethods(['check'])
            ->getMockForTrait();

        $this->mockUploadedFile = $this->createMock(UploadedFileInterface::class);
        $this->fixture = new \stdClass();

//        $this->fixture->file = 'C:\Windows\Temp\phpC243.tmp';
//      protected 'name' => string 'Bellman.png' (length=11)
//      protected 'type' => string 'image/png' (length=9)
//      protected 'size' => int 49876
//      protected 'error' => int 0
//      protected 'sapi' => boolean true
//      protected 'stream' => null
//      protected 'moved' => boolean false
    }

    /**
     * @covers ::uploadHasExt
     */
    public function testFileEndsWithTheExpectedExtension()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->mockUploadedFile->expects($this->once())
            ->method('getClientFilename')
            ->willReturn('test.png');

        $this->sut->subject = $this->mockUploadedFile;

        $this->sut->uploadHasExt(['png'],  __FUNCTION__);
    }

    /**
     * @covers ::uploadHasExt
     */
    public function testFileDoesNotEndWithTheExpectedExtension()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->sut->subject = $this->mockUploadedFile;

        $this->sut->uploadHasExt(['php'],  __FUNCTION__);
    }

    /**
     * @covers ::uploadHasExt
     */
    public function testFileContainsExtensionButDoesNotEndWithWithIt()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->mockUploadedFile->expects($this->once())
            ->method('getClientFilename')
            ->willReturn('test.png.tst');

        $this->sut->subject = $this->mockUploadedFile;

        $this->sut->uploadHasExt(['php'],  __FUNCTION__);
    }

    /**
     * @covers ::uploadHasSize
     */
    public function testFileSizeCanPass()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(true), $this->equalTo(__FUNCTION__));

        $this->mockUploadedFile->expects($this->once())
            ->method('getSize')
            ->willReturn('4');

        $this->sut->subject = $this->mockUploadedFile;

        $this->sut->uploadHasSize(1, 8,  __FUNCTION__);
    }

    /**
     * @covers ::uploadHasSize
     */
    public function testFileSizeBelowMinimumWillNotPass()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->mockUploadedFile->expects($this->once())
            ->method('getSize')
            ->willReturn('0');

        $this->sut->subject = $this->mockUploadedFile;

        $this->sut->uploadHasSize(1, 8,  __FUNCTION__);
    }

    /**
     * @covers ::uploadHasSize
     */
    public function testFileSizeAboveMaximumWillNotPass()
    {
        $this->sut->expects($this->once())
            ->method('check')
            ->with($this->equalTo(false), $this->equalTo(__FUNCTION__));

        $this->mockUploadedFile->expects($this->once())
            ->method('getSize')
            ->willReturn('9');

        $this->sut->subject = $this->mockUploadedFile;

        $this->sut->uploadHasSize(1, 8,  __FUNCTION__);
    }
}
