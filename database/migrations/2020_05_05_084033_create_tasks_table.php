<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('milestone_id');
            $table->unsignedBigInteger('type_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('status');
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('milestone_id')->references('id')->on('project_milestones');
            $table->foreign('type_id')->references('id')->on('modular_types');
            $table->foreign('status')->references('id')->on('modular_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
