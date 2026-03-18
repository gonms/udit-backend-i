<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowBookController extends Controller
{
    /**
     * Crear nuevo registro en la tabla intermedia (pivot) de usuarios y libros
     */
    public function new($user_id, $book_id)
    {
        $user = User::findOrFail($user_id);

        $book = Book::findOrFail($book_id);

        /**
         * Asociamos el libro a la relación de libros que ese usuario tenga y le añadimos campos extras
         */
        $user->books()->attach(
            $book->getKey(),
            ['reserved_at' => now()]
        );        

        /**
         * Si queremos quitar todos los libros relacionados que tenga el usuario y asociarle unos nuevos
         * Borraría todos los libros reservados de ese usuario y añadiría los libros con IDs 5 y 6 y para cada libro asignaría el campo reserved_at con la fecha actual
         */
        /*
        $user->books()->sync([
            5 => ['reserved_at' => now()],
            6 => ['reserved_at' => now()]
            ]);
        */
    }

    public function delete($user_id, $book_id) {
        /**
         * Desasociamos (borramos) el libro de la relación de libros que ese usuario tenga
         */
        $user = User::findOrFail($user_id);

        $book = Book::findOrFail($book_id);

        $user->books()->detach($book->getKey());
    }

    /**
     * Listar todos los libros reservados por un usuario
     */
    public function listBooks($user_id) {
        $user = User::with(['books.author', 'books.isbn'])->findOrFail($user_id);

        echo "Libros de " . $user->name;
        
        /* Recorrer una colección con la función map */
        $user->books->map(function($book) use($user) {
            echo "<br>- [" . $book->author->full_name . '] - (' . $book->isbn->isbn_code . ') - ' . $book->title;
        });

        echo "<br>";

        /* Recorrer una coleccion con bucle foreach */
        foreach ($user->books as $book) {
            echo "<br>- [" . $book->author->full_name . '] - (' . $book->isbn->isbn_code . ') - ' . $book->title;
        }

        echo "<br><br>Mis reservas: ";

        /** Recorrer una colección filtrada por un campo de la tabla intermedia (definida en el modelo User) */
        foreach ($user->reservasActivas as $book) {
            echo "<br>-" . $book->title . " reservado el " . $book->reservas->reserved_at;
        }

        foreach ($user->reservasDevueltas as $book) {
            echo "<br>-" . $book->title . " devuelto el " . $book->reservas->returned_at;
        }
    }
}
