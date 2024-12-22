@extends('layouts.master')

@section('title', 'Add Product')

@section('css')
    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h4 class="mb-0">Add Product</h4>
            <div class="card-body">
                <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            placeholder="Enter product name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter product description"
                            rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Product Category -->
                    <div class="mb-3">
                        <label for="tbl_category_id" class="form-label">Category</label>
                        <select class="form-select @error('tbl_category_id') is-invalid @enderror" id="tbl_category_id" name="tbl_category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('tbl_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tbl_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Parent Category</label>
                        <select class="form-select @error('tbl_category_id') is-invalid @enderror" id="tbl_category_id" name="tbl_category_id" required>
                            <option value="">No Parent (Top Level)</option>
                            @foreach ($categories as $category)
                                @include('admin.categories.categories-partial-order', [
                                    'category' => $category,
                                    'prefix' => '',
                                ])
                            @endforeach
                        </select>
                    </div>

                    <!-- Base Price -->
                    <div class="mb-3">
                        <label for="base_price" class="form-label">Base Price</label>
                        <input type="number" class="form-control @error('base_price') is-invalid @enderror" id="base_price" name="base_price" 
                            placeholder="Enter product base price" value="{{ old('base_price') }}" required>
                        @error('base_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Active Checkbox -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                        <a href="{{ route('products.list') }}" class="btn btn-secondary">Cancel</a>
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
            $('#productForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Clear previous errors
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Validate form fields
                let isValid = true;

                const name = $('#name').val();
                if (name.length < 1) {
                    isValid = false;
                    $('#name').addClass('is-invalid');
                    $('#name').after('<div class="invalid-feedback">Product name is required.</div>');
                }

                const price = $('#base_price').val();
                if (price <= 0) {
                    isValid = false;
                    $('#base_price').addClass('is-invalid');
                    $('#base_price').after(
                        '<div class="invalid-feedback">Base price must be greater than zero.</div>');
                }

                if (isValid) {
                    this.submit(); // Submit the form if valid
                }
            });
        });
    </script>
@endsection
