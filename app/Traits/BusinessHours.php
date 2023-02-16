<?php

namespace App\Traits;

use Exception;
use Spatie\OpeningHours\OpeningHours;

trait BusinessHours
{
    /**
     * Check dateTime in between opening hours
     * @throws Exception
     */
    public function checkBusinessHours($dateTime): bool
    {
        $openHours = env('OPEN_HOURS');

        $openingHours = OpeningHours::create([
            'monday'     => [$openHours],
            'tuesday'    => [$openHours],
            'wednesday'  => [$openHours],
            'thursday'   => [$openHours],
            'friday'     => [$openHours],
        ]);

        return $openingHours->isOpenAt(new \DateTime($dateTime));
    }
}
