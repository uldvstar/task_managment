<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMilestoneTaskAssigneesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestone_task_assignees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignee_id');
            $table->string('assignee_type');
            $table->unsignedBigInteger('assignment_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('milestone_task_assignees');
    }
}
