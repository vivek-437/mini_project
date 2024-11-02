@extends('layouts.master')
@section('title', 'Add Product Category')
@section('css')
    <!-- Include Toastr CSS -->
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h4 class="mb-0">Add Product Category</h4>
            <div class="card-body">
                <form id="categoryForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter category name" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter category description"
                            rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            placeholder="Enter unique slug" required>
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Parent Category</label>
                        <select class="form-select" id="order" name="tbl_category_id">
                            <option value="">No Parent (Top Level)</option>
                            @foreach ($categories as $category)
                                @include('admin.categories.categories-partial-order', [
                                    'category' => $category,
                                    'prefix' => '',
                                ])
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                        <a href="{{ route('categories.list') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Include Toastr JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categoryForm').on('submit', function(e) {
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
                    $('#name').after('<div class="invalid-feedback">Category name is required.</div>');
                }

                const slug = $('#slug').val();
                if (slug.length < 1) {
                    isValid = false;
                    $('#slug').addClass('is-invalid');
                    $('#slug').after('<div class="invalid-feedback">Slug is required.</div>');
                }

                if (isValid) {
                    this.submit(); // Submit the form if valid
                }
            });

        
        });
    </script>
@endsection
