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
            'title' => $this->faker->title(),
            'color' => 'red',
            'starts' => '2021-12-21 09:00:00',
            'ends' => '2021-12-21 11:00:00'
        ];
    }
}
