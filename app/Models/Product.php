<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'produits'; 

    protected $fillable = ['name', 'genre', 'sizes', 'image', 'price', 'stock','description', 'user_id', 'category_id'];

    protected $casts = [
        'sizes' => 'array',  
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
