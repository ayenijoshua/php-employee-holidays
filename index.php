<?php


if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use OttonovaCli\CommandTerminal;
//use OttonovaCli\EmployeeController;

$terminal = new CommandTerminal();

$terminal->run();

