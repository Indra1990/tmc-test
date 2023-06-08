<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Categories extends Model
{
    use HasUuids;

    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'created_by'
    ];

}
