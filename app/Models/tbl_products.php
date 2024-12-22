<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_products extends Model
{
    use HasFactory;

    protected $table = 'tbl_products';
    protected $fillable = [
        'tbl_category_id',
        'name',
        'description',
        'base_price',
        'is_active',
        'created_at',
        'updated_at',
    ];
    public function category()
    {
        return $this->belongsTo(tbl_categories::class, 'tbl_category_id');
    }
}
