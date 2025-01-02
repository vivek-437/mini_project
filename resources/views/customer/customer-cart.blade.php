@extends('customer_layouts.customer')
@section('title', 'Cart')

@section('css')
@endsection

@section('content')

    <div class="dz-bnr-inr" style="background-image:url(images/background/bg-shape.jpg);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>Cart</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> Home</a></li>
                        <li class="breadcrumb-item">Cart</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


    <!-- contact area -->
    <section class="content-inner shop-account">
        <!-- Product -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table check-tbl">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th></th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-item-img"><img src="images/shop/shop-cart/pic1.jpg" alt="/">
                                    </td>
                                    <td class="product-item-name">Wooden Water Bottles</td>
                                    <td class="product-item-price">$40.00</td>
                                    <td class="product-item-quantity">
                                        <div class="quantity btn-quantity style-1 me-3">
                                            <input type="text" value="1" name="demo_vertical2">
                                        </div>
                                    </td>
                                    <td class="product-item-totle">$160.00</td>
                                    <td class="product-item-close"><a href="javascript:void(0);"><i
                                                class="ti-close"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="product-item-img"><img src="images/shop/shop-cart/pic2.jpg" alt="/">
                                    </td>
                                    <td class="product-item-name">Wooden Cup</td>
                                    <td class="product-item-price">$56.00</td>
                                    <td class="product-item-quantity">
                                        <div class="quantity btn-quantity style-1 me-3">
                                            <input id="demo_vertical3" type="text" value="1" name="demo_vertical2">
                                        </div>
                                    </td>
                                    <td class="product-item-totle">$120.00</td>
                                    <td class="product-item-close"><a href="javascript:void(0);"><i
                                                class="ti-close"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="product-item-img"><img src="images/shop/shop-cart/pic3.jpg" alt="/">
                                    </td>
                                    <td class="product-item-name">Bamboo toothbrushes</td>
                                    <td class="product-item-price">$30.00</td>
                                    <td class="product-item-quantity">
                                        <div class="quantity btn-quantity style-1 me-3">
                                            <input id="demo_vertical4" type="text" value="1" name="demo_vertical2">
                                        </div>
                                    </td>
                                    <td class="product-item-totle">$40.00</td>
                                    <td class="product-item-close"><a href="javascript:void(0);"><i
                                                class="ti-close"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="product-item-img"><img src="images/shop/shop-cart/pic1.jpg" alt="/">
                                    </td>
                                    <td class="product-item-name">Wooden Water Bottles </td>
                                    <td class="product-item-price">$42.00</td>
                                    <td class="product-item-quantity">
                                        <div class="quantity btn-quantity style-1 me-3">
                                            <input id="demo_vertical5" type="text" value="1" name="demo_vertical2">
                                        </div>
                                    </td>
                                    <td class="product-item-totle">$160.00</td>
                                    <td class="product-item-close"><a href="javascript:void(0);"><i
                                                class="ti-close"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="product-item-img"><img src="images/shop/shop-cart/pic2.jpg" alt="/">
                                    </td>
                                    <td class="product-item-name">Wooden Cup</td>
                                    <td class="product-item-price">$28.00</td>
                                    <td class="product-item-quantity">
                                        <div class="quantity btn-quantity style-1 me-3">
                                            <input id="demo_vertical6" type="text" value="1" name="demo_vertical2">
                                        </div>
                                    </td>
                                    <td class="product-item-totle">$45.00</td>
                                    <td class="product-item-close"><a href="javascript:void(0);"><i
                                                class="ti-close"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="product-item-img"><img src="images/shop/shop-cart/pic3.jpg" alt="/">
                                    </td>
                                    <td class="product-item-name">Bamboo toothbrushes</td>
                                    <td class="product-item-price">$120.00</td>
                                    <td class="product-item-quantity">
                                        <div class="quantity btn-quantity style-1 me-3">
                                            <input id="demo_vertical7" type="text" value="1" name="demo_vertical2">
                                        </div>
                                    </td>
                                    <td class="product-item-totle">$40.00</td>
                                    <td class="product-item-close"><a href="javascript:void(0);"><i
                                                class="ti-close"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row shop-form m-t30">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-0">
                                    <input name="dzEmail" required="required" type="text" class="form-control"
                                        placeholder="Coupon Code">
                                    <div class="input-group-addon">
                                        <button name="submit" value="Submit" type="submit" class="btn coupon">
                                            Apply Coupon
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="shop-cart.html" class="btn btn-grey">UPDATE CART</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h4 class="title mb15">Cart Total</h4>
                    <div class="cart-detail">
                        <a href="javascript:void(0);" class="btn btn-outline-primary w-100 m-b20">Bank Offer 5%
                            Cashback</a>
                        <div class="icon-bx-wraper style-4 m-b15">
                            <div class="icon-bx">
                                <i class="flaticon flaticon-ship"></i>
                            </div>
                            <div class="icon-content">
                                <span class="text-primary font-14">FREE</span>
                                <h6 class="dz-title">Enjoy The Product</h6>
                            </div>
                        </div>
                        <div class="icon-bx-wraper style-4 m-b30">
                            <div class="icon-bx">
                                <img src="images/shop/shop-cart/icon-box/pic2.png" alt="/">
                            </div>
                            <div class="icon-content">
                                <h6 class="dz-title">Enjoy The Product</h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                            </div>
                        </div>
                        <div class="save-text">
                            <i class="icon feather icon-check-circle"></i>
                            <span class="m-l10">You will save ₹504 on this order</span>
                        </div>
                        <table>
                            <tbody>
                                <tr class="total">
                                    <td>
                                        <h6 class="mb-0">Total</h6>
                                    </td>
                                    <td class="price">
                                        $125.75
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="shop-checkout.html" class="btn btn-secondary w-100">PLACE ORDER</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product END -->
    </section>
    <!-- contact area End-->


@endsection

@section('script')
@endsection
