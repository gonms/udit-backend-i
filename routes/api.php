<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BooksApiController;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;

/** middleware es la capa que se carga entre la petición del usuario al servidor y la respuesta que obtiene.
 * auth:sanctum es el middleware de autenticación Sanctum que usa Laravel.
 * Cualquier ruta con este middleware tendrá que ir autenticado con un token de sesión.
*/
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Ruta de prueba para probar Postman. Al estar en el fichero api.php, toda URL tendrá el prefijo /api
 * En este caso la URL del endpoint es: http://localhost:8001/api/test
 * Lo que hace es cachear toda la colección de Books y devolverlos como un JSON.
 */
Route::get('/test', function() {
    //return response('Hola Mundo');
    return Cache::remember('books', 60, function() {
        return Book::all();
    });
});

/**
 * Si queremos que Laravel nos cree todas las rutas de nuestro Resource, lo hacemos con estas funciones,
 * indicándole el nombre de nuestra URI, y el controlador al que irán todos los endpoints.
 * 
 * Route::resource va a crear las rutas para el formulario de creación y el formulario de edición.
 * Route::apiResource solo va a crear las rutas para todas las acciones del recurso, sin tener que crear formularios en vistas.
 * 
 * Haciendo un php artisan route:list veremos todas las rutas creadas, con sus verbos HTTP correspondientes.
 */
Route::resource('/books', BookController::class);
Route::apiResource('/books-api', BooksApiController::class);
