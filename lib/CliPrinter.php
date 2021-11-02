<?php

namespace OttonovaCli;

class CliPrinter
{
    public function out($message)
    {
        echo $message;
    }

    public function newline()
    {
        $this->out("\n");
    }

    public function tab()
    {
        $this->out("\t");
    }

    public function welcomeMessage()
    {
        $this->display("Welcome to Ottonova-employee CLI");
        $this->display("This is a project to display employee names and vacation days");
    }

    public function display($message)
    {
        $this->newline();
        $this->out($message);
        $this->newline();
        //$this->newline();
    }
}