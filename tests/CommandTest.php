<?php

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

    

    private function employees()
    {
       return (new EmployeeController)->formatedEmployeeArray();
    }
}
