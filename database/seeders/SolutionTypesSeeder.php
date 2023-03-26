<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SolutionType;
use DB;
class SolutionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $solTypes = [[
            'user_id' => 1,
            'name' => 'Cross out problem equal solution',
            'output_slug' => 'cross out equal' 
        ],
        [
            'user_id' => 1,
            'name' => 'Problem is replaced by Solution',
            'output_slug' => 'is replaced by' 
        ],
        [
            'user_id' => 1,
            'name' => 'Problem is substituted by Solution',
            'output_slug' => 'Is substituted by' 
        ],
        [
            'user_id' => 1,
            'name' => 'Problem (cross out after) equal solution',
            'output_slug' => 'crossed out after' 
        ],
        [
            'user_id' => 1,
            'name' => 'Problem is solved by Solution',
            'output_slug' => 'is solved by' 
        ]
        ];

       DB::table('solution_types')->insert($solTypes);
    }
}
