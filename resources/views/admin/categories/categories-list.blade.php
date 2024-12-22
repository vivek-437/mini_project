@extends('layouts.master')
@section('title', 'Product Categories List')

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
                        <h5 class="mb-0 card-title flex-grow-1">Categories List</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
                            <button class="btn btn-light" id="refresh-table">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="categories-table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Description</th>
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
        $(document).ready(function () {
            // Initialize DataTable
            const table = $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.list') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name', render: renderCategoryName },
                    { data: 'slug', name: 'slug' },
                    { data: 'description', name: 'description' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'is_active', name: 'is_active', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                rowId: row => `category-${row.id}`,
                responsive: true,
                order: [[4, 'desc']] // Order by the update date in descending order
            });

            // Render category name with toggle icon for nested categories
            function renderCategoryName(data, type, row) {
                if (row.children && row.children.length > 0) {
                    return `
                        <span class="toggle-icon" data-id="${row.id}">
                            <i class="fas fa-plus-square"></i>
                        </span>
                        ${data}`;
                }
                return data;
            }

            // Handle toggle for nested rows
            $('#categories-table tbody').on('click', '.toggle-icon', function () {
                const $icon = $(this).find('i');
                const parentId = $(this).data('id');
                const parentRow = $(this).closest('tr');
                let nestedRows = $(`tr.nested[data-parent="${parentId}"]`);

                if (nestedRows.length === 0) {
                    fetchNestedCategories(parentId, parentRow, $icon);
                } else {
                    toggleNestedRows(nestedRows, $icon);
                }
            });

            // Fetch nested categories via AJAX
            function fetchNestedCategories(parentId, parentRow, $icon) {
                $.ajax({
                    url: "{{ route('categories.children') }}",
                    type: 'GET',
                    data: { parent_id: parentId },
                    success: function (data) {
                        data.forEach(child => {
                            const childRow = `
                                <tr class="nested" data-parent="${parentId}">
                                    <td></td>
                                    <td>${child.name}</td>
                                    <td>${child.slug}</td>
                                    <td>${child.description}</td>
                                    <td>${child.updated_at}</td>
                                    <td>${child.is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-id="${child.id}">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="${child.id}">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>
                                    </td>
                                </tr>`;
                            $(childRow).insertAfter(parentRow);
                        });
                        toggleNestedRows($(`tr.nested[data-parent="${parentId}"]`), $icon);
                    },
                    error: function (xhr) {
                        console.error('Failed to load child categories:', xhr.responseText);
                    }
                });
            }

            // Toggle visibility of nested rows
            function toggleNestedRows(nestedRows, $icon) {
                nestedRows.toggleClass('active');
                $icon.toggleClass('fa-plus-square fa-minus-square');
            }

            // Refresh DataTable
            $('#refresh-table').on('click', function () {
                table.ajax.reload();
            });
        });
    </script>
@endsection
