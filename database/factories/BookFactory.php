<?php

// database/factories/BookFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $totalCopies = $this->faker->numberBetween(1, 10);
        $availableCopies = $this->faker->numberBetween(0, $totalCopies);

        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraphs(3, true),
            'rating' => $this->faker->randomFloat(2, 0, 5),
            'total_copies' => $totalCopies,
            'available_copies' => $availableCopies,
            'isbn' => $this->faker->unique()->isbn13(),
            'publisher' => $this->faker->company(),
            'publication_year' => $this->faker->year(),
            'category' => $this->faker->randomElement([
                'Fiction', 'Non-Fiction', 'Science', 'Technology',
                'History', 'Biography', 'Self-Help', 'Business',
                'Romance', 'Mystery', 'Fantasy', 'Science Fiction'
            ]),
            'language' => $this->faker->randomElement(['English', 'Spanish', 'French', 'German']),
            'pages' => $this->faker->numberBetween(100, 1000),
            'status' => $availableCopies > 0 ? 'available' : 'unavailable',
        ];
    }
}