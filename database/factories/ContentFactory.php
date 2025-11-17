<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $htmlBody = '
            <h3>Pengantar</h3>
            <p>' . fake()->paragraph(4) . '</p>
            
            <h3>Poin Penting</h3>
            <ul>
                <li>' . fake()->sentence() . '</li>
                <li>' . fake()->sentence() . '</li>
                <li>' . fake()->sentence() . '</li>
            </ul>

            <h3>Kesimpulan</h3>
            <p>' . fake()->paragraph(2) . '</p>
            <div class="alert alert-info">Catatan: ' . fake()->sentence() . '</div>
        ';

        return [
            'title' => fake()->sentence(3),
            'body' => $htmlBody,
        ];
    }
}
