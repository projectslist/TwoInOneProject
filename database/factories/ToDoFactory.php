<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ToDoFactory extends Factory
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
            'status' => $this->faker->numberBetween(0,2),
        ];
    }
}
