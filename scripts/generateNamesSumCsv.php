<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CSVTestApp\Generators\NamesSumCsvGenerator;
use CSVTestApp\Helpers\{FileWriteHelper, DataFormattingHelper};

error_reporting(E_ALL);
ini_set('display_errors', 1);

$fileWriteHelper = new FileWriteHelper();
$dataFormattingHelper = new DataFormattingHelper();

$namesSumCsvGenerator = new NamesSumCsvGenerator($fileWriteHelper, $dataFormattingHelper);

try {
    $namesSumCsvGenerator->generate();
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    echo $exception->getMessage();
}