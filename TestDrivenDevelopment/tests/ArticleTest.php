<?php

use \PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    protected $article;

    protected function setUp() : void
    {
        $this->article = new App\Article;
    }

    public function titleProvider()
    {
        return [
            "slug_has_spaces_replaced_by_underscores" => ['An example article','An_example_article'],
            "slug_has_whitespace_replaced_by_single_underscore" => ["An    example    \n   article",'An_example_article'],
            "slug_does_not_start_or_end_with_an_underscore" => [" An example article ",'An_example_article'],
            "slug_does_not_have_any_non_word_characters" => ['Read! This! Now!','Read_This_Now']
        ];  
    }

    /**
     * @test
     * @dataProvider titleProvider
     */
    public function slug($title, $slug)
    {
        $this->article->title = $title;
        $this->assertEquals($this->article->getSlug(), $slug);
    }

    /** @test */
    public function title_is_empty_by_default()
    {
        $this->assertEmpty($this->article->title);
    }

    /** @test */
    public function slug_is_empty_with_no_title()
    {
        $this->assertSame($this->article->getSlug(), "");
    }

    /** @test */
    public function slug_has_spaces_replaced_by_underscores()
    {
        $this->article->title = 'An example article';
        $this->assertEquals($this->article->getSlug(), 'An_example_article');
    }

    /** @test */
    public function slug_has_whitespace_replaced_by_single_underscore()
    {
        $this->article->title = "An    example    \n   article";
        $this->assertEquals($this->article->getSlug(), 'An_example_article');
    }

    /** @test */
    public function slug_does_not_start_or_end_with_an_underscore()
    {
        $this->article->title = " An example article ";
        $this->assertEquals($this->article->getSlug(), 'An_example_article');
    }

    /** @test */
    public function slug_does_not_have_any_non_word_characters()
    {
        $this->article->title = 'Read! This! Now!';
        $this->assertEquals($this->article->getSlug(), 'Read_This_Now');
    }
}