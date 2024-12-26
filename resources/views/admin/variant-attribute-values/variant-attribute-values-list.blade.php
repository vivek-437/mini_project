@extends('layouts.master')
@section('title', 'Variant Attribute Values List')

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

        .table th, .table td {
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
    </style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Variant Attribute Values List</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('variant-attribute-values.create') }}" class="btn btn-primary">Add New Value</a>
                            <button class="btn btn-light" id="refresh-table">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="variant-attribute-values-table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Product Variant</th>
                                    <th scope="col">Variant Attribute</th>
                                    <th scope="col">Value</th>
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
        $(document).ready(function () {
            // Initialize DataTable
            const table = $('#variant-attribute-values-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('variant-attribute-values') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'product_variant', name: 'product_variant' },
                    { data: 'variant_attribute', name: 'variant_attribute' },
                    { data: 'value', name: 'value' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                rowId: row => `variant-attribute-value-${row.id}`,
                responsive: true,
                order: [[5, 'desc']] // Order by the update date in descending order
            });

            // Refresh DataTable
            $('#refresh-table').on('click', function () {
                table.ajax.reload();
            });
        });
    </script>
@endsection
