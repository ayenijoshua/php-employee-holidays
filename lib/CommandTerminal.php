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
        $year = readline("Enter year : ");

        return $year;
    }

    public function getPrinter()
    {
        return new CliPrinter();
    }

    public function run()
    {
        $year = $this->getUserInput();

        if($this->isValidYear($year)){
            (new EmployeeController)->runCommand($year);
        }else{
            exit("Bye");
        }
           
    }

    public function isValidYear($year)
    {
        $month = 1;
        $day = 1;

        if (empty($year)) {
            $this->getPrinter()->display("ERROR: Year not passed");
            return false;
        }

        if(! @checkdate($month,$day,$year)){
            $this->getPrinter()->display("ERROR: Please provide a valid year");
            return false;
        }

        return true;
    }

    public function reRun()
    {
        $answ = readline("Do you wish to continue? yes/no : ");
        if(! in_array($answ,self::YES_INPUTS)){
            (new CliPrinter)->display("Thanks for using our application");
            exit("Bye");
        }

        $year = $this->getUserInput();
        if($this->isValidYear($year)){
            (new EmployeeController)->runCommand($year);
        }else{
            exit("Bye");
        }
         
    }
    
}
