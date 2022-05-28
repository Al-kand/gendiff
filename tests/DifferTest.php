<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\readFile;
use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    protected $files;

    protected function setUp(): void
    {
        $this->files = [
            'json1' => 'tests/fixtures/file1.json',
            'json2' => 'tests/fixtures/file2.json'
        ];
    }

    public function testreadFile()
    {
        $expected = [
            "host" => "hexlet.io",
            "timeout" => 50,
            "proxy" => "123.234.53.22",
            "follow" => false
        ];

        $this->assertEquals($expected, readFile($this->files['json1']));
    }

    public function testgenDiff()
    {
        $expected = <<<EXP
        {
          - follow: false
            host: hexlet.io
          - proxy: 123.234.53.22
          - timeout: 50
          + timeout: 20
          + verbose: true
        }
        
        EXP;

        $this->assertEquals($expected, genDiff($this->files['json1'], $this->files['json2']));
    }
}
