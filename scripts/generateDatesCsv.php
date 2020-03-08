<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CSVTestApp\Generators\DatesCsvGenerator;
use CSVTestApp\Helpers\{DateTimeHelper, FileWriteHelper, DataFormattingHelper};

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dateTimeHelper = new DateTimeHelper();
$fileWriteHelper = new FileWriteHelper();
$dataFormattingHelper = new DataFormattingHelper();

$datesCsvGenerator = new DatesCsvGenerator($dateTimeHelper, $fileWriteHelper, $dataFormattingHelper);

try {
    $datesCsvGenerator->generate();
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    echo $exception->getMessage();
}