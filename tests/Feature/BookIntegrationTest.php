<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test complete book management flow: Create → List → View → Delete
     * 
     * @test Feature: book-management-system
     * Validates: Requirements 1.1, 2.1, 3.1, 5.1
     */
    public function test_complete_book_management_flow(): void
    {
        // Step 1: Create a book
        $bookData = [
            'title' => 'El Quijote',
            'author' => 'Miguel de Cervantes',
            'publication_year' => 1605,
            'category' => 'Aventuras',
            'available' => true
        ];

        $response = $this->post(route('books.store'), $bookData);
        $response->assertRedirect();
        
        // Get the created book
        $book = Book::where('title', 'El Quijote')->first();
        $this->assertNotNull($book);
        
        // Step 2: List books and verify the created book appears
        $response = $this->get(route('books.index'));
        $response->assertStatus(200);
        $response->assertSee('El Quijote');
        $response->assertSee('Miguel de Cervantes');
        
        // Step 3: View book details
        $response = $this->get(route('books.show', $book->id));
        $response->assertStatus(200);
        $response->assertSee('El Quijote');
        $response->assertSee('Miguel de Cervantes');
        $response->assertSee('1605');
        $response->assertSee('Aventuras');
        
        // Step 4: Delete the book
        $response = $this->delete(route('books.destroy', $book->id));
        $response->assertRedirect(route('books.index'));
        
        // Verify the book no longer exists
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
        
        // Verify the book doesn't appear in the list
        $response = $this->get(route('books.index'));
        $response->assertStatus(200);
        $response->assertDontSee('El Quijote');
    }

    /**
     * Test empty catalog message
     * 
     * @test Feature: book-management-system
     * Validates: Requirements 2.3
     */
    public function test_empty_catalog_shows_message(): void
    {
        // Ensure database is empty
        Book::query()->delete();
        
        // Request the book list
        $response = $this->get(route('books.index'));
        
        $response->assertStatus(200);
        // The view should show a message indicating the catalog is empty
        // Based on the requirements, this message should be in Spanish
        $response->assertSee('No hay libros registrados');
    }
}
