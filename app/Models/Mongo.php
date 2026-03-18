<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Mongo extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'users';

    protected $fillable = ['name', 'email'];
}