@extends('layouts.master')
@section('title', 'Product Categories')
@section('css')
@endsection
@section('content')
    {{-- content --}}
    <div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Jobs Lists</h5>
                        <div class="flex-shrink-0">
                            <a href="#!" class="btn btn-primary">Add New Job</a>
                            <a href="#!" class="btn btn-light"><i class="fas fa-sync-alt"></i></a> <!-- Replaced mdi-refresh with Font Awesome -->
                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn btn-success" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i> <!-- Replaced mdi-dots-vertical with Font Awesome -->
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-lg-6">
                            <input type="search" class="form-control" id="searchTableList" placeholder="Search for ...">
                        </div>
                        <div class="col-xxl-2 col-lg-6">
                            <select class="form-select" id="idStatus" aria-label="Default select example">
                                <option value="all">Status</option>
                                <option value="Active">Active</option>
                                <option value="New">New</option>
                                <option value="Close">Close</option>
                            </select>
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <select class="form-select" id="idType" aria-label="Default select example">
                                <option value="all">Select Type</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                            </select>
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <div id="datepicker1">
                                <input type="text" class="form-control" placeholder="Select date"
                                    data-date-format="dd M, yyyy" data-date-container='#datepicker1'
                                    data-date-autoclose="true" data-provide="datepicker">
                            </div><!-- input-group -->
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <button type="button" class="btn btn-soft-secondary w-100" onclick="filterData();"><i
                                    class="mdi mdi-filter-outline align-middle"></i> Filter</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle dt-responsive nowrap w-100 table-check" id="job-list">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Posted Date</th>
                                    <th scope="col">Last Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->
                </div>
                <!-- end card body -->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

    </div>
</div>

    <!-- / Content -->
@endsection

@section('script')
@endsection
