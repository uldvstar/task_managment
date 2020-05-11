<?php

use Illuminate\Database\Seeder;

class TimeTrackersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TimeTracker::class, 30)->create();
    }
}
