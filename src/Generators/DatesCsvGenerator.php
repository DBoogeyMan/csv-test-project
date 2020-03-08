<?php

namespace CSVTestApp\Generators;

use CSVTestApp\Enums\GlobalEnums;
use CSVTestApp\Helpers\DataFormattingHelper;
use CSVTestApp\Helpers\DateTimeHelper;
use CSVTestApp\Helpers\FileWriteHelper;
use CSVTestApp\Interfaces\GeneratorInterface;

class DatesCsvGenerator implements GeneratorInterface
{
    private $dateTimeHelper;
    private $fileWriteHelper;
    private $dataFormattingHelper;

    private $fileName = 'dates.cvs';
    private $arrayOfDefaultName = ['Иван 1','Иван 2','Олег','Дмитрий'];

    public function __construct(
        DateTimeHelper $dateTimeHelper,
        FileWriteHelper $fileWriteHelper,
        DataFormattingHelper $dataFormattingHelper
    ) {
        $this->dateTimeHelper = $dateTimeHelper;
        $this->fileWriteHelper = $fileWriteHelper;
        $this->dataFormattingHelper = $dataFormattingHelper;
    }

    /**
     * @throws \Exception
     * @throws \TypeError
     */
    public function generate(): void
    {
        $periodOfDates = $this->dateTimeHelper->getModaysByMonthsCount(GlobalEnums::MONTH_TOWARD);
        $fileRecords = $this->fileWriteHelper->getRecordsFromFile($this->fileName);
        $newRecords = $this->generateRecordsByDatesAndFileRecords($periodOfDates, $fileRecords);
        $preparedDataToWrite = $this->dataFormattingHelper->getFormattedEncodedDataFromArray($newRecords);

        $this->fileWriteHelper->write($preparedDataToWrite, $this->fileName);
    }

    /**
     * @param mixed[] $periodOfDates
     * @param mixed[] $fileRecords
     * @return mixed[]
     */
    private function generateRecordsByDatesAndFileRecords(array $periodOfDates, array $fileRecords): array
    {
        $fileRecordsDates = array_column($fileRecords, GlobalEnums::DATES_CVS_DATE_INDEX);
        $records = [];
        foreach ($periodOfDates as $date) {
            $key = array_search($date, $fileRecordsDates);
            if ($key === false) {
                $randomName = $this->arrayOfDefaultName[array_rand($this->arrayOfDefaultName)];
                array_push($records, [
                    $date,
                    $randomName,
                    random_int(GlobalEnums::MIN_RANDOM_VALUE, GlobalEnums::MAX_RANDOM_VALUE)
                ]);
            } else {
                array_push($records, $fileRecords[$key]);
            }
        }

        return $records;
    }
}