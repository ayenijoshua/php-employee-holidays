<?php

namespace OttonovaCli;

use OttonovaCli\EmployeeController;
use OttonovaCli\CliPrinter;

class CommandTerminal{

    private $app;

    const YES_INPUTS = ['YES','yes','y'];

    const NO_INPUTS = ['NO','no','n'];

    function __construct()
    {
        //$this->app = new EmployeeController;
    }

    public function getUserInput()
    {
        $line = readline("Enter year : ");
        
        //readline_add_history($line);

        return $line;
    }

    public function run()
    {
        $line = $this->getUserInput();
        (new EmployeeController)->runCommand($line);   
    }

    public function reRun()
    {
        $answ = readline("Do you wish to continue? yes/no : ");
        if(! in_array($answ,self::YES_INPUTS)){
            (new CliPrinter)->display("Thanks for using our application");
            exit("Bye");
        }

        $year = $this->getUserInput();
        (new EmployeeController)->runCommand($year); 
    }
    
}
