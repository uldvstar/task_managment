<?php

use Illuminate\Database\Seeder;

class ProjectMilestonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ProjectMilestone::class, 30)->create();
    }
}
