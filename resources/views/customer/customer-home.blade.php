@extends('customer_layouts.customer')
@section('title', 'Home')

@section('css')
@endsection

@section('content')
    <!--Swiper Banner Start -->
    <div class="main-slider style-1">
        <div class="main-swiper">
            <div class="swiper-wrapper">
                @foreach ($banner as $variant)
                    <div class="swiper-slide bg-light">
                        <div class="container-fluid">
                            <div class="banner-content">
                                <div class="row gx-0">
                                    <div class="col-md-6 col-sm-6 align-self-center">
                                        <div class="swiper-content">
                                            <div class="content-info">
                                                <h1 class="title mb-2" data-swiper-parallax="-20">
                                                    {{ $variant->product->name ?? 'Product Name' }}</h1>
                                                <p class="text mb-0" data-swiper-parallax="-40">
                                                    {{ $variant->product->description ?? 'Product Description' }}
                                                </p>
                                                <div class="swiper-meta-items" data-swiper-parallax="-50">
                                                    <div class="meta-content">
                                                        <span class="price-name">Price</span>
                                                        <span class="price-num">₹{{ $variant->price }}</span>
                                                    </div>
                                                    <div class="meta-content">
                                                        <span class="color-name">Color</span>
                                                        <div class="d-flex align-items-center color-filter">
                                                            @foreach ($variant->attributes as $attribute)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="radioNoLabel{{ $variant->id }}"
                                                                        id="radioNoLabel{{ $variant->id . $loop->index }}"
                                                                        value="{{ $attribute->value }}" aria-label="..."
                                                                        {{ $loop->first ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content-btn" data-swiper-parallax="-60">
                                                    <a class="btn btn-secondary me-xl-3 me-2 btnhover20"
                                                        href="{{ $variant->id }}">
                                                        ADD TO CART
                                                    </a>
                                                    <a class="btn btn-outline-secondary btnhover20"
                                                        href="{{ $variant->id }}">
                                                        VIEW DETAILS
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="banner-media">
                                            <div class="img-preview" data-swiper-parallax="-100">
                                                <img src="{{ $variant->images->first()->img_url ?? 'default-image.png' }}"
                                                    alt="banner-media">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination-wrapper">
                <div class="swiper-pagination-five"></div>
            </div>
            <div class="pagination-align style-1">
                <div class="swiper-button-prev">
                    <i class="flaticon flaticon-left-chevron-1"></i>
                </div>
                <div class="swiper-button-next">
                    <i class="flaticon flaticon-right-arrow"></i>
                </div>
            </div>
            <div class="banner-social-media">
                <ul>
                    <li>
                        <a target="_blank" href="javascript:void(0);">Instagram</a>
                    </li>
                    <li>
                        <a target="_blank" href="javascript:void(0);">Facebook</a>
                    </li>
                    <li>
                        <a target="_blank" href="javascript:void(0);">twitter</a>
                    </li>
                </ul>

            </div>
            <div class="left-text-bar justify-content-center">
                <a href="contact-us-1.html" class="service-btn btn-light">Let’s talk</a>
            </div>
        </div>
    </div>
    <!--Swiper Banner End-->

    <!-- Product Start-->
    <section class="content-inner overlay-white-middle">
        <div class="container">
            <div class="row product-style1">
                @foreach ($products as $index => $product)
                    @if ($index == 0)
                        <div class="col-lg-6 p-b30 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="product-box style-1"
                                style="background-image: url('{{ $product->image ?? 'default-image.png' }}');">
                                <div class="product-content">
                                    <div class="main-content">
                                        <h2 class="product-name">{{ $product->name }}</h2>
                                        <span class="offer">UP TO {{ $product->discount }}% OFF</span>
                                    </div>
                                    <a href="{{ url('shop-standard/' . $product->id) }}"
                                        class="btn btn-outline-secondary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    @else
                        @if ($loop->first)
                            <div class="col-lg-6">
                                <div class="row product-style-1">
                        @endif
                        <div class="col-lg-12 m-b30 wow fadeInUp" data-wow-delay="{{ 0.2 * ($index + 1) }}s">
                            <div class="product-box style-{{ $index + 1 }}"
                                style="background-image: url('{{ $product->image ?? 'default-image.png' }}');">
                                <div class="product-content">
                                    <div class="main-content">
                                        <h2 class="product-name">{{ $product->name }}</h2>
                                        <span class="offer">UP TO {{ $product->discount }}% OFF</span>
                                    </div>
                                    <a href="{{ url('shop-standard/' . $product->id) }}"
                                        class="btn btn-outline-secondary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        @if ($loop->last)
            </div>
        </div>
        @endif
        @endif
        @endforeach
        </div>
        </div>
    </section>

    <!-- Product End-->

    <!--Recommend Section Start-->
    {{-- <section class="content-inner-1 bg-light">
        <div class="container">
            <h3 class="title">Most popular products</h3>
            <div class="site-filters clearfix d-flex align-items-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="filters" data-bs-toggle="buttons">
                    <li class="btn active">
                        <input type="radio">
                        <a href="javascript:void(0);">All Products <span>(20)</span></a>
                    </li>
                    <li data-filter=".Bottle" class="btn">
                        <input type="radio">
                        <a href="javascript:void(0);">Bottle <span>(10)</span></a>
                    </li>
                    <li data-filter=".Begs" class="btn">
                        <input type="radio">
                        <a href="javascript:void(0);">Begs <span>(02)</span></a>
                    </li>
                    <li data-filter=".Toothbrushes" class="btn">
                        <input type="radio">
                        <a href="javascript:void(0);">Toothbrushes <span>(08)</span></a>
                    </li>
                </ul>
                <a href="shop-list.html"
                    class="product-link text-secondary font-14 d-flex align-items-center gap-1 text-nowrap">See all
                    products
                    <i class="icon feather icon-chevron-right font-18"></i>
                </a>
            </div>
            <div class="clearfix">
                <ul id="masonry" class="row g-xl-4 g-3">
                    <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Begs wow fadeInUp"
                        data-wow-delay="0.1s">
                        <div class="shop-card">
                            <div class="dz-media">
                                <img src="images/shop/product/1.png" alt="image">
                                <div class="shop-meta">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon">
                                        <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                fill="white" />
                                        </svg>
                                        <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon">
                                        <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                fill="white" />
                                            <path
                                                d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                fill="white" />
                                            <path
                                                d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                fill="white" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="shop-list.html">Wooden Water Bottles</a></h5>
                                <ul class="star-rating">
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                </ul>
                                <h6 class="price">
                                    <del>$45.00</del>
                                    $40.00
                                </h6>
                            </div>
                            <div class="product-tag">
                                <span class="badge badge-secondary">Sale</span>
                            </div>
                        </div>
                    </li>
                    <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Bottle wow fadeInUp"
                        data-wow-delay="0.2s">
                        <div class="shop-card">
                            <div class="dz-media">
                                <img src="images/shop/product/2.png" alt="image">
                                <div class="shop-meta">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon">
                                        <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                fill="white" />
                                        </svg>
                                        <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>

                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon">
                                        <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                fill="white" />
                                            <path
                                                d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                fill="white" />
                                            <path
                                                d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                fill="white" />
                                            <clipPath id="clip0_502_6">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="shop-list.html">Wooden Cup</a></h5>
                                <ul class="star-rating">
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                </ul>
                                <h6 class="price">
                                    <del>$52.00</del>
                                    $23.00
                                </h6>
                            </div>
                            <div class="product-tag">
                                <span class="badge badge-secondary">-30%</span>
                                <span class="badge badge-primary">Featured</span>
                            </div>
                        </div>
                    </li>
                    <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Bottle wow fadeInUp"
                        data-wow-delay="0.3s">
                        <div class="shop-card">
                            <div class="dz-media">
                                <img src="images/shop/product/3.png" alt="image">
                                <div class="shop-meta">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon">
                                        <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                fill="white" />
                                        </svg>
                                        <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>

                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon">
                                        <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                fill="white" />
                                            <path
                                                d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                fill="white" />
                                            <path
                                                d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                fill="white" />
                                            <clipPath id="clip0_502_06">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="shop-list.html">Bamboo toothbrushes</a></h5>
                                <ul class="star-rating">
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                </ul>
                                <h6 class="price">
                                    <del>$75.00</del>
                                    $30.00
                                </h6>
                            </div>
                            <div class="product-tag">
                                <span class="badge badge-secondary">-20%</span>
                                <span class="badge badge-primary">Featured</span>
                            </div>
                        </div>
                    </li>
                    <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Begs wow fadeInUp"
                        data-wow-delay="0.4s">
                        <div class="shop-card">
                            <div class="dz-media">
                                <img src="images/shop/product/4.png" alt="image">
                                <div class="shop-meta">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon">
                                        <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                fill="white" />
                                        </svg>
                                        <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>

                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon">
                                        <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                fill="white" />
                                            <path
                                                d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                fill="white" />
                                            <path
                                                d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                fill="white" />
                                            <clipPath id="clip0_502_061">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="shop-list.html">Eco friendly bags</a></h5>
                                <ul class="star-rating">
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                </ul>
                                <h6 class="price">
                                    <del>$55.00</del>
                                    $25.00
                                </h6>
                            </div>
                            <div class="product-tag">
                                <span class="badge badge-secondary">-25%</span>
                                <span class="badge badge-primary">Featured</span>
                            </div>
                        </div>
                    </li>
                    <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Bottle wow fadeInUp"
                        data-wow-delay="0.5s">
                        <div class="shop-card">
                            <div class="dz-media">
                                <img src="images/shop/product/5.png" alt="image">
                                <div class="shop-meta">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon">
                                        <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                fill="white" />
                                        </svg>
                                        <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>

                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon">
                                        <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                fill="white" />
                                            <path
                                                d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                fill="white" />
                                            <path
                                                d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                fill="white" />
                                            <clipPath id="clip_502_3906">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="shop-list.html">Bamboo toothbrushes</a></h5>
                                <ul class="star-rating">
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                </ul>
                                <h6 class="price">
                                    <del>$85.00</del>
                                    $40.00
                                </h6>
                            </div>
                            <div class="product-tag">
                                <span class="badge badge-secondary">-50%</span>
                                <span class="badge badge-primary">Featured</span>
                            </div>
                        </div>
                    </li>
                    <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Toothbrushes wow fadeInUp"
                        data-wow-delay="0.6s">
                        <div class="shop-card">
                            <div class="dz-media">
                                <img src="images/shop/product/6.png" alt="image">
                                <div class="shop-meta">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon">
                                        <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                fill="white" />
                                        </svg>
                                        <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>

                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon">
                                        <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                fill="white" />
                                            <path
                                                d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                fill="white" />
                                            <path
                                                d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                fill="white" />
                                            <clipPath id="clip0_52_3906">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="shop-list.html">Eco friendly bags</a></h5>
                                <ul class="star-rating">
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                </ul>
                                <h6 class="price">
                                    <del>$55.00</del>
                                    $30.00
                                </h6>
                            </div>
                            <div class="product-tag">
                                <span class="badge badge-secondary">-10%</span>
                                <span class="badge badge-primary">Featured</span>
                            </div>
                        </div>
                    </li>
                    <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Bottle wow fadeInUp"
                        data-wow-delay="0.7s">
                        <div class="shop-card">
                            <div class="dz-media">
                                <img src="images/shop/product/7.png" alt="image">
                                <div class="shop-meta">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon">
                                        <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                fill="white" />
                                        </svg>
                                        <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>

                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon">
                                        <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                fill="white" />
                                            <path
                                                d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                fill="white" />
                                            <path
                                                d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                fill="white" />
                                            <clipPath id="clip0_5_3906">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="shop-list.html">Wooden Water Bottles</a></h5>
                                <ul class="star-rating">
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                </ul>
                                <h6 class="price">
                                    <del>$96.00</del>
                                    $36.00
                                </h6>
                            </div>
                            <div class="product-tag">
                                <span class="badge badge-secondary">Sale</span>
                            </div>
                        </div>
                    </li>
                    <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Begs wow fadeInUp"
                        data-wow-delay="0.8s">
                        <div class="shop-card">
                            <div class="dz-media">
                                <img src="images/shop/product/8.png" alt="image">
                                <div class="shop-meta">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon">
                                        <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                fill="white" />
                                        </svg>
                                        <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>

                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon">
                                        <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                fill="white" />
                                            <path
                                                d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                fill="white" />
                                            <path
                                                d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                fill="white" />
                                            <clipPath id="clip0_502_39062">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="shop-list.html">Wooden Cup</a></h5>
                                <ul class="star-rating">
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#FF8A00" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                fill="#E4E5E8" />
                                        </svg>
                                    </li>
                                </ul>
                                <h6 class="price">
                                    <del>$75.00</del>
                                    $20.00
                                </h6>
                            </div>
                            <div class="product-tag">
                                <span class="badge badge-secondary">-60%</span>
                                <span class="badge badge-primary">Featured</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section> --}}
    <!--Recommend Section End-->

    <!-- icon-box1 -->
    @include('customer_layouts.customer-service-icon-2')

    <!-- icon-box1 End-->



    <!-- Feature Product -->
    {{-- <section class="content-inner-2 adv-area">
        <div class="container-fluid px-0">
            <div class="row product-style2 g-0">
                <div class="col-lg-6 col-md-6 p-b30 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-box style-4" style="background-image: url('images/shop/large/product1.png');">
                        <div class="product-content">
                            <div class="main-content">
                                <div class="badge style-1 mb-3">From $29.05</div>
                                <h2 class="product-name">Organic Skincare for Glowing Complexion.</h2>
                                <p class="para-text">
                                    Lorem Ipsum is simply dummy text of It’s easy to get lost in the world of lovely
                                    valley vapour around and the meridian sun strikes the upper surface.
                                </p>
                            </div>
                            <a href="shop-list.html" class="btn btn-outline-secondary">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 p-t30 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-box style-4" style="background-image: url('images/shop/large/product2.png');">
                        <div class="product-content">
                            <div class="main-content">
                                <div class="badge style-1 mb-3">free shipping on all orders over $59</div>
                                <h2 class="product-name">Shop & shipment acrossthe whole North America.</h2>
                                <p class="para-text">
                                    Lorem Ipsum is simply dummy text of It’s easy to get lost in the world of lovely
                                    valley vapour around and the meridian sun strikes the upper surface.
                                </p>
                            </div>
                            <a href="shop-list.html" class="btn btn-outline-secondary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Feature Product End -->

    <!-- Tranding Start-->
    <section class="content-inner-1">
        <div class="container">
            <div class="section-head style-2 wow fadeInUp" data-wow-delay="0.1s">
                <div class="left-content">
                    <h2 class="title">What's trending now</h2>
                    <p>Discover the most trending products in Ciseco.</p>
                </div>
                <a href="shop-list.html" class="text-secondary font-14 d-flex align-items-center gap-1">See all
                    products
                    <i class="icon feather icon-chevron-right font-18"></i>
                </a>
            </div>
            <div class="swiper-btn-center-lr">
                <div class="swiper swiper-four">
                    <div class="swiper-wrapper">
                        @foreach($trandings as $tranding)
                        <div class="swiper-slide">
                            <div class="shop-card wow fadeInUp" data-wow-delay="0.2s">
                                <div class="dz-media">
                                    <img src="{{ $variant->images->first()->img_url ?? 'default-image.png' }}" alt="image">
                                    <div class="shop-meta">
                                        <a href="javascript:void(0);" class="btn btn-secondary btn-icon"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal" data-variant-id="{{ $variant->id }}">
                                            <i class="fa-solid fa-eye d-md-none d-block"></i>
                                            <span class="d-md-block d-none">Quick View</span>
                                        </a>
                                        {{-- <div class="btn btn-primary meta-icon dz-wishicon">
                                            <svg class="dz-heart-fill" width="14" height="12" viewBox="0 0 14 12"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.6412 5.80113C13.0778 6.9649 12.0762 8.02624 11.1657 8.8827C10.5113 9.49731 9.19953 10.7322 7.77683 11.62C7.30164 11.9159 6.69842 11.9159 6.22323 11.62C4.80338 10.7322 3.4888 9.49731 2.83435 8.8827C1.92382 8.02624 0.92224 6.96205 0.358849 5.80113C-0.551681 3.91747 0.344622 1.44196 2.21121 0.557041C3.98674 -0.282354 5.54034 0.292418 7.00003 1.44765C8.45972 0.292418 10.0133 -0.282354 11.786 0.557041C13.6554 1.44196 14.5517 3.91747 13.6412 5.80113Z"
                                                    fill="white" />
                                            </svg>
                                            <svg class="dz-heart feather feather-heart" xmlns="http://www.w3.org/2000/svg"
                                                width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path
                                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                                </path>
                                            </svg>

                                        </div> --}}
                                        <div class="btn btn-primary meta-icon dz-carticon add-cart" data-variant-id="{{ $variant->id }}">
                                            <svg class="dz-cart-check" width="15" height="15" viewBox="0 0 15 15"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.9144 3.73438L5.49772 10.151L2.58105 7.23438" stroke="white"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <svg class="dz-cart-out" width="14" height="14" viewBox="0 0 14 14"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.6033 10.4092C9.70413 10.4083 8.97452 11.1365 8.97363 12.0357C8.97274 12.9348 9.70097 13.6644 10.6001 13.6653C11.4993 13.6662 12.2289 12.938 12.2298 12.0388C12.2298 12.0383 12.2298 12.0378 12.2298 12.0373C12.2289 11.1391 11.5014 10.4109 10.6033 10.4092Z"
                                                    fill="white" />
                                                <path
                                                    d="M13.4912 2.6132C13.4523 2.60565 13.4127 2.60182 13.373 2.60176H3.46022L3.30322 1.55144C3.20541 0.853911 2.60876 0.334931 1.90439 0.334717H0.627988C0.281154 0.334717 0 0.61587 0 0.962705C0 1.30954 0.281154 1.59069 0.627988 1.59069H1.90595C1.9858 1.59011 2.05338 1.64957 2.06295 1.72886L3.03004 8.35727C3.16263 9.19953 3.88712 9.8209 4.73975 9.82363H11.2724C12.0933 9.8247 12.8015 9.24777 12.9664 8.44362L13.9884 3.34906C14.0543 3.00854 13.8317 2.67909 13.4912 2.6132Z"
                                                    fill="white" />
                                                <path
                                                    d="M6.61539 11.9676C6.57716 11.0948 5.85687 10.4077 4.98324 10.4108C4.08483 10.4471 3.38595 11.2048 3.42225 12.1032C3.45708 12.9653 4.15833 13.6505 5.02092 13.6653H5.06017C5.95846 13.626 6.65474 12.8658 6.61539 11.9676Z"
                                                    fill="white" />
                                                <clipPath id="clip0_502_39063">
                                                    <rect width="14" height="14" fill="white" />
                                                </clipPath>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="dz-content">
                                    <h5 class="title"><a href="shop-list.html"> {{ $variant->product->name ?? 'Product Name' }}</a></h5>
                                    <ul class="star-rating">
                                        <li>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                    fill="#FF8A00"></path>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                    fill="#FF8A00"></path>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                    fill="#FF8A00"></path>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                    fill="#E4E5E8"></path>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.24805 0.734375L9.22301 5.01608L13.9054 5.57126L10.4436 8.77267L11.3625 13.3975L7.24805 11.0944L3.13355 13.3975L4.0525 8.77267L0.590651 5.57126L5.27309 5.01608L7.24805 0.734375Z"
                                                    fill="#E4E5E8"></path>
                                            </svg>
                                        </li>
                                    </ul>
                                    <h6 class="price">
                                        <del>₹{{ $variant->price }}</del>
                                        ₹{{ $variant->price }}
                                    </h6>
                                </div>
                                <div class="product-tag">
                                    <span class="badge badge-secondary">-5%</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="pagination-align">
                    <div class="tranding-button-prev btn-prev">
                        <i class="flaticon flaticon-left-chevron"></i>
                    </div>
                    <div class="tranding-button-next btn-next">
                        <i class="flaticon flaticon-chevron"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tranding Stop-->





    <!-- Feature Box -->
    <div class="content-inner py-0 overlay-white-middle">
        <div class="container-fluid px-0">
            <div class="row gx-0">
                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="insta-post dz-media dz-img-effect rotate">
                        <a href="javascript:void(0);">
                            <img src="images/feature/1.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.2s">
                    <div class="insta-post dz-media dz-img-effect rotate">
                        <a href="javascript:void(0);">
                            <img src="images/feature/2.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="insta-post dz-media dz-img-effect rotate">
                        <a href="javascript:void(0);">
                            <img src="images/feature/3.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.4s">
                    <div class="insta-post dz-media dz-img-effect rotate">
                        <a href="javascript:void(0);">
                            <img src="images/feature/4.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="insta-post dz-media dz-img-effect rotate">
                        <a href="javascript:void(0);">
                            <img src="images/feature/5.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.6s">
                    <div class="insta-post dz-media dz-img-effect rotate">
                        <a href="javascript:void(0);">
                            <img src="images/feature/6.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Box End -->

    <!-- Icon Box Start -->
    @include('customer_layouts.customer-service-icon')
    <!-- Icon Box End -->




    <!-- Quick Modal Start -->
    <div class="modal quick-view-modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="icon feather icon-x"></i>
                </button>
                <div class="modal-body">
                    <div class="row g-xl-4 g-3">
                        <div class="col-xl-6 col-md-6">
                            <div class="dz-product-detail mb-0">
                                <div class="swiper-btn-center-lr">
                                    <div class="swiper quick-modal-swiper2">
                                        <div class="swiper-wrapper" id="lightgallery">
                                            <div class="swiper-slide">
                                                <div class="dz-media DZoomImage">
                                                    <a class="mfp-link lg-item" href="images/products/baby-seat.png"
                                                        data-src="images/products/baby-seat.png">
                                                        <i class="feather icon-maximize dz-maximize top-right"></i>
                                                    </a>
                                                    <img src="images/products/baby-seat.png" alt="image">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="dz-media DZoomImage">
                                                    <a class="mfp-link lg-item" href="images/products/baby-seat2.png"
                                                        data-src="images/products/baby-seat2.png">
                                                        <i class="feather icon-maximize dz-maximize top-right"></i>
                                                    </a>
                                                    <img src="images/products/baby-seat2.png" alt="image">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="dz-media DZoomImage">
                                                    <a class="mfp-link lg-item" href="images/products/baby-seat3.png"
                                                        data-src="images/products/baby-seat3.png">
                                                        <i class="feather icon-maximize dz-maximize top-right"></i>
                                                    </a>
                                                    <img src="images/products/baby-seat3.png" alt="image">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="dz-media DZoomImage">
                                                    <a class="mfp-link lg-item" href="images/products/baby-seat.png"
                                                        data-src="images/products/baby-seat.png">
                                                        <i class="feather icon-maximize dz-maximize top-right"></i>
                                                    </a>
                                                    <img src="images/products/baby-seat.png" alt="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper quick-modal-swiper thumb-swiper-lg thumb-sm swiper-vertical">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <img src="images/products/thumb-img/seat1.png" alt="image">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/products/thumb-img/seat2.png" alt="image">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/products/thumb-img/seat3.png" alt="image">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/products/thumb-img/seat1.png" alt="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="dz-product-detail style-2 ps-xl-3 ps-0 pt-2 mb-0">
                                <div class="dz-content">
                                    <div class="dz-content-footer">
                                        <div class="dz-content-start">
                                            <span class="badge bg-purple mb-2">SALE 20% Off</span>
                                            <h4 class="title mb-1"><a href="shop-list.html">Baby Strollers</a></h4>
                                            <div class="review-num">
                                                <ul class="dz-rating me-2">
                                                    <li>
                                                        <svg width="14" height="13" viewBox="0 0 14 13"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z"
                                                                fill="#FF8A00"></path>
                                                        </svg>
                                                    </li>
                                                    <li>
                                                        <svg width="14" height="13" viewBox="0 0 14 13"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z"
                                                                fill="#FF8A00"></path>
                                                        </svg>
                                                    </li>
                                                    <li>
                                                        <svg width="14" height="13" viewBox="0 0 14 13"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z"
                                                                fill="#FF8A00"></path>
                                                        </svg>
                                                    </li>
                                                    <li>
                                                        <svg width="14" height="13" viewBox="0 0 14 13"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.2"
                                                                d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z"
                                                                fill="#5E626F"></path>
                                                        </svg>

                                                    </li>
                                                    <li>
                                                        <svg width="14" height="13" viewBox="0 0 14 13"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.2"
                                                                d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z"
                                                                fill="#5E626F"></path>
                                                        </svg>
                                                    </li>
                                                </ul>
                                                <span class="text-secondary me-2">4.7 Rating</span>
                                                <a href="javascript:void(0);">(5 customer reviews)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="para-text">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem
                                        Ipsum has.
                                    </p>
                                    <div class="meta-content m-b20 d-flex align-items-end">
                                        <div class="me-3">
                                            <span class="form-label">Price</span>
                                            <span class="price-num">$125.75 <del>$132.17</del></span>
                                        </div>
                                        <div class="btn-quantity light me-0">
                                            <label class="form-label">Quantity</label>
                                            <input type="text" value="1" name="demo_vertical2">
                                        </div>
                                    </div>
                                    <div class="btn-group cart-btn">
                                        <a href="shop-cart.html" class="btn btn-md btn-secondary text-uppercase">Add
                                            To Cart</a>
                                        <a href="shop-wishlist.html" class="btn btn-md btn-light btn-icon">
                                            <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.24805 16.9986C8.99179 16.9986 8.74474 16.9058 8.5522 16.7371C7.82504 16.1013 7.12398 15.5038 6.50545 14.9767L6.50229 14.974C4.68886 13.4286 3.12289 12.094 2.03333 10.7794C0.815353 9.30968 0.248047 7.9162 0.248047 6.39391C0.248047 4.91487 0.755203 3.55037 1.67599 2.55157C2.60777 1.54097 3.88631 0.984375 5.27649 0.984375C6.31552 0.984375 7.26707 1.31287 8.10464 1.96065C8.52734 2.28763 8.91049 2.68781 9.24805 3.15459C9.58574 2.68781 9.96875 2.28763 10.3916 1.96065C11.2292 1.31287 12.1807 0.984375 13.2197 0.984375C14.6098 0.984375 15.8885 1.54097 16.8202 2.55157C17.741 3.55037 18.248 4.91487 18.248 6.39391C18.248 7.9162 17.6809 9.30968 16.4629 10.7792C15.3733 12.094 13.8075 13.4285 11.9944 14.9737C11.3747 15.5016 10.6726 16.1001 9.94376 16.7374C9.75136 16.9058 9.50417 16.9986 9.24805 16.9986ZM5.27649 2.03879C4.18431 2.03879 3.18098 2.47467 2.45108 3.26624C1.71033 4.06975 1.30232 5.18047 1.30232 6.39391C1.30232 7.67422 1.77817 8.81927 2.84508 10.1066C3.87628 11.3509 5.41011 12.658 7.18605 14.1715L7.18935 14.1743C7.81021 14.7034 8.51402 15.3033 9.24654 15.9438C9.98344 15.302 10.6884 14.7012 11.3105 14.1713C13.0863 12.6578 14.6199 11.3509 15.6512 10.1066C16.7179 8.81927 17.1938 7.67422 17.1938 6.39391C17.1938 5.18047 16.7858 4.06975 16.045 3.26624C15.3152 2.47467 14.3118 2.03879 13.2197 2.03879C12.4197 2.03879 11.6851 2.29312 11.0365 2.79465C10.4585 3.24179 10.0558 3.80704 9.81975 4.20255C9.69835 4.40593 9.48466 4.52733 9.24805 4.52733C9.01143 4.52733 8.79774 4.40593 8.67635 4.20255C8.44041 3.80704 8.03777 3.24179 7.45961 2.79465C6.811 2.29312 6.07643 2.03879 5.27649 2.03879Z"
                                                    fill="black"></path>
                                            </svg>
                                            Add To Wishlist
                                        </a>
                                    </div>
                                    <div class="dz-info mb-0">
                                        <ul>
                                            <li>
                                                <strong>SKU:</strong>
                                                <span>PRT584E63A</span>
                                            </li>
                                            <li>
                                                <strong>Category:</strong>
                                                <span>Bottles,</span>
                                                <span>Accessories,</span>
                                                <span>Mats,</span>
                                                <span>Bottles,</span>
                                                <span>Trackers</span>
                                            </li>
                                            <li>
                                                <strong>Tags:</strong>
                                                <span>Trackers,</span>
                                                <span>Bags,</span>
                                                <span>Cup,</span>
                                                <span>Toothbrushes</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick Modal End -->


@endsection

@section('script')
@endsection
