<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Movement::factory(10)->create();

    }
    
}
