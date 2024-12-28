@extends('layouts.master')
@section('title', 'Product Variant Images List')

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

        img {
            max-width: 80px;
            max-height: 80px;
        }

        .carousel-image {
            object-fit: contain;
            max-width: 100%;
            max-height: 100%;
            cursor: pointer;
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
                            <h5 class="mb-0 card-title flex-grow-1">Product Variant Images List</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('product-variant-images.create') }}" class="btn btn-primary">Add New
                                    Image</a>
                                <button class="btn btn-light" id="refresh-table">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap w-100"
                                id="product-variant-images-table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Product Variant</th>
                                        <th scope="col">Primary Image</th>
                                        <th scope="col">Secondary Images</th>
                                        <th scope="col">Update Date</th>
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
            // Initialize DataTable
            const table = $('#product-variant-images-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product-variant-images') }}", // Correct route here
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'product_variant',
                        name: 'product_variant'
                    },
                    {
                        data: 'primary_image',
                        name: 'primary_image',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'secondary_images',
                        name: 'secondary_images',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                rowId: row => `product-variant-image-${row.id}`,
                responsive: true,
                order: [
                    [4, 'desc']
                ] // Order by the update date in descending order
            });

            // Refresh DataTable
            $('#refresh-table').on('click', function() {
                table.ajax.reload();
            });
        });
    </script>
@endsection
