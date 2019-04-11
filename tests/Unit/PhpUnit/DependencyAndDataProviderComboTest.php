<?php

namespace Tests\Unit\PhpUnit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DependencyAndDataProviderComboTest extends TestCase
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

    /**
     * @dataProvider additionWithNonNegativeNumbersProvider
     * @dataProvider additionWithNegativeNumbersProvider
     */
    public function testAdd($a, $b, $expected)
    {
        $this->assertSame($expected, $a + $b);
    }

    public function additionWithNonNegativeNumbersProvider()
    {
        return [
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 2]
        ];
    }

    public function additionWithNegativeNumbersProvider()
    {
        return [
            [-1, 1, 0],
            [-1, -1, -2],
            [1, -1, 0]
        ];
    }
}
