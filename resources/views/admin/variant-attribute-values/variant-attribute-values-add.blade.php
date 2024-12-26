@extends('layouts.master')

@section('title', 'Add Variant Attribute Value')

@section('css')
    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h4 class="mb-0">Add Variant Attribute Value</h4>
            <div class="card-body">
                <form id="variantAttributeValueForm" action="{{ route('variant-attribute-values.store') }}" method="POST">
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

                    <!-- Variant Attribute -->
                    <div class="mb-3">
                        <label for="variant_attribute_id" class="form-label">Variant Attribute</label>
                        <select class="form-select @error('variant_attribute_id') is-invalid @enderror"
                            id="variant_attribute_id" name="variant_attribute_id" required>
                            <option value="">Select Variant Attribute</option>
                            @foreach ($variantAttributes as $variantAttribute)
                                <option value="{{ $variantAttribute->id }}"
                                    {{ old('variant_attribute_id') == $variantAttribute->id ? 'selected' : '' }}>
                                    {{ $variantAttribute->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('variant_attribute_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Value -->
                    <div class="mb-3">
                        <label for="value" class="form-label">Value</label>
                        <input type="text" class="form-control @error('value') is-invalid @enderror" id="value"
                            name="value" placeholder="Enter attribute value" value="{{ old('value') }}" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Value</button>
                        <a href="{{ route('variant-attribute-values') }}" class="btn btn-secondary">Cancel</a>
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
            $('#variantAttributeValueForm').on('submit', function(e) {
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

                const variantAttribute = $('#variant_attribute_id').val();
                if (!variantAttribute) {
                    isValid = false;
                    $('#variant_attribute_id').addClass('is-invalid');
                    $('#variant_attribute_id').after(
                        '<div class="invalid-feedback">Variant Attribute is required.</div>');
                }

                const value = $('#value').val();
                if (value.trim().length < 1) {
                    isValid = false;
                    $('#value').addClass('is-invalid');
                    $('#value').after('<div class="invalid-feedback">Value is required.</div>');
                }

                if (isValid) {
                    this.submit(); // Submit the form if valid
                }
            });
        });
    </script>
@endsection
