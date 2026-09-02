<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id_user',
        'name',
        'price',
        'id_category',
        'id_brand',
        'status',
        'sale',
        'company',
        'image',
        'detail'
    ];
    public function images()
    {
    return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function brand()
{
    return $this->belongsTo(Brand::class, 'id_brand');
}
}
