<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeTrackerResource extends JsonResource
{

    public function toArray($request)
    {
        $diff = CarbonInterval::seconds((int)Carbon::parse($this->pivot->time_end)->floatDiffInSeconds($this->pivot->time_start))->cascade();
        return [
            'time_start' => $this->pivot->time_start,
            'time_end' => $this->pivot->time_end,
            'total_time' => sprintf("%02d", (int)$diff->totalHours).':'.sprintf("%02d", $diff->minutes).':'.sprintf("%02d", $diff->seconds),
            'user' => new UserResource($this),
        ];
    }

}