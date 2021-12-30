<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ToDoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\ToDo::factory(10)->create();
    }
}
