@extends('customer_layouts.customer')
@section('title', 'Register')

@section('css')
@endsection

@section('content')
    <div class="page-content">
        <section class="px-3">
            <div class="row align-center-center">
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
                        <img src="images/registration/pic1.png" alt="/">
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 end-side-content">
                    <div class="login-area">
                        <h2 class="text-secondary text-center">Registration Now</h2>
                        <p class="text-center m-b30">Welcome please registration to your account</p>
                        <form>
                            <div class="m-b25">
                                <label class="label-title">Username</label>
                                <input name="dzName" required="" class="form-control" placeholder="Username"
                                    type="text">
                            </div>
                            <div class="m-b25">
                                <label class="label-title">Email Address</label>
                                <input name="dzName" required="" class="form-control" placeholder="Email Address"
                                    type="email">
                            </div>
                            <div class="m-b40">
                                <label class="label-title">Password</label>
                                <input name="dzName" required="" class="form-control" placeholder="Password"
                                    type="password">
                            </div>
                            <div class="text-center">
                                <a href="shop-registration.html"
                                    class="btn btn-secondary btnhover text-uppercase me-2">Register</a>
                                <a href="shop-my-account.html"
                                    class="btn btn-outline-secondary btnhover text-uppercase">Sign In</a>
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
