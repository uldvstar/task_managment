<?php

use App\Classes\ValueObjects\Constants\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => 'Omair Saleh',
                'email' => 'omair@izyim.com',
                'password' => Hash::make('123456abcabc'),
                'email_verified_at' => \Carbon\Carbon::now(),
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'Development User',
                'email' => env('EMAIL_DEVELOPMENT', 'dev@izyim.com'),
                'password' => Hash::make('123456abcabc'),
                'email_verified_at' => \Carbon\Carbon::now(),
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);

        factory(App\Models\User::class, 30)->create();
    }
}
