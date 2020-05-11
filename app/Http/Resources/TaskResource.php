<?php

namespace App\Http\Resources;

use App\Models\ProjectMilestone;
use App\Models\Task;
use App\Models\TimeTracker;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total = CarbonInterval::seconds((int)$this->trackers->sum(function($value){
            return Carbon::parse($value->pivot->time_end)->floatDiffInSeconds($value->pivot->time_start);
        }))->cascade();

        return [
            'id' => $this->id,
            'milestone' => new ProjectMilestoneResource($this->milestone),
            'business_service' => new ModularTypeResource($this->milestone->project->projectType),
            'type_id' => $this->type_id,
            'task_type' => new ModularTypeResource($this->taskType),
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'current_status' => $this->currentStatus->name,
            'active' => $this->active,
            'comments' => CommentResource::collection($this->comments),
            'total_time' => sprintf("%02d", (int)$total->totalHours).':'.sprintf("%02d", $total->minutes).':'.sprintf("%02d", $total->seconds),
            'time_tracker' => TimeTrackerResource::collection($this->trackers),
            'user_active_tracker' => timeTracker::where('trackable_type', Task::class)->where('trackable_id', $this->id)
                ->where('user_id', Auth::user()->getAuthIdentifier())->where('time_end', null)->exists(),
            'assignees' => [
                'departments' => DepartmentResource::collection($this->departments),
                'users' => UserResource::collection($this->users)
            ]
        ];
    }
}
