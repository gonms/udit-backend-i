<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, //Para poder usar su Factory y crear datos
    SoftDeletes; //Para permitir borrados lógicos creando el campo deleted_at

    /**
     * Si quiero cambiar el nombre de la tabla del modelo.
     * Por convención, Laravel coge el nombre del modelo y busca la tabla que se llame igual pero en plural:
     * Author => tabla authors
     */
    //protected $table = 'authors';

    /**
     * Si quiero cambiar el nombre de mi primary key.
     * Por convención, Laravel usa el nombre id
     */
    //protected $primaryKey = 'id';

    /**
     * Si hemos creado la tabla con timestamps, pero al final no queremos usar los campos created_at y updated_at
     */
    //public $timestamps = false;

    /**
     * Atributos que permito rellenar para crear un registro
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birth_year',
        'nationality',
    ];

    /**
     * Atributos a los que quiero cambiar o establecer el tipo de datos
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_year' => 'integer',
        ];
    }

    /**
     * Atributos que he añadido y quiero mostrar en mi listado de registros
     */
    protected $appends = ['full_name'];

    /**
     * Atributos que no quiero mostrar en mi listado de registros
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Atributos a los que quiero establecer un valor por defecto si no viene relleno en la creación
     */

    protected $attributes = ['nationality' => 'Spanish'];


    /**
     * Relación 1:N entre Author y Libros
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Creación de un nuevo atributo para mi modelo
     * El nombre de la funcion se traduce a snake_case para acceder al atributo:
     * fullName => full_name
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->name . " " . $this->lastname;
            }
        );
    }

    /**
     * Modificación del valor de un atributo de mi tabla.
     * El nombre de la función debe coincidir con el nombre del campo en la tabla
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                return $value . "-modificado";
            }
        );
    }
}
