<?php

namespace CSVTestApp\Generators;

use CSVTestApp\Enums\GlobalEnums;
use CSVTestApp\Helpers\DataFormattingHelper;
use CSVTestApp\Helpers\FileWriteHelper;
use CSVTestApp\Interfaces\GeneratorInterface;

class NamesSumCsvGenerator implements GeneratorInterface
{
    private $fileWriteHelper;
    private $dataFormattingHelper;

    private $fileNamesSum = 'names_sum.cvs';
    private $fileDates = 'dates.cvs';

    public function __construct(FileWriteHelper $fileWriteHelper, DataFormattingHelper $dataFormattingHelper)
    {
        $this->fileWriteHelper = $fileWriteHelper;
        $this->dataFormattingHelper = $dataFormattingHelper;
    }

    /**
     * @throws \Exception
     * @throws \TypeError
     */
    public function generate(): void
    {
        $datesRecord = $this->fileWriteHelper->getRecordsFromFile($this->fileDates);
        $namesSum = $this->getFilteredNamesSumFromDatesRecords($datesRecord);
        $preparedDataToWrite = $this->dataFormattingHelper->getFormattedDataFromArray($namesSum);

        $this->fileWriteHelper->write($preparedDataToWrite, $this->fileNamesSum);
    }

    /**
     * @param mixed[] $datesRecords
     * @return mixed[]
     */
    private function getFilteredNamesSumFromDatesRecords(array $datesRecords): array
    {
        $namesArray = array_column($datesRecords, GlobalEnums::DATES_CVS_NAME_INDEX);
        $data = [];
        foreach ($namesArray as $namesIndex => $name) {
            $name = preg_replace('/( \d)/','',$name);
            if (isset($data[$name])) {
                $data[$name] += $datesRecords[$namesIndex][GlobalEnums::DATES_CVS_NUMBER_INDEX];
            } else {
                $data[$name] = $datesRecords[$namesIndex][GlobalEnums::DATES_CVS_NUMBER_INDEX];
            }
        }

        $result = [];
        foreach ($data as $name => $sum) {
            array_push($result, [$name, $sum]);
        }

        return $result;
    }
}