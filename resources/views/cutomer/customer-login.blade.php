@extends('customer_layouts.customer')
@section('title', 'Login')

@section('css')
@endsection

@section('content')

    <div class="page-content">
        <section class="px-3">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 start-side-content">
                    <div class="dz-bnr-inr-entry">
                        <h1>My Account</h1>
                        <nav aria-label="breadcrumb text-align-start" class="breadcrumb-row">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"> Home</a></li>
                                <li class="breadcrumb-item">My Account</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="registration-media">
                        <img src="images/registration/pic2.png" alt="/">
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 end-side-content">
                    <div class="login-area">
                        <h2 class="text-secondary text-center">Welcome Back</h2>
                        <p class="text-center m-b25">welcome please login to your account</p>
                        <form>
                            <div class="m-b30">
                                <label class="label-title">Email Address</label>
                                <input name="dzName" required="" class="form-control" placeholder="Email Address"
                                    type="email">
                            </div>
                            <div class="m-b15">
                                <label class="label-title">Password</label>
                                <input name="dzName" required="" class="form-control" placeholder="Password"
                                    type="password">
                            </div>
                            <div class="form-row d-flex justify-content-between m-b30">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                        <label class="form-check-label" for="basic_checkbox_1">Remember Me</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a class="text-primary" href="javascript:void(0);">Forgot Password</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="shop-my-account.html" class="btn btn-secondary btnhover text-uppercase me-2">Sign
                                    In</a>
                                <a href="shop-registration.html"
                                    class="btn btn-outline-secondary btnhover text-uppercase">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        @include('customer_layouts.customer-service-icon')

    </div>
@endsection

@section('script')
@endsection
