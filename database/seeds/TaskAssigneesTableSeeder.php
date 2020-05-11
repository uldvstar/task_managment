<?php

use Illuminate\Database\Seeder;

class TaskAssigneesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TaskAssignee::class, 30)->create();
    }
}
