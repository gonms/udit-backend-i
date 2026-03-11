<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Isbn extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'isbn_code',
        'book_id',
    ];

    /**
     * Get the book that owns the ISBN.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
