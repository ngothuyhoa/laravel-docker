<?php

namespace Tests\Unit\PhpUnit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Error\Error;

class ExpectedErrorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testFailingInclude()
    {
        $writer = new FileWriter;

        $this->assertFalse(@$writer->write('/is-not-writeable/file', 'stuff'));
    }
}

class FileWriter
{
    public function write($file, $content)
    {
        $file = fopen($file, 'w');

        if ($file == false) {
            return false;
        }

        // ...
    }
}
