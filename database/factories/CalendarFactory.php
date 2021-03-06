<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            //
            'title' => $this->faker->words(2,4),
            'color' => 'green',
            'starts' => '2022-01-06 09:00:00',
            'ends' => '2022-01-06  11:00:00'
        ];
    }
}
