<?php

use App\Models\Mailer;
use \PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{
    /** @test */
    public function mock()
    {
        $mock = $this->createMock(Mailer::class);
        $mock->method('sendMessage')->willReturn(true);
        $result = $mock->sendMessage('andras.schneider@cubicfox.com', 'Hello');

        $this->assertTrue($result);
    }
}