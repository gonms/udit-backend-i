<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 5 libros de Aventuras (3 disponibles, 2 no disponibles)
        Book::factory()->count(3)->aventuras()->available()->create();
        Book::factory()->count(2)->aventuras()->unavailable()->create();

        // Crear 5 libros de Ciencia Ficción (4 disponibles, 1 no disponible)
        Book::factory()->count(4)->cienciaFiccion()->available()->create();
        Book::factory()->count(1)->cienciaFiccion()->unavailable()->create();

        // Crear 5 libros de Historia (3 disponibles, 2 no disponibles)
        Book::factory()->count(3)->historia()->available()->create();
        Book::factory()->count(2)->historia()->unavailable()->create();

        // Total: 15 libros (10 disponibles, 5 no disponibles)
        // Distribución: 5 Aventuras, 5 Ciencia Ficción, 5 Historia
    }
}
