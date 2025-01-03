<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_product_variants extends Model
{
    use HasFactory;
    protected $table = "tbl_product_variants";

    protected $fillable = ['tbl_product_id', 'sku', 'price', 'discount_price', 'stock_quantity', 'img_url', 'is_active'];

    public function product()
    {
        return $this->belongsTo(tbl_products::class, 'tbl_product_id');
    }

    public function attributes()
    {
        return $this->hasMany(tbl_product_variant_attribute_values::class, 'tbl_product_variant_id');
    }

    public function images()
    {
        return $this->hasMany(tbl_product_variant_images::class, 'tbl_product_variant_id');
    }
}
