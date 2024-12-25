<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_variant_attributes extends Model
{
    use HasFactory;
    protected $table = "tbl_variant_attributes";
    protected $fillable = ['name'];
}
