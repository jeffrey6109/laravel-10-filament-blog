<?php

namespace Database\Seeders;

use App\Models\TextWidget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TextWidget::factory()->create([
            'key' => 'about-us-widget',
            'title' => 'About Us',
            'content' => fake()->paragraph(3),
        ]);

        TextWidget::factory()->create([
            'key' => 'title-widget',
            'title' => 'XE-Blog',
            'content' => fake()->text(5),
        ]);
    }
}
