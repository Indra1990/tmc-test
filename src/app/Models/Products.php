<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasUuids;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'sku',
        'name',
        'price',
        'stock',
        'category_id',
        'created_by'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, "category_id");
    }
}
