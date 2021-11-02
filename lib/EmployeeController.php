<?php

namespace OttonovaCli\Controller;

use OttonovaCli\App;

class HelloController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    protected function getApp()
    {
        return $this->app;
    }

    public function run($argv)
    {
        $name = isset ($argv[2]) ? $argv[2] : "World";
        $this->getApp()->getPrinter()->display("Hello $name!!!");
    }
}