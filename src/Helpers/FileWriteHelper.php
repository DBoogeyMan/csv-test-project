<?php

namespace CSVTestApp\Helpers;

use CSVTestApp\Enums\GlobalEnums;

class FileWriteHelper
{
    private $dirPath = __DIR__ . '/../../public/csv';

    /**
     * @param string $fileName
     * @return mixed[]
     */
    public function getRecordsFromFile(string $fileName): array
    {
        $filePath = sprintf('%s/%s', rtrim($this->dirPath, '/'), trim($fileName, '/'));
        if (!file_exists($filePath)) {
            return [];
        }

        $fileData = file_get_contents($filePath);
        $convertedDataUTF8 = mb_convert_encoding(
            $fileData,
            GlobalEnums::ENCODING_FORMAT_CP1251,
            GlobalEnums::ENCODING_FORMAT_UTF8
        );

        $records = explode("\n", $convertedDataUTF8);
        $records = array_filter($records, 'strlen');
        foreach ($records as $recordIndex => $record) {
            $records[$recordIndex] = explode(', ', $record);
        }

        return $records;
    }

    /**
     * @param string $records
     * @param string $fileName
     */
    public function write(string $records, string $fileName): void
    {
        $filePath = sprintf('%s/%s', rtrim($this->dirPath, '/'), trim($fileName, '/'));
        if (!file_exists($this->dirPath)) {
            mkdir($this->dirPath, GlobalEnums::WRITE_MODE);
        }

        $openedFileResource = fopen($filePath, 'w');

        fwrite($openedFileResource, $records);
    }
}