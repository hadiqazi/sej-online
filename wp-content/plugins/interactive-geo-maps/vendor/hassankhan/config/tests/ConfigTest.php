<?php
namespace Noodlehaus;

use Noodlehaus\Parser\Json as JsonParser;
use Noodlehaus\Writer\Json as JsonWriter;
use PHPUnit\Framework\TestCase;
use Yoast\PHPUnitPolyfills\Polyfills\ExpectException;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-21 at 22:37:22.
 */
class ConfigTest extends TestCase
{
    use ExpectException;
    /**
     * @var Config
     */
    protected $config;

    /**
     * @covers                   Noodlehaus\Config::load()
     * @covers                   Noodlehaus\Config::loadFromFile()
     * @covers                   Noodlehaus\Config::getParser()
     */
    public function testLoadWithUnsupportedFormat()
    {
        $this->expectException(\Noodlehaus\Exception\UnsupportedFormatException::class);
        $this->expectExceptionMessage('Unsupported configuration format');
        $config = Config::load(__DIR__ . '/mocks/fail/error.lib');
        // $this->markTestIncomplete('Not yet implemented');
    }

    /**
     * @covers                   Noodlehaus\Config::__construct()
     * @covers                   Noodlehaus\Config::loadFromFile()
     * @covers                   Noodlehaus\Config::getParser()
     */
    public function testConstructWithUnsupportedFormat()
    {
        $this->expectException(\Noodlehaus\Exception\UnsupportedFormatException::class);
        $this->expectExceptionMessage('Unsupported configuration format');
        $config = new Config(__DIR__ . '/mocks/fail/error.lib');
    }

