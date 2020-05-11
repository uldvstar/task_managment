<?php

use App\Classes\ValueObjects\Constants\ModularTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModularTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modular_types')->insert([
            [
                'module_type' => ModularTypes::FIELD_MODULE,
                'name' => 'Text',
                'reference' => 'string'
            ],
            [
                'module_type' => ModularTypes::FIELD_MODULE,
                'name' => 'Number',
                'reference' => 'integer'
            ],
            [
                'module_type' => ModularTypes::FIELD_MODULE,
                'name' => 'Date',
                'reference' => 'date'
            ],
            [
                'module_type' => ModularTypes::FIELD_MODULE,
                'name' => 'List',
                'reference' => 'enum'
            ],
            [
                'module_type' => ModularTypes::FIELD_MODULE,
                'name' => 'Attachment',
                'reference' => 'file'
            ],
            [
                'module_type' => ModularTypes::STATUS_LIST,
                'name' => 'Not Started',
                'reference' => 'not_start'
            ],
            [
                'module_type' => ModularTypes::STATUS_LIST,
                'name' => 'In Progress',
                'reference' => 'progress'
            ],
            [
                'module_type' => ModularTypes::STATUS_LIST,
                'name' => 'On Hold',
                'reference' => 'hold'
            ],
            [
                'module_type' => ModularTypes::STATUS_LIST,
                'name' => 'Cancelled',
                'reference' => 'cancel'
            ],
            [
                'module_type' => ModularTypes::STATUS_LIST,
                'name' => 'Under Review',
                'reference' => 'review'
            ],
            [
                'module_type' => ModularTypes::STATUS_LIST,
                'name' => 'Pending Approval',
                'reference' => 'approval'
            ],
            [
                'module_type' => ModularTypes::STATUS_LIST,
                'name' => 'Completed',
                'reference' => 'complete'
            ]
        ]);
    }
}
