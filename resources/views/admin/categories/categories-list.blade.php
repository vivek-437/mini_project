@extends('layouts.master')
@section('title', 'Product Categories List')
@section('css')
    <style>
        .nested {
            display: none;
            padding-left: 20px;
        }

        .active {
            display: table-row; /* Use table-row to make it compatible with table structure */
        }
    </style>
@endsection
@section('content')
    {{-- content --}}
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body border-bottom">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 card-title flex-grow-1">Categories Lists</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
                                <a href="#!" class="btn btn-light"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle dt-responsive nowrap w-100 table-check" id="job-list">
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
                                    @foreach ($categories as $category)
                                        @if (is_null($category->tbl_category_id))
                                            <tr class="parent-category" data-id="{{ $category->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="toggle-children" style="cursor: pointer;">{{ $category->name }}</span>
                                                </td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td>{{ $category->updated_at }}</td>
                                                <td>{{ $category->is_active }}</td>
                                                <td>
                                                    <a href="" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="" class="btn btn-info btn-sm">View</a>
                                                </td>
                                            </tr>
                                            @foreach ($categories as $child)
                                                @if ($child->tbl_category_id == $category->id)
                                                    <tr class="nested" data-parent="{{ $category->id }}">
                                                        <td></td> <!-- Leave this empty for the numbering -->
                                                        <td>{{ $child->name }}</td>
                                                        <td>{{ $child->slug }}</td>
                                                        <td>{{ $child->description }}</td>
                                                        <td>{{ $child->updated_at }}</td>
                                                        <td>{{ $child->is_active }}</td>
                                                        <td>
                                                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                                                            <a href="" class="btn btn-info btn-sm">View</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- content --}}
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle nested categories
            $('.toggle-children').on('click', function() {
                const parentRow = $(this).closest('tr');
                const parentId = parentRow.data('id');
                const nestedRows = $('tr.nested[data-parent="' + parentId + '"]');

                nestedRows.toggleClass('active');
            });
        });
    </script>
@endsection
