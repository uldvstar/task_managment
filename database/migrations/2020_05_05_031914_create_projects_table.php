<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('client_id');
            $table->string('reference');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('type_id')->references('id')->on('modular_types');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::drop('projects');
    }
}
