@extends('layouts.master')

@section('title', 'Add Product Variant')

@section('css')
    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h4 class="mb-0">Add Product Variant</h4>
            <div class="card-body">
                <form id="productVariantForm" action="{{ route('product-variants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Parent Product -->
                    <div class="mb-3">
                        <label for="tbl_product_id" class="form-label">Product</label>
                        <select class="form-select @error('tbl_product_id') is-invalid @enderror" id="tbl_product_id" name="tbl_product_id" required>
                            <option selected disabled>
                                Select Product
                            </option>
                        
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('tbl_product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tbl_product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SKU -->
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku"
                            placeholder="Enter SKU" value="{{ old('sku') }}" >
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" 
                            placeholder="Enter price" step="0.01" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Discount Price -->
                    <div class="mb-3">
                        <label for="discount_price" class="form-label">Discount Price</label>
                        <input type="number" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price"
                            placeholder="Enter discount price" step="0.01" value="{{ old('discount_price') }}">
                        @error('discount_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stock Quantity -->
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" name="stock_quantity" 
                            placeholder="Enter stock quantity" value="{{ old('stock_quantity') }}" required>
                        @error('stock_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="img_url" class="form-label">Image</label>
                        <input type="file" class="form-control @error('img_url') is-invalid @enderror" id="img_url" name="img_url">
                        @error('img_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Active Checkbox -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Variant</button>
                        <a href="{{ route('product-variants') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Include Toastr JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#productVariantForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Clear previous errors
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Validate form fields
                let isValid = true;

                const sku = $('#sku').val();
                if (!sku) {
                    isValid = false;
                    $('#sku').addClass('is-invalid');
                    $('#sku').after('<div class="invalid-feedback">SKU is required.</div>');
                }

                const price = $('#price').val();
                if (price <= 0) {
                    isValid = false;
                    $('#price').addClass('is-invalid');
                    $('#price').after('<div class="invalid-feedback">Price must be greater than zero.</div>');
                }

                const stockQuantity = $('#stock_quantity').val();
                if (stockQuantity < 0) {
                    isValid = false;
                    $('#stock_quantity').addClass('is-invalid');
                    $('#stock_quantity').after(
                        '<div class="invalid-feedback">Stock quantity must be zero or greater.</div>');
                }

                if (isValid) {
                    this.submit(); // Submit the form if valid
                }
            });
        });
    </script>
@endsection
