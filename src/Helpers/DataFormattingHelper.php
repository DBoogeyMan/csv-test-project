<?php

namespace CSVTestApp\Helpers;


use CSVTestApp\Enums\GlobalEnums;

class DataFormattingHelper
{
    public function getFormattedEncodedDataFromArray(array $records): string
    {
        return mb_convert_encoding(
            $this->getFormattedDataFromArray($records),
            GlobalEnums::ENCODING_FORMAT_UTF8,
            GlobalEnums::ENCODING_FORMAT_CP1251
        );
    }

    public function getFormattedDataFromArray(array $records): string
    {
        $formattedData = '';
        foreach ($records as $record) {
            $formattedData .= sprintf("%s\n", implode($record, ', '));
        }

        return $formattedData;
    }
}