    /**
     * @covers                   Noodlehaus\Config::__construct()
     * @covers                   Noodlehaus\Config::loadFromFile()
     * @covers                   Noodlehaus\Config::getParser()
     * @covers                   Noodlehaus\Config::getPathFromArray()
     * @covers                   Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithInvalidPath()
    {
        $this->expectException(\Noodlehaus\Exception\FileNotFoundException::class);
        $this->expectExceptionMessage('Configuration file: [ladadeedee] cannot be found');
        $config = new Config('ladadeedee');
    }

    /**
     * @covers            Noodlehaus\Config::__construct()
     * @covers            Noodlehaus\Config::loadFromFile()
     * @covers            Noodlehaus\Config::getParser()
     * @covers            Noodlehaus\Config::getPathFromArray()
     * @covers            Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithEmptyDirectory()
    {
        $this->expectException(\Noodlehaus\Exception\EmptyDirectoryException::class);
        $config = new Config(__DIR__ . '/mocks/empty');
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromFile()
     * @covers Noodlehaus\Config::getParser()
     * @covers Noodlehaus\Config::getPathFromArray()
     * @covers Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithArray()
    {
        $paths = [__DIR__ . '/mocks/pass/config.xml', __DIR__ . '/mocks/pass/config2.json'];
        $config = new Config($paths);

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers            Noodlehaus\Config::__construct()
     * @covers            Noodlehaus\Config::loadFromFile()
     * @covers            Noodlehaus\Config::getParser()
     * @covers            Noodlehaus\Config::getPathFromArray()
     * @covers            Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithArrayWithNonexistentFile()
    {
        $this->expectException(\Noodlehaus\Exception\FileNotFoundException::class);
        $paths = [__DIR__ . '/mocks/pass/config.xml', __DIR__ . '/mocks/pass/config3.json'];
        $config = new Config($paths);

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromFile()
     * @covers Noodlehaus\Config::getParser()
     * @covers Noodlehaus\Config::getPathFromArray()
     * @covers Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithArrayWithOptionalFile()
    {
        $paths = [__DIR__ . '/mocks/pass/config.xml', '?' . __DIR__ . '/mocks/pass/config2.json'];
        $config = new Config($paths);

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromFile()
     * @covers Noodlehaus\Config::getParser()
     * @covers Noodlehaus\Config::getPathFromArray()
     * @covers Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithArrayWithOptionalNonexistentFile()
    {
        $paths = [__DIR__ . '/mocks/pass/config.xml', '?' . __DIR__ . '/mocks/pass/config3.json'];
        $config = new Config($paths);

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromFile()
     * @covers Noodlehaus\Config::getParser()
     * @covers Noodlehaus\Config::getPathFromArray()
     * @covers Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithDirectory()
    {
        $config = new Config(__DIR__ . '/mocks/dir');

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromFile()
     * @covers Noodlehaus\Config::getParser()
     * @covers Noodlehaus\Config::getPathFromArray()
     * @covers Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithYml()
    {
        $config = new Config(__DIR__ . '/mocks/pass/config.yml');

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromFile()
     * @covers Noodlehaus\Config::getParser()
     * @covers Noodlehaus\Config::getPathFromArray()
     * @covers Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithYmlDist()
    {
        $config = new Config(__DIR__ . '/mocks/pass/config.yml.dist');

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromFile()
     * @covers Noodlehaus\Config::getParser()
     * @covers Noodlehaus\Config::getPathFromArray()
     * @covers Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithEmptyYml()
    {
        $config = new Config(__DIR__ . '/mocks/pass/empty.yaml');

        $expected = [];
        $actual   = $config->all();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromFile()
     * @covers Noodlehaus\Config::getPathFromArray()
     * @covers Noodlehaus\Config::getValidPath()
     */
    public function testConstructWithFileParser()
    {
        $config = new Config(__DIR__ . '/mocks/pass/json.config', new Parser\Json);

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Noodlehaus\Config::__construct()
     * @covers Noodlehaus\Config::loadFromString()
     */
    public function testConstructWithStringParser()
    {
        $settings = file_get_contents(__DIR__ . '/mocks/pass/config.php');
        $config = new Config($settings, new Parser\Php, true);

        $expected = 'localhost';
        $actual   = $config->get('host');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers       Noodlehaus\Config::__construct()
     * @covers       Noodlehaus\Config::get()
     * @dataProvider specialConfigProvider()
     */
    public function testGetReturnsArrayMergedArray($config)
    {
        $this->assertCount(4, $config->get('servers'));
    }

    /**
     * @covers       Noodlehaus\Config::toFile()
     * @covers       Noodlehaus\Config::getWriter()
     */
    public function testWritesToFile()
    {
        $config = new Config(json_encode(['foo' => 'bar']), new JsonParser(), true);
        $filename = tempnam(sys_get_temp_dir(), 'config').'.json';

        $config->toFile($filename);

        $this->assertFileExists($filename);
    }

    /**
     * @covers       Noodlehaus\Config::toString()
     */
    public function testWritesToString()
    {
        $config = new Config(json_encode(['foo' => 'bar']), new JsonParser(), true);

        $string = $config->toString(new JsonWriter());

        $this->assertNotEmpty($string);
    }

    /**
     * Provides names of example configuration files
     */
    public function configProvider()
    {
        return array_merge(
            [
                [new Config(__DIR__ . '/mocks/pass/config-exec.php')],
                [new Config(__DIR__ . '/mocks/pass/config.ini')],
                [new Config(__DIR__ . '/mocks/pass/config.json')],
                [new Config(__DIR__ . '/mocks/pass/config.php')],
                [new Config(__DIR__ . '/mocks/pass/config.xml')],
                [new Config(__DIR__ . '/mocks/pass/config.yaml')]
            ]
        );
    }

    /**
     * Provides names of example configuration files (for array and directory)
     */
    public function specialConfigProvider()
    {
        return [
            [
                new Config(
                    [
                        __DIR__ . '/mocks/pass/config2.json',
                        __DIR__ . '/mocks/pass/config.yaml'
                    ]
                ),
                new Config(__DIR__ . '/mocks/dir/')
            ]
        ];
    }
}
