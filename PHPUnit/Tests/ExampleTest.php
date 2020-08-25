<?php

use \PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function adding_two_plus_two_results_in_four()
    {
        $this->assertEquals(4, 2 + 2);
    }
}