<?php

use PHPUnit\Framework\TestCase;

class AbstractPersonTest extends TestCase
{
    /** @test */
    public function name_and_title_is_returned()
    {
        $doctor = new App\Doctor('Green');
        
        $this->assertEquals('Dr. Green', $doctor->getNameAndTitle());                
    }
    
    /** @test */
    public function name_and_title_includes_value_from_get_title()
    {
        $mock = $this->getMockBuilder(App\AbstractPerson::class)
                     ->setConstructorArgs(['Green'])        
                     ->getMockForAbstractClass();  
                     
        $mock->method('getTitle')
             ->willReturn('Dr.');
            
        $this->assertEquals('Dr. Green', $mock->getNameAndTitle());
    }    
}