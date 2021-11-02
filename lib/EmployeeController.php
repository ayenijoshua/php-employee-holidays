<?php

namespace OttonovaCli;

use DateTime;
use OttonovaCli\CliPrinter;
use OttonovaCli\CommandTerminal;

class EmployeeController
{
    protected $printer;

    const MIN_VACATION_DAYS = 26;
    const MONTHS_IN_YEAR = 12;
    const CONTRACT_DAYS = [1,15];

    public function __construct()
    {
        $this->printer = new CliPrinter();
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function runCommand($year){
        
        $vacationDays = $this->displayEmployeesVactionDays($year);

        $this->getPrinter()->display("Name: \t\t\t\t Vacation days \n");

        foreach($vacationDays as $val){
            $this->getPrinter()->display("{$val['name']} \t\t\t\t {$val['vacation_days']} \n");
        }

       (new CommandTerminal)->reRun();

    }

    public function displayEmployeesVactionDays($year)
    {
        $vacationArr = [];

        foreach($this->formatedEmployeeArray() as $val){
            $vacationDays = self::MIN_VACATION_DAYS;

            $contrat_start_year = date('Y',strtotime($val['contract_start_date']));

            if($year < $contrat_start_year){
                $vacationArr[] = [
                    'name'=>$val['name'],
                    'vacation_days'=>0
                ];
                continue;
            }

            $dob = new DateTime($val['date_of_birth']);

            $contrat_start_date = new DateTime($val['contract_start_date']);
            $contrat_start_month = date('n',strtotime($val['contract_start_date']));
            $contrat_start_day = date('d',strtotime($val['contract_start_date']));
            

            $years_in_service = date_diff($dob,$contrat_start_date)->format('%y');

            if($years_in_service >= 30){
                $five_year_diff = $years_in_service/5;
                $vacationDays += $five_year_diff;
            }
            
            if($year == date('Y',strtotime($val['contract_start_date']))){
                $full_month = $contrat_start_day == 1 
                    ? self::MONTHS_IN_YEAR - ($contrat_start_month - 1) 
                    : self::MONTHS_IN_YEAR - ($contrat_start_month - 2);

                $vacationDays += ( (1/12) * self::MIN_VACATION_DAYS) * $full_month;
            }

            if($val['special_contract']==true){
                $vacationDays +=1;
            }

            $vacationArr[] = [
                'name'=>$val['name'],
                'vacation_days'=>floor($vacationDays)
            ];
        }

        return $vacationArr;

    }

    public function formatedEmployeeArray()
    {
        return array_map(function($val){
            $dob = explode('.',$val['date_of_birth']);
            $date_of_birth = $dob[2].'-'.$dob[1].'-'.$dob[0];
            return [
                'name'=>$val['name'],
                'date_of_birth'=>$date_of_birth,
                'contract_start_date'=>$val['contract_start_date'],
                'special_contract'=>$val['special_contract']
            ];

        },$this->employeeArray());
    }

    private function employeeArray()
    {
        return [
            [
                'name'=>'Hans Müller',
                'date_of_birth'=>'30.12.1950',
                'contract_start_date'=>'01.01.2001',
                'special_contract'=>''
            ],
            [
                'name'=>'Angelika Fringe',
                'date_of_birth'=>'09.06.1966',
                'contract_start_date'=>'15.01.2001',
                'special_contract'=>''
            ],
            [
                'name'=>'Peter Klever',
                'date_of_birth'=>'12.07.1991',
                'contract_start_date'=>'15.05.2016',
                'special_contract'=>true
            ],
            [
                'name'=>'Marina Helter',
                'date_of_birth'=>'26.01.1970',
                'contract_start_date'=>'15.01.2018',
                'special_contract'=>''
            ],
            [
                'name'=>'Sepp Meier',
                'date_of_birth'=>'23.05.1980',
                'contract_start_date'=>'01.12.2017',
                'special_contract'=>''
            ]
        ];
    }
}