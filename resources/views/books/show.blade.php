<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Libro</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 700px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 25px; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 4px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .detail-card { background: #f8f9fa; padding: 25px; border-radius: 6px; margin-bottom: 25px; }
        .detail-row { display: flex; margin-bottom: 15px; border-bottom: 1px solid #dee2e6; padding-bottom: 12px; }
        .detail-row:last-child { border-bottom: none; margin-bottom: 0; }
        .detail-label { font-weight: bold; color: #555; width: 180px; flex-shrink: 0; }
        .detail-value { color: #333; flex: 1; }
        .badge { padding: 6px 12px; border-radius: 4px; font-size: 14px; display: inline-block; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 12px 24px; color: white; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; font-size: 16px; display: inline-block; }
        .btn-primary { background: #007bff; }
        .btn-primary:hover { background: #0056b3; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles del Libro</h1>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="detail-card">
            <div class="detail-row">
                <div class="detail-label">ID:</div>
                <div class="detail-value">{{ $book->id }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Título:</div>
                <div class="detail-value">{{ $book->title }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Autor:</div>
                <div class="detail-value">{{ $book->author->name }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nacionalidad del Autor:</div>
                <div class="detail-value">{{ $book->author->nationality ?? 'No especificada' }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Año de Nacimiento:</div>
                <div class="detail-value">{{ $book->author->birth_year ?? 'No especificado' }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">ISBN:</div>
                <div class="detail-value">{{ $book->isbn ? $book->isbn->isbn_code : 'No asignado' }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Año de Publicación:</div>
                <div class="detail-value">{{ $book->publication_year }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Categoría:</div>
                <div class="detail-value">{{ $book->category }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Disponible:</div>
                <div class="detail-value">
                    <span class="badge {{ $book->available ? 'badge-success' : 'badge-danger' }}">
                        {{ $book->available ? 'Sí' : 'No' }}
                    </span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Fecha de Registro:</div>
                <div class="detail-value">{{ $book->created_at->format('d/m/Y H:i') }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Última Actualización:</div>
                <div class="detail-value">{{ $book->updated_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Volver al Listado</a>
            <form method="POST" action="{{ route('books.destroy', $book->id) }}" style="display: inline;" onsubmit="return confirm('¿Está seguro de que desea eliminar este libro? Esta acción no se puede deshacer.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Libro</button>
            </form>
        </div>
    </div>
</body>
</html>
