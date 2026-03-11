<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Libro</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        input:focus, select:focus { outline: none; border-color: #007bff; }
        .error { color: #dc3545; font-size: 13px; margin-top: 5px; }
        .btn { padding: 12px 24px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .btn:hover { background: #0056b3; }
        .btn-secondary { background: #6c757d; margin-left: 10px; text-decoration: none; display: inline-block; }
        .btn-secondary:hover { background: #5a6268; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .required { color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Nuevo Libro</h1>

        <form method="POST" action="{{ route('books.store') }}">
            @csrf

            <div class="form-group">
                <label for="title">Título <span class="required">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="author_id">Autor <span class="required">*</span></label>
                <select id="author_id" name="author_id" required>
                    <option value="">Seleccione un autor</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }} ({{ $author->nationality }})
                        </option>
                    @endforeach
                </select>
                @error('author_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="isbn_code">Código ISBN</label>
                <input type="text" id="isbn_code" name="isbn_code" value="{{ old('isbn_code') }}" placeholder="978-X-XX-XXXXXX-X" maxlength="17">
                <small style="color: #666; font-size: 12px;">Formato: 978-X-XX-XXXXXX-X (opcional)</small>
                @error('isbn_code')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="publication_year">Año de Publicación <span class="required">*</span></label>
                <input type="number" id="publication_year" name="publication_year" value="{{ old('publication_year') }}" min="1000" max="{{ date('Y') }}" required>
                @error('publication_year')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Categoría <span class="required">*</span></label>
                <select id="category" name="category" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="Aventuras" {{ old('category') == 'Aventuras' ? 'selected' : '' }}>Aventuras</option>
                    <option value="Ciencia Ficción" {{ old('category') == 'Ciencia Ficción' ? 'selected' : '' }}>Ciencia Ficción</option>
                    <option value="Historia" {{ old('category') == 'Historia' ? 'selected' : '' }}>Historia</option>
                </select>
                @error('category')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="available">Disponible <span class="required">*</span></label>
                <select id="available" name="available" required>
                    <option value="">Seleccione disponibilidad</option>
                    <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('available')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="actions">
                <button type="submit" class="btn">Registrar Libro</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
