<?php namespace Whip\Lash\Test\Validators;

/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Psr\Http\Message\UploadedFileInterface;
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
    /** @var \Whip\Lash\Validators\FileUpload|\PHPUnit_Framework_MockObject_MockObject */
    private $sut;

    /** @var \Psr\Http\Message\UploadedFileInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $mockUploadedFile;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder(FileUpload::class)
            ->getMockForTrait();

        $this->mockUploadedFile = $this->createMock(UploadedFileInterface::class);
        $this->fixture = new \stdClass();
    }

    /**
     * @covers ::uploadHasExt
     */
    public function testFileEndsWithTheExpectedExtension()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getClientFilename')
            ->willReturn('test.png');

        $fixture = $this->mockUploadedFile;

        $actual = $this->sut->uploadHasExt($fixture, ['png']);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::uploadHasExt
     */
    public function testFileDoesNotEndWithTheExpectedExtension()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getClientFilename')
            ->willReturn('test.png');

        $actual = $this->sut->uploadHasExt($this->mockUploadedFile, ['php']);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::uploadHasExt
     */
    public function testFileContainsExtensionButDoesNotEndWithWithIt()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getClientFilename')
            ->willReturn('test.png.tst');

        $actual = $this->sut->uploadHasExt($this->mockUploadedFile, ['php']);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::uploadHasSize
     */
    public function testFileSizeCanPass()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getSize')
            ->willReturn('4');

        $actual = $this->sut->uploadHasSize($this->mockUploadedFile, [1, 8]);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::uploadHasSize
     */
    public function testFileSizeBelowMinimumWillNotPass()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getSize')
            ->willReturn('0');

        $actual = $this->sut->uploadHasSize($this->mockUploadedFile, [1, 8]);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::uploadHasSize
     */
    public function testFileSizeAboveMaximumWillNotPass()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getSize')
            ->willReturn('9');

        $actual = $this->sut->uploadHasSize($this->mockUploadedFile, [1, 8]);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::uploadName
     */
    public function testWillPassAFileNameThatDoesMatchARegexFilter()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getClientFilename')
            ->willReturn('test.png.tst');

        $actual = $this->sut->uploadName($this->mockUploadedFile, '/^[a-z.]+$/');

        $this->assertTrue($actual);
    }

    /**
     * @covers ::uploadName
     */
    public function testWillNotPassAFileNameThatDoesNotMatchARegexFilter()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getClientFilename')
            ->willReturn('test.png.tst');

        $actual = $this->sut->uploadName($this->mockUploadedFile, '/^[A-Z]+$/');

        $this->assertFalse($actual);
    }

    /**
     * @covers ::uploadName
     */
    public function testUploadNameWillNotIncludeFullPath()
    {
        $this->mockUploadedFile->expects($this->once())
            ->method('getClientFilename')
            ->willReturn('/tmp/test.txt');

        $actual = $this->sut->uploadName($this->mockUploadedFile, '/^[a-z.]+$/');

        $this->assertTrue($actual);
    }

    /**
     * @covers ::upload
     * @uses \Whip\Lash\Validators\FileUpload::uploadHasExt
     * @uses \Whip\Lash\Validators\FileUpload::uploadHasSize
     * @uses \Whip\Lash\Validators\FileUpload::uploadName
     */
    public function testUpload()
    {
        $this->mockUploadedFile->expects($this->atLeastOnce())
            ->method('getClientFilename')
            ->willReturn('/tmp/test.txt');

        $this->mockUploadedFile->expects($this->once())
            ->method('getSize')
            ->willReturn(1.);

        $actual = $this->sut->upload($this->mockUploadedFile, [
            ['txt'],
            [1, 2]
        ]);

        $this->assertTrue($actual);
    }
}
