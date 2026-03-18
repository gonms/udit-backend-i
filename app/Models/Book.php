<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author_id',
        'publication_year',
        'category',
        'available',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'publication_year' => 'integer',
            'available' => 'boolean',
        ];
    }

    protected $appends = ['author_same_id'];

    /**
     * Relación 1:N inversa entre Author y Libros. Un libro pertenece sólo a un Author
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Relación 1:1 entre Libros y código ISBN.
     */
    public function isbn(): HasOne
    {
        return $this->hasOne(Isbn::class);
    }

    /**
     * Relación M:N básica
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Creación de un nuevo atributo para mi modelo
     * El nombre de la funcion se traduce a snake_case para acceder al atributo:
     * authorSameId => author_same_id
     */
    protected function authorSameId(): Attribute
    {
        return Attribute::make(
            get: function() {
                $author = Author::find($this->getKey());
                return $author?->name;
            }
        );
    }
}
