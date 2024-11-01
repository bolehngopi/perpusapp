<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'isbn' => $this->faker->isbn13(),
            'title' => $this->faker->sentence(4),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'publication_year' => $this->faker->year(),
            'genre' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'total_copies' => $this->faker->numberBetween(1, 10),
            'available_copies' => $this->faker->numberBetween(0, 10),
            'location' => $this->faker->word(),
            'language' => $this->faker->languageCode(),
            'is_reference_only' => $this->faker->boolean()
        ];
    }
}
