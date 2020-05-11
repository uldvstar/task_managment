<?php

namespace App\Http\Controllers\Tasks;


use App\Classes\ValueObjects\Constants\HttpStatus;
use App\Classes\ValueObjects\Response\ApiResponseObject;
use App\Models\ProjectMilestone;
use App\Models\Task;
use App\Models\TimeTracker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeTrackerController
{

    public function start(int $taskId){
        $task = Task::find($taskId);
        $task->trackers()->attach(Auth::user()->getAuthIdentifier(), ['time_start' => Carbon::now()]);

        return (new ApiResponseObject('Timer Started Successfully',
            'You have successfully started the task timer',
            HttpStatus::OK_WITH_MESSAGE, []))->handler();
    }

    public function stop(int $taskId){
        $tracker = timeTracker::where('trackable_type', Task::class)->where('trackable_id', $taskId)
            ->where('user_id', Auth::user()->getAuthIdentifier())->where('time_end', null)->first();
        $tracker->time_end = Carbon::now();
        $tracker->save();

        return (new ApiResponseObject('Timer Stopped Successfully',
            'You have successfully stopped the task timer',
            HttpStatus::OK_WITH_MESSAGE, []))->handler();
    }

    public function completeTask(int $taskId){

        $tracker = timeTracker::where('trackable_type', Task::class)->where('trackable_id', $taskId)
            ->where('user_id', Auth::user()->getAuthIdentifier())->where('time_end', null)->first();
        $tracker->time_end = Carbon::now();
        $tracker->save();

        $task = Task::find($taskId);
        // changes status to complete
        $task->status = 12;
        $task->save();

        $milestone = ProjectMilestone::find($task->milestone_id);
        $milestonPendingTasks = Task::where('milestone_id', $task->milestone_id)->where('status', '!=', 12);

        if(!$milestonPendingTasks->exists()){
            $milestone->complete = true;
            $milestone->save();
        }

        $project = $milestone->project->first();
        $projectPendingTasks = $project->tasks->where('status', '!=', 12);

        if(!$projectPendingTasks->count()){
            $project->status = 12;
            $project->save();
        } else {
            $nextTask = $projectPendingTasks->first();
            $nextTask->status = 7;
            $nextTask->active = true;
            $nextTask->save();
        }

        return (new ApiResponseObject('Task Completed Successfully',
            'You have successfully completed the task',
            HttpStatus::OK_WITH_MESSAGE, []))->handler();

    }

}