<?php

use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    protected $item;

    protected function setUp() : void
    {
        $this->item = new App\Item;
    }

    /** @test */
    public function description_is_not_empty()
    {
        $this->assertNotEmpty($this->item->getDescription());                    
    }
    
    /** @test */
    public function iD_is_an_integer()
    {
        $item = new App\ItemChild;
        $this->assertIsInt($item->getID());
    }
    
    /** @test */
    public function token_is_a_string()
    {
        /* TEST A PRIVATE FUNCTION WITH PHP_REFLECTION */
        $reflector = new ReflectionClass(App\Item::class);
        $method = $reflector->getMethod('getToken');
        $method->setAccessible(true);
        $result = $method->invoke($this->item);
        $this->assertIsString($result);
    }

    /** @test */
    public function prefixed_token_starts_with_prefix()
    {
        $reflector = new ReflectionClass(App\Item::class);

        $method = $reflector->getMethod('getPrefixedToken');
        $method->setAccessible(true);        

        $result = $method->invokeArgs($this->item, ['example']);

        $this->assertStringStartsWith('example', $result);        
    }  
}
