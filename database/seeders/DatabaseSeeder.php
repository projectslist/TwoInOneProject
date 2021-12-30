<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\ToDo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(CalendarSeeder::class);
        $this->call(ToDoSeeder::class);


    }
}
