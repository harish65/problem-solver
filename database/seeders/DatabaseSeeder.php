<?php
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;

 
class DatabaseSeeder extends Seeder
{
 
 
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SolutionTypesSeeder::class,
            SolutionFunctionTypesSeeder::class
        ]);
    }
}
