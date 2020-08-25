<?php

use Exception;
use App\Models\User;
use App\Models\Mailer;
use \PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected $user;

    public function setUp() : void
    {
        $this->user = new User;   
    }

    /** @test */
    public function returns_full_name()
    {
        $this->user->first_name = 'Andrew';
        $this->user->surname = 'Green';

        $this->assertEquals('Andrew Green', $this->user->getFullName());
    }

    /** @test */
    public function full_name_is_empty_by_default()
    {
        $this->assertEquals('', $this->user->getFullName());
    }

    /** @test */
    public function notification_is_sent()
    {
        $user = new User;
        $mock_mailer = $this->createMock(Mailer::class);
        $mock_mailer->expects($this->once())->method('sendMessage')->with('andras.schneider@cubicfox.com', $this->equalTo('Hello'))->willReturn(true);         
        $user->setMailer($mock_mailer);
                        
        $user->email = 'andras.schneider@cubicfox.com';
        
        $this->assertTrue($user->notify("Hello"));
    }

    /** @test */
    public function cannot_notify_user_with_no_email()
    {
        $user = new User;
        
        $mock_mailer = $this->getMockBuilder(Mailer::class)->setMethods(null)->getMock();        
                            
        $user->setMailer($mock_mailer);
        
        $this->expectException(Exception::class);
                
        $user->notify("Hello");
    }  
}