<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class tbl_product_variant_images extends Model
{
    use HasFactory;

    protected $table = 'tbl_product_variant_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tbl_product_variant_id',
        'img_url',
        'is_primary',
    ];

    // Define the relationship to the product variant
    public function productVariant()
    {
        return $this->belongsTo(tbl_product_variants::class, 'tbl_product_variant_id');
    }

    // Get formatted name combining product name and variant ID
    public function getFormattedNameAttribute()
    {
        if ($this->productVariant && $this->productVariant->product) {
            return $this->productVariant->product->name . ' (' . $this->productVariant->id . ')';
        }
        return 'N/A';
    }

    // Get all secondary images for this variant (non-static method)
    public function secondaryImages()
    {
        return $this->where('tbl_product_variant_id', $this->tbl_product_variant_id)
            ->where('is_primary', false)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    // Get all secondary images for a specific variant (static method)
    public static function getSecondaryImages($variantId)
    {
        return self::where('tbl_product_variant_id', $variantId)
            ->where('is_primary', false)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    // Get image URL as an asset (dynamic attribute)
    public function getImageUrlAttribute()
    {
        return asset($this->img_url);
    }

    // Scope to filter primary images
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    // Scope to filter secondary images
    public function scopeSecondary($query)
    {
        return $query->where('is_primary', false);
    }

    // Helper method to check if image exists in public directory (dynamic attribute)
    public function getImageExistsAttribute()
    {
        return File::exists(public_path($this->img_url));
    }

    // Count secondary images for a given variant ID (static method)
    public static function countSecondaryImages($variantId)
    {
        return self::where('tbl_product_variant_id', $variantId)
            ->where('is_primary', false)
            ->count();
    }

    // Delete image file from storage
    public function deleteImage()
    {
        $path = public_path($this->img_url);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    // Boot method to handle deleting image files when the model is deleted
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            $image->deleteImage();
        });
    }

    // Get full image path for storage location
    public function getFullImagePath()
    {
        return public_path($this->img_url);
    }
}
