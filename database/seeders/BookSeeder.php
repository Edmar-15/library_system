<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample books with realistic data
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A classic American novel set in the Jazz Age that explores themes of decadence, idealism, and social upheaval.',
                'rating' => 4.5,
                'total_copies' => 5,
                'available_copies' => 3,
                'isbn' => '9780743273565',
                'publisher' => 'Scribner',
                'publication_year' => 1925,
                'category' => 'Fiction',
                'language' => 'English',
                'pages' => 180,
                'status' => 'available',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'A gripping tale of racial injustice and childhood innocence in the American South.',
                'rating' => 4.8,
                'total_copies' => 4,
                'available_copies' => 2,
                'isbn' => '9780061120084',
                'publisher' => 'Harper Perennial',
                'publication_year' => 1960,
                'category' => 'Fiction',
                'language' => 'English',
                'pages' => 324,
                'status' => 'available',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'A dystopian social science fiction novel exploring surveillance, truth, and individualism.',
                'rating' => 4.7,
                'total_copies' => 6,
                'available_copies' => 4,
                'isbn' => '9780451524935',
                'publisher' => 'Signet Classic',
                'publication_year' => 1949,
                'category' => 'Science Fiction',
                'language' => 'English',
                'pages' => 328,
                'status' => 'available',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'description' => 'A romantic novel of manners that satirizes the British landed gentry at the end of the 18th century.',
                'rating' => 4.6,
                'total_copies' => 3,
                'available_copies' => 1,
                'isbn' => '9780141439518',
                'publisher' => 'Penguin Classics',
                'publication_year' => 1813,
                'category' => 'Romance',
                'language' => 'English',
                'pages' => 432,
                'status' => 'available',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'description' => 'A fantasy novel about the quest of home-loving Bilbo Baggins to win a share of treasure guarded by a dragon.',
                'rating' => 4.9,
                'total_copies' => 5,
                'available_copies' => 0,
                'isbn' => '9780547928227',
                'publisher' => 'Mariner Books',
                'publication_year' => 1937,
                'category' => 'Fantasy',
                'language' => 'English',
                'pages' => 310,
                'status' => 'unavailable',
            ],
        ];

        foreach ($books as $bookData) {
            Book::create($bookData);
        }

        // Create additional random books
        Book::factory(20)->create();
    }
}
