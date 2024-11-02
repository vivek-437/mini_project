<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_categories extends Model
{
    use HasFactory;

    protected $table = 'tbl_categories';
    protected $fillable = [
        'tbl_category_id',
        'name',
        'description',
        'slug',
        'image_url',
        'is_active',
        'order',
        'created_at',
        'updated_at',
    ];

    public function childrenCategories()
    {
        return $this->hasMany(tbl_categories::class, 'tbl_category_id')->with('childrenCategories');
    }

    public function children()
    {
        return $this->hasMany(tbl_categories::class, 'tbl_category_id')->with('children'); // Renamed function for clarity
    }

    public function parent()
    {
        return $this->belongsTo(tbl_categories::class, 'tbl_category_id');
    }
}
