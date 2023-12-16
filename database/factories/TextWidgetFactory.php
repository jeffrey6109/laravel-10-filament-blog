<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TextWidget>
 */
class TextWidgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->title().'-widget',
            'image' => fake()->image(),
            'title' => fake()->title(),
            'content' => fake()->paragraph(5),
            'active' => 1
        ];
    }
}
