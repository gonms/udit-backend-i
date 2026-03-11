<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Isbn;
use Illuminate\Database\Seeder;

class AuthorBooksIsbnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 5 autores, cada uno con varios libros y cada libro con su ISBN
        Author::factory()
            ->count(5)
            ->has(
                Book::factory()
                    ->count(3) // Cada autor tendrá 3 libros
                    ->has(Isbn::factory()) // Cada libro tendrá un ISBN
            )
            ->create();
    }
}
