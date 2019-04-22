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
            ->getMockForTrait();
    }

    /**
     * @covers ::fileExt
     */
    public function testFileEndsWithTheExpectedExtension()
    {
        $fileFixture = FIXTURES_DIR . 'file_1.txt';

        $actual = $this->sut->fileExt($fileFixture, ['txt']);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::fileExt
     */
    public function testFileDoesNotEndWithTheExpectedExtension()
    {
        $fileFixture = FIXTURES_DIR . 'file_1.txt';

        $actual = $this->sut->fileExt($fileFixture, ['php']);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::fileExt
     */
    public function testFileContainsExtensionButDoesNotEndWithWithIt()
    {
        $fixture = FIXTURES_DIR . 'file_.php.txt';

        $actual = $this->sut->fileExt($fixture, ['php']);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::fileSize
     */
    public function testFileSizeCanPass()
    {
        $fixture = FIXTURES_DIR . 'file_1.txt';

        $actual = $this->sut->fileSize($fixture, [1, 8]);

        $this->assertTrue($actual);
    }
}
