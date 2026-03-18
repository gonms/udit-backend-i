<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relaciones M:N con nombre personalizado (reservas) y con acceso a campos de la tabla intermedia (pivot)
     */
    public function books()
    {
        return $this->belongsToMany(Book::class)
        ->as('reservas')
        ->withPivot(['reserved_at', 'returned_at']);
    }

    /**
     * Funciones basadas en relaciones filtradas por un campo de la tabla intermedia (pivot)
     */
    public function reservasActivas() {
        return $this->books()->wherePivotNull('returned_at');
    }

    public function reservasDevueltas() {
        return $this->books()->wherePivotNotNull('returned_at');
    }
}
