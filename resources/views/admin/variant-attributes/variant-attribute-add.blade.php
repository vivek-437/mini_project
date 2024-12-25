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
                <form id="variantAttributeForm" action="{{ route('variant-attributes.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Attribute Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Enter name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Variant</button>
                        <a href="{{ route('variant-attributes') }}" class="btn btn-secondary">Cancel</a>
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
            $('#variantAttributeForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Clear previous errors
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Validate form fields
                let isValid = true;

                const name = $('#name').val();
                if (!name) {
                    isValid = false;
                    $('#name').addClass('is-invalid');
                    $('#name').after('<div class="invalid-feedback">name is required.</div>');
                }

                if (isValid) {
                    this.submit(); // Submit the form if valid
                }
            });
        });
    </script>
@endsection
