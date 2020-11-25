<?php


namespace App\Post\Domain;

class Post
{

    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}