<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_product_variant_attribute_values extends Model
{
    use HasFactory;
    protected $table = 'tbl_product_variant_attribute_values';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'tbl_product_variant_id',
        'tbl_variant_attribute_id',
        'value',
    ];

    // Relationship to Product Variant
    public function productVariant()
    {
        return $this->belongsTo(tbl_product_variants::class, 'tbl_product_variant_id');
    }

    // Relationship to Variant Attribute
    public function variantAttribute()
    {
        return $this->belongsTo(tbl_variant_attributes::class, 'tbl_variant_attribute_id');
    }
}
