<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tbl_product_variant_images;
use App\Models\tbl_product_variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductVariantImagesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch product variant images with necessary relationships
            $data = tbl_product_variant_images::with(['productVariant.product'])
                ->select('tbl_product_variant_id', 'img_url', 'is_primary', 'id', 'updated_at') // Select necessary columns
                ->get()
                ->groupBy('tbl_product_variant_id') // Group by product_variant_id
                ->map(function ($images) {
                    $images = collect($images); // Convert to a collection

                    // Separate primary and secondary images
                    $primaryImage = $images->firstWhere('is_primary', true);
                    $secondaryImages = $images->where('is_primary', false);

                    // Fetch the latest updated_at from all images
                    $updatedAt = $images->pluck('updated_at')->max();

                    return [
                        'primary_image' => $primaryImage, // Primary image object
                        'secondary_images' => $secondaryImages, // Collection of secondary images
                        'updated_at' => $updatedAt, // Latest updated_at from all images
                    ];
                });

            return datatables()->of($data)
                ->addIndexColumn()

                // Product Variant Column
                ->addColumn('product_variant', function ($row) {
                    $primaryImage = $row['primary_image'];
                    if ($primaryImage && $primaryImage->productVariant && $primaryImage->productVariant->product) {
                        return $primaryImage->productVariant->product->name . ' (' . $primaryImage->productVariant->id . ')';
                    }
                    return 'N/A';
                })

                // Primary Image Column
                ->addColumn('primary_image', function ($row) {
                    $primaryImage = $row['primary_image'];
                    if ($primaryImage) {
                        $imageUrl = asset($primaryImage->img_url);
                        return '
                            <div class="image-container position-relative d-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                                <img src="' . $imageUrl . '" 
                                     alt="Primary Image" 
                                     class="img-thumbnail" 
                                     style="object-fit: contain; max-width: 100%; max-height: 100%; cursor: pointer;"
                                     onclick="viewImage(\'' . $imageUrl . '\')">
                                <span class="badge bg-primary position-absolute top-0 start-0">Primary</span>
                            </div>';
                    }
                    return '<span class="badge bg-secondary">No Image</span>';
                })

                // Secondary Images Column
                ->addColumn('secondary_images', function ($row) {
                    $secondaryImages = $row['secondary_images'];
                    if ($secondaryImages->isNotEmpty()) {
                        $carouselId = 'carousel-' . $row['primary_image']->tbl_product_variant_id;
                        $carouselItems = $secondaryImages->map(function ($image, $index) {
                            $imageUrl = asset($image->img_url);
                            return '
                                <div class="carousel-item ' . ($index === 1 ? 'active' : '') . '">
                                    <img src="' . $imageUrl . '" 
                                         class="d-block w-100" 
                                         alt="Secondary Image"
                                         style="object-fit: contain; max-width: 100%; max-height: 100%; cursor: pointer;"
                                         onclick="viewImage(\'' . $imageUrl . '\')">
                                    <div class="carousel-caption d-none d-md-block">
                                        <span class="badge bg-info">' . ($index) . '</span>
                                    </div>
                                </div>';
                        })->implode('');
                        return '
                            <div id="' . $carouselId . '" class="carousel slide" data-bs-ride="carousel" style="max-width: 150px;">
                                <div class="carousel-inner">' . $carouselItems . '</div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>';
                    }
                    return '<span class="badge bg-secondary">No Secondary Images</span>';
                })

                // Updated At Column
                ->addColumn('updated_at', function ($row) {
                    if ($row['updated_at']) {
                        return \Carbon\Carbon::parse($row['updated_at'])->format('d M Y') ; // Format the date as needed
                    }
                    return '<span class="badge bg-secondary">N/A</span>';
                })

                // Image Count Column
                ->addColumn('image_count', function ($row) {
                    $secondaryCount = $row['secondary_images']->count();
                    return '<span class="badge bg-info">Primary: ' . ($row['primary_image'] ? '1' : '0') . ' | Secondary: ' . $secondaryCount . '</span>';
                })

                // Action Buttons Column
                ->addColumn('action', function ($row) {
                    $primaryImage = $row['primary_image'];
                    if ($primaryImage) {
                        return '
                            <div class="btn-group" role="group">
                                <button type="button" 
                                        class="btn btn-sm btn-warning edit-button" 
                                        data-id="' . $primaryImage->id . '" 
                                        data-variant-id="' . $primaryImage->tbl_product_variant_id . '"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" 
                                        class="btn btn-sm btn-danger delete-button" 
                                        data-id="' . $primaryImage->id . '" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>';
                    }
                    return '<span class="badge bg-secondary">No Actions</span>';
                })

                // Enable raw HTML for specific columns
                ->rawColumns(['primary_image', 'secondary_images', 'action', 'image_count', 'updated_at'])
                ->make(true);
        }


        return view('admin.product-variant-images.product-variant-images-list');
    }




    public function create()
    {
        $productVariants = tbl_product_variants::leftJoin('tbl_products', 'tbl_product_variants.tbl_product_id', '=', 'tbl_products.id') // Corrected column name and join condition
            ->select('tbl_product_variants.*', 'tbl_products.name as product_name') // Select product variant data and product name
            ->get(); // Fetch all product variants with the associated product name
        return view('admin.product-variant-images.product-variant-images-add', compact('productVariants'));
    }


    public function store(Request $request)
    {
        // Enhanced validation with custom messages
        $validator = Validator::make($request->all(), [
            'product_variant_id' => 'required|exists:tbl_product_variants,id',
            'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'secondary_images' => 'nullable|array',
            'secondary_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'primary_image.required' => 'A primary image is required.',
            'primary_image.max' => 'The primary image size must not exceed 2MB.',
            'secondary_images.*.image' => 'All secondary images must be valid image files.',
            'secondary_images.*.max' => 'Each secondary image must not exceed 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            return DB::transaction(function () use ($request) {
                // Get product variant with product name
                $productVariant = tbl_product_variants::leftJoin('tbl_products', 'tbl_product_variants.tbl_product_id', '=', 'tbl_products.id')
                    ->select(
                        'tbl_product_variants.*',
                        'tbl_products.name as product_name',
                        DB::raw('CONCAT(tbl_products.name, "_", tbl_product_variants.id) as product_variant_name')
                    )
                    ->where('tbl_product_variants.id', $request->product_variant_id)
                    ->first();

                if (!$productVariant) {
                    throw new \Exception('Product variant not found');
                }

                // Define constants
                $basePath = 'product/product_variant_images/';
                $publicPath = public_path($basePath);

                // Ensure directory exists with proper permissions
                if (!File::exists($publicPath)) {
                    File::makeDirectory($publicPath, 0755, true);
                }

                // Handle primary image
                $primaryImage = $this->saveImage(
                    $request->file('primary_image'),
                    $publicPath,
                    $basePath,
                    'primary',
                    $productVariant->product_variant_name
                );

                // Create primary image record
                $primaryImageRecord = tbl_product_variant_images::create([
                    'tbl_product_variant_id' => $request->product_variant_id,
                    'img_url' => $primaryImage['path'],
                    'is_primary' => true,
                ]);

                // Handle secondary images
                $secondaryImages = [];
                if ($request->hasFile('secondary_images')) {
                    foreach ($request->file('secondary_images') as $index => $image) {
                        $savedImage = $this->saveImage(
                            $image,
                            $publicPath,
                            $basePath,
                            'secondary',
                            $productVariant->product_variant_name
                        );

                        $secondaryImages[] = tbl_product_variant_images::create([
                            'tbl_product_variant_id' => $request->product_variant_id,
                            'img_url' => $savedImage['path'],
                            'is_primary' => false,
                        ]);
                    }
                }

                // Return success response
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product variant images added successfully!',
                    'data' => [
                        'primary_image' => $primaryImageRecord,
                        'secondary_images' => $secondaryImages
                    ]
                ], 201);
            });
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while saving the images.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Helper method to save image files
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $publicPath
     * @param string $basePath
     * @param string $prefix
     * @param string $productVariantName
     * @return array
     */
    private function saveImage($file, $publicPath, $basePath, $prefix = '', $productVariantName = '')
    {
        // Sanitize product variant name for filename (remove special characters)
        $sanitizedName = preg_replace('/[^A-Za-z0-9_-]/', '', $productVariantName);

        // Generate unique filename with product name and variant ID
        $filename = $sanitizedName . '_' .
            $prefix . '_' .
            uniqid() . '_' .
            time() . '.' .
            $file->getClientOriginalExtension();

        // Move file to storage
        $file->move($publicPath, $filename);

        return [
            'filename' => $filename,
            'path' => $basePath . $filename
        ];
    }

    public function getAttributeValues($id)
    {
        // Fetch the attribute values for the given product variant ID
        $data = DB::table('tbl_product_variant_attribute_values')
            ->where('tbl_product_variant_attribute_values.tbl_product_variant_id', $id)
            ->leftJoin('tbl_variant_attributes', 'tbl_product_variant_attribute_values.tbl_variant_attribute_id', '=', 'tbl_variant_attributes.id')
            ->select(
                'tbl_variant_attributes.name as name',
                'tbl_product_variant_attribute_values.value as value'
            )
            ->get(); // Execute the query to fetch data

        return response()->json($data); // Return the data as JSON
    }
}
