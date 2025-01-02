<header class="site-header mo-left header style-1 header-transparent">
    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container-fluid clearfix">
                <!-- Website Logo -->
                <div class="logo-header logo-dark me-md-5">
                    <a href="{{route('customer.home')}}"><img src="images/logo.svg" alt="logo"></a>
                </div>

                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <!-- EXTRA NAV -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <ul class="header-right">
                            <li class="nav-item login-link">
                                <a class="nav-link {{ request()->routeIs('customer.login') ? 'custom-menu-active' : '' }} {{ request()->routeIs('customer.register') ? 'custom-menu-active' : '' }}"
                                    href="{{ route('customer.login') }}">
                                    LOGIN / REGISTER
                                </a>
                            </li>
                            <li class="nav-item search-link">
                                <a class="nav-link" href="javascript:void(0);" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="10.0535" cy="10.55" r="7.49047" stroke="var(--white)"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.2632 16.1487L18.1999 19.0778" stroke="var(--white)"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>

                            <li class="nav-item cart-link">
                                <a href="javascript:void(0);" class="nav-link cart-btn" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.08374 2.61947C1.08374 2.27429 1.36356 1.99447 1.70874 1.99447H3.29314C3.91727 1.99447 4.4722 2.39163 4.67352 2.98239L5.06379 4.1276H15.4584C17.6446 4.1276 19.4168 5.89981 19.4168 8.08593V11.5379C19.4168 13.7241 17.6446 15.4963 15.4584 15.4963H9.22182C7.30561 15.4963 5.66457 14.1237 5.32583 12.2377L4.00967 4.90953L3.49034 3.3856C3.46158 3.30121 3.3823 3.24447 3.29314 3.24447H1.70874C1.36356 3.24447 1.08374 2.96465 1.08374 2.61947ZM5.36374 5.3776L6.55614 12.0167C6.78791 13.3072 7.91073 14.2463 9.22182 14.2463H15.4584C16.9542 14.2463 18.1668 13.0337 18.1668 11.5379V8.08593C18.1668 6.59016 16.9542 5.3776 15.4584 5.3776H5.36374Z"
                                            fill="var(--white)" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.16479 17.8278C8.16479 17.1374 8.72444 16.5778 9.4148 16.5778H9.42313C10.1135 16.5778 10.6731 17.1374 10.6731 17.8278C10.6731 18.5182 10.1135 19.0778 9.42313 19.0778H9.4148C8.72444 19.0778 8.16479 18.5182 8.16479 17.8278Z"
                                            fill="var(--white)" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.8315 17.8278C14.8315 17.1374 15.3912 16.5778 16.0815 16.5778H16.0899C16.7802 16.5778 17.3399 17.1374 17.3399 17.8278C17.3399 18.5182 16.7802 19.0778 16.0899 19.0778H16.0815C15.3912 19.0778 14.8315 18.5182 14.8315 17.8278Z"
                                            fill="var(--white)" />
                                    </svg>
                                    <span class="badge badge-circle">5</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Main Nav -->
                <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="index.html"><img src="images/logo.svg" alt=""></a>
                    </div>
                    <ul class="nav navbar-nav dark-nav">
                        <li class="sub-menu">
                            <a href="{{ route('customer.home') }}"
                                class="{{ request()->routeIs('customer.home') ? 'custom-menu-active' : '' }} {{ request()->routeIs('customer.contact-us') ? 'custom-color-white' : '' }}"><span>Home</span></a>
                        </li>


                        <li class="sub-menu sub-menu-down">
                            <a href="javascript:void(0);" class="{{ request()->routeIs('customer.contact-us') ? 'custom-color-white' : '' }}"><span>Categories</span></a>
                            <ul id="dynamic-sub-menu" class="sub-menu">
                                <!-- Submenu items will be appended here dynamically -->
                            </ul>
                        </li>

                        <li><a href="{{ route('customer.contact-us') }}"
                                class="{{ request()->routeIs('customer.contact-us') ? 'custom-menu-active' : '' }}">Contact
                                Us</a></li>
                    </ul>

                    <div class="dz-social-icon">
                        <ul>
                            <li><a class="fab fa-facebook-f" target="_blank" href="javascript:void(0);"></a></li>
                            <li><a class="fab fa-twitter" target="_blank" href="javascript:void(0);"></a></li>
                            <li><a class="fab fa-linkedin-in" target="_blank"
                                    href="https://www.linkedin.com/showcase/3686700/admin/"></a></li>
                            <li><a class="fab fa-instagram" target="_blank" href="javascript:void(0);"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header End -->


    <!-- SearchBar -->
    <div class="dz-search-area dz-offcanvas offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            &times;
        </button>
        <div class="container">
            <form class="header-item-search">
                <div class="input-group search-input">
                    <select class="default-select">
                        <option>All Categories</option>
                        <option>Wooden Bottles </option>
                        <option>Wooden Furniture</option>
                        <option>Metal Utensils</option>
                        <option>Wooden Utensils</option>
                        <option>Baby Products</option>
                        <option>Yoga Mats</option>
                        <option>Eco-Friendly</option>
                        <option>Childern's Strollers</option>
                        <option>Bamboo products</option>
                        <option>Healthy Products</option>
                        <option>Luxury Couch</option>
                        <option>Video Instructors</option>
                    </select>
                    <input type="text" class="form-control" aria-label="Text input with dropdown button"
                        placeholder="Search Product">
                    <button class="btn" type="button">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="10.0535" cy="10.5399" r="7.49047" stroke="#0D775E" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.2632 16.1387L18.1999 19.0677" stroke="#0D775E" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <ul class="recent-tag">
                    <li class="pe-0"><span>Quick Search :</span></li>
                    <li><a href="shop-list.html">Wooden Products</a></li>
                    <li><a href="shop-list.html">Metal Products</a></li>
                    <li><a href="shop-list.html">Baby Products</a></li>
                    <li><a href="shop-list.html">Yoga Mats</a></li>
                </ul>
            </form>
            <div class="row">
                <div class="col-xl-12">
                    <h5 class="mb-3">You May Also Like</h5>
                    <div class="swiper category-swiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <img src="images/shop/product/1.png" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="shop-list.html">Wooden Water Bottles</a></h6>
                                        <h6 class="price">$40.00</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <img src="images/shop/product/3.png" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="shop-list.html">Bamboo toothbrushes</a></h6>
                                        <h6 class="price">$30.00</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <img src="images/shop/product/4.png" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="shop-list.html">Eco friendly bags</a></h6>
                                        <h6 class="price">$35.00</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <img src="images/shop/product/2.png" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="shop-list.html">Wooden Cup</a></h6>
                                        <h6 class="price">$20.00</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <img src="images/shop/product/5.png" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="shop-list.html">Bamboo toothbrushes</a></h6>
                                        <h6 class="price">$70.00</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <img src="images/shop/product/6.png" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="shop-list.html">Eco friendly bags</a></h6>
                                        <h6 class="price">$45.00</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <img src="images/shop/product/7.png" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="shop-list.html">Wooden Bottles</a></h6>
                                        <h6 class="price">$40.00</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        <img src="images/shop/product/4.png" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="shop-list.html">Paper Bags</a></h6>
                                        <h6 class="price">$60.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SearchBar -->

    <!-- Sidebar cart -->
    <div class="offcanvas dz-offcanvas offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            &times;
        </button>
        <div class="offcanvas-body">
            <div class="product-description">
                <div class="dz-tabs">
                    <ul class="nav nav-tabs center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="shopping-cart" data-bs-toggle="tab"
                                data-bs-target="#shopping-cart-pane" type="button" role="tab"
                                aria-controls="shopping-cart-pane" aria-selected="true">Shopping Cart
                                <span class="badge badge-light">5</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="wishlist" data-bs-toggle="tab"
                                data-bs-target="#wishlist-pane" type="button" role="tab"
                                aria-controls="wishlist-pane" aria-selected="false">Wishlist
                                <span class="badge badge-light">2</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="dz-shopcart-sidebar">
                        <div class="tab-pane fade show active" id="shopping-cart-pane" role="tabpanel"
                            aria-labelledby="shopping-cart" tabindex="0">
                            <div class="shop-sidebar-cart">
                                <ul class="sidebar-cart-list">
                                    <li>
                                        <div class="cart-widget">
                                            <div class="dz-media me-3">
                                                <img src="images/shop/shop-cart/pic1.jpg" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <h6 class="title"><a href="product-thumbnail.html">Wooden Water
                                                        Bottles</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <div class="btn-quantity light quantity-sm me-3">
                                                        <input type="text" value="1" name="demo_vertical2">
                                                    </div>
                                                    <h6 class="dz-price text-primary mb-0">$50.00</h6>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="dz-close">
                                                <i class="ti-close"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cart-widget">
                                            <div class="dz-media me-3">
                                                <img src="images/shop/shop-cart/pic2.jpg" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <h6 class="title"><a href="product-thumbnail.html">Bamboo
                                                        Cups</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <div class="btn-quantity light quantity-sm me-3">
                                                        <input type="text" value="1" name="demo_vertical2">
                                                    </div>
                                                    <h6 class="dz-price text-primary mb-0">$40.00</h6>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="dz-close">
                                                <i class="ti-close"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cart-widget">
                                            <div class="dz-media me-3">
                                                <img src="images/shop/shop-cart/pic3.jpg" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <h6 class="title"><a href="product-thumbnail.html">Wooden
                                                        Toothbrushes</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <div class="btn-quantity light quantity-sm me-3">
                                                        <input type="text" value="1" name="demo_vertical2">
                                                    </div>
                                                    <h6 class="dz-price text-primary mb-0">$65.00</h6>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="dz-close">
                                                <i class="ti-close"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="cart-total">
                                    <h5 class="mb-0">Subtotal:</h5>
                                    <h5 class="mb-0">300.00$</h5>
                                </div>
                                <div class="mt-auto">
                                    <div class="shipping-time">
                                        <div class="dz-icon">
                                            <i class="flaticon flaticon-ship"></i>
                                        </div>
                                        <div class="shipping-content">
                                            <h6 class="title pe-4">Congratulations , you've got free shipping!</h6>
                                            <div class="progress">
                                                <div class="progress-bar progress-animated border-0"
                                                    style="width: 75%;" role="progressbar">
                                                    <span class="sr-only">75% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('customer.checkout') }}"
                                        class="btn btn-light btn-block m-b20">Checkout</a>
                                    <a href="{{ route('customer.cart') }}" class="btn btn-secondary btn-block">View
                                        Cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="wishlist-pane" role="tabpanel" aria-labelledby="wishlist"
                            tabindex="0">
                            <div class="shop-sidebar-cart">
                                <ul class="sidebar-cart-list">
                                    <li>
                                        <div class="cart-widget">
                                            <div class="dz-media me-3">
                                                <img src="images/shop/shop-cart/pic1.jpg" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <h6 class="title"><a href="product-thumbnail.html">Wooden Water
                                                        Bottles</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="dz-price text-primary mb-0">$50.00</h6>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="dz-close">
                                                <i class="ti-close"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cart-widget">
                                            <div class="dz-media me-3">
                                                <img src="images/shop/shop-cart/pic2.jpg" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <h6 class="title"><a href="product-thumbnail.html">Wooden Cup</a>
                                                </h6>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="dz-price text-primary mb-0">$40.00</h6>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="dz-close">
                                                <i class="ti-close"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cart-widget">
                                            <div class="dz-media me-3">
                                                <img src="images/shop/shop-cart/pic3.jpg" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <h6 class="title"><a href="product-thumbnail.html">Bamboo
                                                        toothbrushes</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="dz-price text-primary mb-0">$65.00</h6>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="dz-close">
                                                <i class="ti-close"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-auto">
                                    <a href="shop-wishlist.html" class="btn btn-secondary btn-block">Check Your
                                        Favourite</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar cart -->

</header>
