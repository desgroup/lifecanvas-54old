<?php
/**
 * Created by Red Square Studios.
 * User: kgwhatley
 * Date: 2017-03-12
 * Time: 7:11 PM
 */

namespace App\Lifecanvas\Utilities;

use Carbon\Carbon;

class DateTimeUtilities
{
    /**
     * @param $utcTime
     * @param $timezoneName
     * @return mixed
     * @internal param $timezoneName
     */
    public function toLocalTime($utcTime, $timezoneName){
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $utcTime);
        $date->setTimezone($timezoneName);
        $date = $date->format('Y-m-d H:i:s');
        return $date;
    }

    public function toUtcTime($localTime, $timezoneName){
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $localTime, $timezoneName);
        $date->setTimezone('UTC');
        $date = $date->format('Y-m-d H:i:s');
        return $date;
    }
}