<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class SolutionFunctionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $solTypes = [
            [
            'user_id' => 1,
            'name' => 'Problem is replaced by solution through solution function',
            'first_arr' => 'is replaced by',
            'second_arr' => 'through' 
            ],
            [
            'user_id' => 1,
            'name' => 'Problem is substituted by solution from solution function',
            'first_arr' => 'is substituted by',
            'second_arr' => 'from' 
            ],
            [
            'user_id' => 1,
            'name' => 'Problem is solved by solution from solution function',
            'first_arr' => 'is solved by',
            'second_arr' => 'from' 
            ],
        
        ];

       DB::table('solution_function_types')->insert($solTypes);
    }
}
