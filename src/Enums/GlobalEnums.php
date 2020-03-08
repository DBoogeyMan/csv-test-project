<?php

namespace CSVTestApp\Enums;

use MyCLabs\Enum\Enum;

class GlobalEnums extends Enum
{
    const ENCODING_FORMAT_CP1251 = 'windows-1251';
    const ENCODING_FORMAT_UTF8 = 'utf-8';

    const WRITE_MODE = 0777;

    const MIN_RANDOM_VALUE = 100;
    const MAX_RANDOM_VALUE = 999;

    const MONTH_TOWARD = 3;

    const DATES_CVS_DATE_INDEX = 0;
    const DATES_CVS_NAME_INDEX = 1;
    const DATES_CVS_NUMBER_INDEX = 2;
}