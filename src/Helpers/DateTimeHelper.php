<?php

namespace CSVTestApp\Helpers;

use Carbon\Carbon;
use Carbon\CarbonInterval;

class DateTimeHelper
{
    private $dateFormat = 'd.m.Y';

    /**
     * @param string $month
     * @return \DatePeriod
     */
    private function getFirstAndThirdMondaysByMonth(string $month): \DatePeriod
    {
        return new \DatePeriod(
            Carbon::parse("first monday of {$month}"),
            CarbonInterval::week(),
            Carbon::parse("third monday of {$month}")
        );
    }

    /**
     * @param int $countOfMonth
     * @return mixed[]
     */
    public function getModaysByMonthsCount(int $countOfMonth): array
    {
        $dates = [];
        for ($monthCounter = 0; $monthCounter < $countOfMonth; $monthCounter++) {
            $month = Carbon::today()->addMonths($monthCounter)->format('F');
            $monthMondays = $this->getFirstAndThirdMondaysByMonth($month);
            $firstMonday = $monthMondays->start->getTimestamp();
            $thirdMonday = $monthMondays->end->getTimestamp();

            if (time() < $firstMonday) {
                array_push($dates, Carbon::createFromTimestamp($firstMonday)->format($this->dateFormat));
            }
            if (time() < $thirdMonday) {
                array_push($dates, Carbon::createFromTimestamp($thirdMonday)->format($this->dateFormat));
            }
        }

        return $dates;
    }

}