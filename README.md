## About the project
This is a simple PHP CLI script to compute employees vacation days

## Set Up
1. Please make sure you have php installed on yor machine.
2. cd into the directory that contans the code (should be Joshua-ayeni-ottonova-cli)
3. run php index.php to run the command
4. run ./vendor/bin/phpunit run the tests

## Assumptions/Ambiguity
1. I assume that if the year of interest is before the employee's contract start date, the employee has zero vacation days.
2. I assume that if employee's contract start day is not the first day of the month, then the employee doesn't have a full month credit.
3. I assume that if the computed vacation days has decimal places, I rounded down to the closest integer.
