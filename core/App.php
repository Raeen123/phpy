<?php

namespace app\core;

class App
{
    public Python $python;
    public Snippet $snippet;
    public function __construct()
    {
        $this->python = new Python();
        $this->snippet = new Snippet();
    }
}