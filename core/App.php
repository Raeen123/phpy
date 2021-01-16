<?php

namespace app\core;

class App
{
    public Python $python;
    public function __construct()
    {
        $this->python = new Python();
    }
}