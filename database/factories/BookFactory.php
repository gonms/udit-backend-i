<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Aventuras', 'Ciencia Ficción', 'Historia'];
        
        return [
            'title' => fake()->sentence(rand(2, 5)),
            'author_id' => Author::factory(),
            'publication_year' => fake()->numberBetween(1950, date('Y')),
            'category' => fake()->randomElement($categories),
            'available' => fake()->boolean(70),
        ];
    }

    /**
     * Indicate that the book is available.
     */
    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'available' => true,
        ]);
    }

    /**
     * Indicate that the book is not available.
     */
    public function unavailable(): static
    {
        return $this->state(fn (array $attributes) => [
            'available' => false,
        ]);
    }

    /**
     * Set the book category to Aventuras.
     */
    public function aventuras(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'Aventuras',
        ]);
    }

    /**
     * Set the book category to Ciencia Ficción.
     */
    public function cienciaFiccion(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'Ciencia Ficción',
        ]);
    }

    /**
     * Set the book category to Historia.
     */
    public function historia(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'Historia',
        ]);
    }
}
