@extends('layouts.master')

@section('title', 'Add Product Variant Images')

@section('css')
    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h4 class="mb-0">Add Product Variant Images</h4>
            <div class="card-body">
                <form id="productVariantImageForm" action="{{ route('product-variant-images.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Product Variant -->
                    <div class="mb-3">
                        <label for="product_variant_id" class="form-label">Product Variant</label>
                        <select class="form-select @error('product_variant_id') is-invalid @enderror"
                            id="product_variant_id" name="product_variant_id" required>
                            <option value="">Select Product Variant</option>
                            @foreach ($productVariants as $productVariant)
                                <option value="{{ $productVariant->id }}"
                                    {{ old('product_variant_id') == $productVariant->id ? 'selected' : '' }}>
                                    {{ $productVariant->product_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_variant_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Table to display data -->
                    <table class="table table-bordered" id="product-variant-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Attributes</th>
                                <th>Values</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center">Please select a product variant to load data.</td>
                            </tr>
                        </tbody>
                    </table>


                    <!-- Primary Image -->
                    <div class="mb-3">
                        <label for="primary_image" class="form-label">Primary Image</label>
                        <input type="file" class="form-control @error('primary_image') is-invalid @enderror"
                            id="primary_image" name="primary_image" accept="image/*" required>
                        @error('primary_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Secondary Images -->
                    <div class="mb-3">
                        <label for="secondary_images" class="form-label">Secondary Images</label>
                        <input type="file" class="form-control @error('secondary_images') is-invalid @enderror"
                            id="secondary_images" name="secondary_images[]" accept="image/*" multiple>
                        @error('secondary_images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Images</button>
                        <a href="{{ route('product-variant-images') }}" class="btn btn-secondary">Cancel</a>
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
            $('#productVariantImageForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Clear previous errors
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Validate form fields
                let isValid = true;

                const productVariant = $('#product_variant_id').val();
                if (!productVariant) {
                    isValid = false;
                    $('#product_variant_id').addClass('is-invalid');
                    $('#product_variant_id').after(
                        '<div class="invalid-feedback">Product Variant is required.</div>');
                }

                const primaryImage = $('#primary_image').val();
                if (!primaryImage) {
                    isValid = false;
                    $('#primary_image').addClass('is-invalid');
                    $('#primary_image').after(
                        '<div class="invalid-feedback">Primary image is required.</div>');
                }

                if (isValid) {
                    this.submit(); // Submit the form if valid
                }
            });

            //  on change on product variant call this 
            $('#product_variant_id').on('change', function() {
                const productVariantId = $(this).val(); // Get the selected value

                // Check if a valid option is selected
                if (productVariantId) {
                    $.ajax({
                        url: `{{ route('product-variant-images.attribute-values', ':id') }}`.replace(':id',
                            productVariantId), // Endpoint to fetch data
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Clear the table body
                            const tableBody = $('#product-variant-table tbody');
                            tableBody.empty();

                            if (data.length > 0) {
                                // Populate the table with the data
                                data.forEach((item, index) => {
                                    const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>
                                ${item.name}
                                </td>
                                <td>
                                    ${item.value}
                                </td>
                            </tr>
                        `;
                                    tableBody.append(row);
                                });
                            } else {
                                // No data found
                                tableBody.append(
                                    '<tr><td colspan="3" class="text-center">No data available.</td></tr>'
                                    );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('Failed to fetch data.');
                        }
                    });
                } else {
                    // Reset the table if no variant is selected
                    const tableBody = $('#product-variant-table tbody');
                    tableBody.html(
                        '<tr><td colspan="3" class="text-center">Please select a product variant to load data.</td></tr>'
                        );
                }
            });



        });
    </script>
@endsection
