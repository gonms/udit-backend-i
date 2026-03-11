<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Libros</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; }
        .actions { display: flex; gap: 15px; margin-bottom: 25px; align-items: center; }
        .btn { padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .filter-form { display: flex; gap: 10px; align-items: center; }
        .filter-form select { padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 4px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: bold; color: #333; }
        tr:hover { background: #f8f9fa; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .empty { text-align: center; padding: 40px; color: #666; }
        .action-buttons { display: flex; gap: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Catálogo de Libros</h1>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="actions">
            <a href="{{ route('books.create') }}" class="btn">Registrar Nuevo Libro</a>
            
            <form method="GET" action="{{ route('books.index') }}" class="filter-form">
                <label for="category">Filtrar por categoría:</label>
                <select name="category" id="category" onchange="this.form.submit()">
                    <option value="">Todas las categorías</option>
                    <option value="Aventuras" {{ request('category') == 'Aventuras' ? 'selected' : '' }}>Aventuras</option>
                    <option value="Ciencia Ficción" {{ request('category') == 'Ciencia Ficción' ? 'selected' : '' }}>Ciencia Ficción</option>
                    <option value="Historia" {{ request('category') == 'Historia' ? 'selected' : '' }}>Historia</option>
                </select>
                @if(request('category'))
                    <a href="{{ route('books.index') }}" class="btn">Limpiar filtro</a>
                @endif
            </form>
        </div>

        @if($books->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>ISBN</th>
                        <th>Año</th>
                        <th>Categoría</th>
                        <th>Disponible</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>{{ $book->isbn ? $book->isbn->isbn_code : 'N/A' }}</td>
                            <td>{{ $book->publication_year }}</td>
                            <td>{{ $book->category }}</td>
                            <td>
                                @if($book->available)
                                        <span class="badge badge-success">Disponible</span>
                                @else
                                    <span class="badge badge-danger">No Disponible</span>
                                @endif
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('books.show', $book->id) }}" class="btn">Ver</a>
                                <form method="POST" action="{{ route('books.destroy', $book->id) }}" style="display: inline;" onsubmit="return confirm('¿Está seguro de que desea eliminar este libro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty">
                @if(request('category'))
                    No se encontraron libros en la categoría "{{ request('category') }}".
                @else
                    No hay libros registrados en el catálogo.
                @endif
            </div>
        @endif
    </div>
</body>
</html>
