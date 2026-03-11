<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function isbn(): HasOne
    {
        return $this->hasOne(Isbn::class);
    }

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
