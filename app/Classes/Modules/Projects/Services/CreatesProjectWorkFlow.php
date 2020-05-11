<?php

namespace App\Classes\Modules\Projects\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\Milestones\Services\ListsMilestones;
use App\Classes\Modules\Projects\DataTransferObjects\ProjectObject;
use App\Models\Department;
use App\Models\Project;
use App\Models\ProjectMilestone;
use App\Models\Task;
use App\Models\TaskAssignee;
use App\Models\User;

class CreatesProjectWorkFlow
{

    /** @var ListsMilestones */
    private $listsMilestones;

    /**
     * CreatesProjectWorkFlow constructor.
     * @param ListsMilestones $listsMilestones
     */
    public function __construct(ListsMilestones $listsMilestones)
    {
        $this->listsMilestones = $listsMilestones;
    }


    public function execute($project) {
        $first = true;
        foreach($this->listsMilestones->handler(['project_type' => $project->type_id]) as $milestone){
            $newMilestone = ProjectMilestone::create(['project_id' => $project->id, 'name' => $milestone->name, 'order' => $milestone->order, 'complete' => false]);
            foreach($milestone->tasks as $task){
                /** @var Task $newTask */
                $newTask = Task::create(['milestone_id' => $newMilestone->id, 'type_id' => $task->type_id, 'title' => $task->title, 'description' => $task->description, 'status' => $first ? 7:6, 'active' => $first]);
                $first = false;
                foreach($task->departments as $department) {
                    $newTask->departments()->attach($department->id);
                }
                foreach($task->users as $user){
                    $newTask->users()->attach($user->id);
                }
            }
        }

    }
}