@extends('customer_layouts.customer')
@section('title', '404')

@section('css')
@endsection

@section('content')
    <div class="page-content">
        <section class="content-inner-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10 col-md-12">
                        <div class="error-page style-1">
                            <div class="dz-error-media">
                                <img src="images/pic-404.png" alt="">
                            </div>
                            <div class="error-inner">
                                <h1 class="dz_error">404</h1>
                                <p class="error-head">Oh, no! This page does not exist.</p>
                                <a href="index.html" class="btn btn-secondary  text-uppercase">Go to Main Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        @include('customer_layouts.customer-service-icon')


    </div>
@endsection

@section('script')
@endsection
