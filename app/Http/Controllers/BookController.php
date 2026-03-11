<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Muestra todos los libros
     */
    public function index(Request $request)
    {
        /* Listado de registros en el front

        $query = Book::query();
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $books = $query->get();
        
        return view('books.index', compact('books'));
        */

        /* consulta optimizada de un modelo y sus relaciones
        $books = Book::with(['author', 'isbn'])->get();
        return $books;
        */
        
        /* Si quiero acceder a los datos de mi relación:
        foreach($books as $book)
            echo "<br/>" . $book->author->name . " " . $book->author->lastname;
        */

        /* Consulta no optimizada que genera problema de Query N+1.
        Para cada autor de cada libro se hace una consulta nueva
        $books = Book::all();
        foreach ($books as $book) {
            echo $book->author->name;
        }
        */

        /* Consulta con JOIN en Query Builder
        $books = Book::query()
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->select(['books.*', 'authors.name'])
            ->get();
        return $books;
        */

        /* Consulta de relaciones como Query Builder
        $author = Author::find(1);
        return $author->books()->where('title', 'like', '%porro%')->get();
        */
    }

    /**
     * Formulario para crear nuevo libro
     */
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        return view('books.create', compact('authors'));
    }

    /**
     * Crea nuevo libro
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'category' => 'required|string|max:255',
            'available' => 'required|boolean',
            'isbn_code' => 'nullable|string|max:17|unique:isbns,isbn_code',
        ]);

        $book = Book::create([
            'title' => $validated['title'],
            'author_id' => $validated['author_id'],
            'publication_year' => $validated['publication_year'],
            'category' => $validated['category'],
            'available' => $validated['available'],
        ]);

        if (!empty($validated['isbn_code'])) {
            $book->isbn()->create([
                'isbn_code' => $validated['isbn_code'],
            ]);
        }

        return redirect()->route('books.show', $book->id);
    }

    /**
     * Detalle del libro
     */
    public function show(string $id)
    {
        $book = Book::with(['author', 'isbn'])->findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Borra un libro
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        
        return redirect()->route('books.index');
    }
}
