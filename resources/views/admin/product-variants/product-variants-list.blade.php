@extends('layouts.master')
@section('title', 'Product Variants List')

@section('css')
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet" />
    <style>
        .nested {
            display: none;
        }

        .nested.active {
            display: table-row;
        }

        .toggle-icon {
            cursor: pointer;
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_info {
                display: none;
            }

            .dataTables_wrapper .dataTables_length {
                display: none;
            }
        }

        /* Styling for Table */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 12px;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table .badge {
            font-size: 0.875rem;
        }

        .btn-primary,
        .btn-danger,
        .btn-light {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body border-bottom">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 card-title flex-grow-1">Product Variants List</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('product-variants.create') }}" class="btn btn-primary">Add New Variant</a>
                                <button class="btn btn-light" id="refresh-table">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap w-100"
                                id="product-variants-table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount Price</th>
                                        <th scope="col">Stock Quantity</th>
                                        <th scope="col">Update Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Populated via DataTables --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('#product-variants-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product-variants') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'sku',
                        name: 'sku'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'discount_price',
                        name: 'discount_price'
                    },
                    {
                        data: 'stock_quantity',
                        name: 'stock_quantity'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                responsive: true
            });

            // CSRF Token Setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle delete action
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this variant?')) {
                    $.ajax({
                        url: `/product-variants/${id}`,
                        type: 'DELETE',
                        success: function(response) {
                            table.ajax.reload();
                            toastr.success(response.message, 'Success');
                        },
                        error: function(xhr) {
                            let error = xhr.responseJSON ? xhr.responseJSON.message :
                                'An error occurred';
                            toastr.error(error, 'Error');
                        }
                    });
                }
            });

            // Refresh table
            $('#refresh-table').on('click', function() {
                table.ajax.reload();
            });
        });
    </script>
@endsection
