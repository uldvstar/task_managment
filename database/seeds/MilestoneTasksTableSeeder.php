<?php

use Illuminate\Database\Seeder;

class MilestoneTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MilestoneTask::class, 30)->create();
    }
}
