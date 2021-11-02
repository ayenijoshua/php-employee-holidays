<?php

use OttonovaCli\CommandTerminal;
use PHPUnit\Framework\TestCase;
use OttonovaCli\EmployeeController;

final class CommandTest extends TestCase
{
    public function testArrayOfEmplyoyee(): void
    {
        $employees = $this->employees();

        $this->assertIsArray($employees);
        
        foreach($employees as $employee){
            $this->assertArrayHasKey('name',$employee);
            $this->assertArrayHasKey('date_of_birth',$employee);
            $this->assertArrayHasKey('contract_start_date',$employee);
            $this->assertArrayHasKey('special_contract',$employee);
        }   
    }

    public function testDissplayEmployeesVacationDaysIsArray()
    {
        $year = 2000;

        $this->assertIsArray((new EmployeeController)->displayEmployeesVactionDays($year));
    }

    public function testEmployeeSWithZeroVacationDays()
    {
        $year = 2000; // year less than(before) all contract start dates

        foreach((new EmployeeController)->displayEmployeesVactionDays($year) as $employee){
            //all employees should have zero vacation days, since the provded year is less than the contrat start dates
            $this->assertEquals(0,$employee['vacation_days']);
        }

        $year = 2016; // year is less than(before) Marina and Sepp contract start dates
        foreach($employees=(new EmployeeController)->displayEmployeesVactionDays($year) as $key=>$val){
            //Marina and Sepp should have zero vacation days, since the provded year is less than their contrat start dates
            if($val['name'] == 'Marina Helter' || $val['name'] == 'Sepp Meier'){
                $this->assertEquals(0,$employees[$key]['vacation_days']);
            }
        }

        $year = 2003; // year is less than(before) Peter, Marina and Sepp contract start dates
        foreach($employees=(new EmployeeController)->displayEmployeesVactionDays($year) as $key=>$val){
            //Marina and Sepp should have zero vacation days, since the provded year is less than their contrat start dates
            if($val['name'] == 'Peter Klever' || $val['name'] == 'Marina Helter' || $val['name'] == 'Sepp Meier'){
                $this->assertEquals(0,$employees[$key]['vacation_days']);
            }
        }
    }

    public function testInvalidYear()
    {
        $year = 'jejejej44';
        $this->assertFalse((new CommandTerminal)->isValidYear($year));
    }

    public function testEmployeesWithSpecialContract()
    {
        $year = 2016; 
        foreach($employees=(new EmployeeController)->displayEmployeesVactionDays($year) as $key=>$val){
            //Peter Klever has a special contract, hence vacations days is more than 26 days
            if($val['name'] == 'Peter Klever'){
                $this->assertGreaterThan(26,$employees[$key]['vacation_days']);
            }
        }
    }

    public function testEmployeesThirtyAndAbove()
    {
        $year = 2016; 
        foreach($employees=(new EmployeeController)->displayEmployeesVactionDays($year) as $key=>$val){
            //Angelika Fringe and Hans Müller are above 30 years of age, hence vacations days are more than 26 days
            if($val['name'] == 'Angelika Fringe' || $val['name'] == 'Hans Müller'){
                $this->assertGreaterThan(26,$employees[$key]['vacation_days']);
            }
        }
    }

    private function employees()
    {
       return (new EmployeeController)->formatedEmployeeArray();
    }
}
