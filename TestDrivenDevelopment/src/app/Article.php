<?php

namespace App;

class Article
{
    public $title;

    public function getSlug()
    {
        return preg_replace('/[^\w]+/', '', preg_replace('/\s+/', '_',trim($this->title)));
    }
}