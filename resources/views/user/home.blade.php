@extends('layouts.layout', ['footer_content' => $footer_content])

@section('content')

    <div class="container-fluid">
        @if(count($banners) > 0)
            <div class="container-fluid main-carousel">
                <!-- START CAROUSEL -->
                <div id="slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($banners as $banner)

                            <div class="carousel-item @if($loop->first) active @endif">
                                <a href="{{ $banner->link }}">
                                    <img src="{{ route('cmsBannerImage.show', $banner->image) }}" class="w-100"
                                         alt="image"/>
                                    <div class="carousel-caption rounded">
                                        <h2 class="">
                                            {{$banner->title}}
                                        </h2>
                                        @if($banner->sub_title != '')
                                            <p class="text-center">
                                                {{ $banner->sub_title }}
                                            </p>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon carousel-nav" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon carousel-nav" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- END CAROUSEL -->
            @endif
            <!--START FEATURES SECTION-->
                <section>
                    <!-- Start Shop Services Area -->
                    <section class="shop-services section home">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Start Single Service -->
                                    <div class="single-service">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <h4>Free shiping</h4>
                                        <p>Orders over $100</p>
                                    </div>
                                    <!-- End Single Service -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Start Single Service -->
                                    <div class="single-service">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <h4>Free Return</h4>
                                        <p>Within 30 days returns</p>
                                    </div>
                                    <!-- End Single Service -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Start Single Service -->
                                    <div class="single-service">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <h4>Sucure Payment</h4>
                                        <p>100% secure payment</p>
                                    </div>
                                    <!-- End Single Service -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Start Single Service -->
                                    <div class="single-service">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <h4>Best Peice</h4>
                                        <p>Guaranteed price</p>
                                    </div>
                                    <!-- End Single Service -->
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Shop Services Area -->
                </section>
            </div>

            <!--    START OF AD-->
            @if(count($topAds) != 0)
                <div class="container AD item-center">
                    <div class="row text-center">
                        <div class="row col-12">
                            @foreach($topAds as $topAd)
                                <div class="AD1 col-sm-6 col-12"
                                     style="background: url({{route('cmsTopAdImage.show', $topAd->image)}}) no-repeat ;background-size:contain;background-position: center;">
                                    <p>
                                        <a href="{{ $topAd->ad_link }}" style="text-decoration: none;color: white">
                                            {{ $topAd->ad_title }}
                                        </a>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        <!--END OF AD-->


            <!--    START OF FEATUED PRODUCT-->

            <div class="container product1">
                <div class="row">
                    <div class="col-md-12">
                        <h2>FEATURED <b>PRODUCTS</b></h2>
                        @if($featured_products)
                            <div id="myCarousel" class="carousel carousel2 slide" data-ride="carousel"
                                 data-interval="0">
                                <div class="carousel-inner">
                                    @foreach($featured_products as $featured_product)

                                        <div class="item carousel-item @if($loop->first)active @endif">
                                            <div class="row">
                                                @foreach($featured_product as $product)
                                                    <div class="col-sm-3">
                                                        <div class="thumb-wrapper1">
                                                            <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                                            <div class="img-box">
                                                                <a href="{{route('product.show', $product->id)}}"
                                                                   class="nav-link text-dark">
                                                                    <img
                                                                        src="{{ route('productImage.show', $product->image) }}"
                                                                        class="img-responsive img-fluid"
                                                                        alt="product-image">
                                                                </a>
                                                            </div>
                                                            <div class="thumb-content">
                                                                <h4>{{ $product->name }}</h4>
                                                                <p class="item-price"><b>Rs.{{ $product->price }}</b>
                                                                </p>
                                                                <a href=""
                                                                   class="btn btn-success rounded-pill text-center"
                                                                   onclick="event.preventDefault();
                                                                       document.getElementById('addToCartFeatured-form-{{$product->id}}').submit();">
                                                                    Add to Cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form id="addToCartFeatured-form-{{$product->id}}"
                                                          action="{{ route('cart.store', $product->id) }}" method="POST"
                                                          style="display: none;">
                                                        @csrf
                                                    </form>
                                                @endforeach
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                                <!-- Carousel controls -->
                                <a class="carousel-control carousel-control2 left1 carousel-control-prev"
                                   href="#myCarousel"
                                   data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="carousel-control carousel-control2 right1 carousel-control-next"
                                   href="#myCarousel"
                                   data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        @else
                            <h3 class="text-center text-success">COMING SOON</h3>
                        @endif
                    </div>
                </div>
            </div>
            <!--    END OF FEATUED PRODUCT-->

            <!--    START OF BEST SELLING PRODCT-->
            <div class="container product2">
                <div class="row">
                    <div class="col-md-12">
                        <h2>BEST <b>SELLING</b></h2>
                        @if($best_selling_products)
                            <div id="myCarousel2" class="carousel carousel3 slide" data-ride="carousel"
                                 data-interval="0">
                                <div class="carousel-inner">
                                    @foreach($best_selling_products as $best_selling_product)
                                        <div class="item carousel-item @if($loop->first) active @endif">
                                            <div class="row">
                                                @foreach($best_selling_product as $product)
                                                    <div class="col-sm-3">
                                                        <div class="thumb-wrapper1">
                                                            <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                                            <div class="img-box">
                                                                <a href="{{ route('product.show', $product->id) }}">
                                                                    <img
                                                                        src="{{ route('productImage.show', $product->image) }}"
                                                                        class="img-responsive img-fluid"
                                                                        alt="product-image">
                                                                </a>
                                                            </div>
                                                            <div class="thumb-content">
                                                                <h4>{{ $product->name }}</h4>
                                                                <p class="item-price"><b>Rs.{{ $product->price }}</b>
                                                                </p>
                                                                <a href=""
                                                                   class="btn btn-success rounded-pill text-center"
                                                                   onclick="event.preventDefault();
                                                                       document.getElementById('addToCartBestSelling-form-{{$product->id}}').submit();">
                                                                    Add to Cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form id="addToCartBestSelling-form-{{$product->id}}"
                                                          action="{{ route('cart.store', $product->id) }}" method="POST"
                                                          style="display: none;">
                                                        @csrf
                                                    </form>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Carousel controls -->
                                <a class="carousel-control carousel-control3 left2 carousel-control-prev"
                                   href="#myCarousel2"
                                   data-slide="prev">
                                    <i class="fa n fa-angle-left"></i>
                                </a>
                                <a class="carousel-control carousel-control3 right2 carousel-control-next"
                                   href="#myCarousel2"
                                   data-slide="next">
                                    <i class="fa n fa-angle-right"></i>
                                </a>
                            </div>
                        @else
                            <h3 class="text-center text-success">COMING SOON</h3>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END OF BEST-SELLING PRODUCT-->


            <!--START OF CUSTOMER-REVIEW-->
            @if(count($reviews) != 0)
                <div class="container product1">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>What Our's customer Say</h2>
                            <div id="customer-slider" class="owl-carousel">
                                @foreach($reviews as $review)
                                    <div class="customer">
                                        <div class="pic">
                                            @if($review->image == 'user.png')
                                                <img src="{{ asset('img/user.png') }}"
                                                     alt="user-image">
                                            @else
                                                <img src="{{ route('cmsCustomerReviewImage.show', $review->image) }}"
                                                     alt="user-image">
                                            @endif
                                        </div>
                                        <div class="customer-content">
                                            <p class="description">
                                                {{ $review->review }}
                                            </p>
                                            <h3 class="customer-title">{{ $review->name }}
                                                <small class="post">{{ $review->designation }}</small>
                                            </h3>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>

                    </div>

                </div>
                <!--END OF CUSTOMER-REVIEW-->
            @endif
            <hr>

            <!--    START OF Company AD-->
            @if(count($bottomAds) != 0)
                <div class="container">
                    <div class="row">
                        @foreach($bottomAds as $bottomAd)
                            <div class="column">
                                <a href="{{ $bottomAd->ad_link }}">
                                    <img src="{{ route('cmsBottomAdImage.show', $bottomAd->image) }}" alt="Snow"
                                         style="width:100%">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
        @endif
        <!-- END of Company Ad -->

            <!--START OF COUNTER-->
            <hr>
            <section class="counter">
                <div class="container">
                    <div class="row counter_row">
                        <div class="column counter_column">
                            <div class="card counter_card">
                                <p><i class="fa fa-users counter_fa"></i></p>
                                <h3>{{ $seller_count }}+</h3>
                                <p>Sellers</p>
                            </div>
                        </div>
                        <div class="column counter_column">
                            <div class="card counter_card">
                                <p><i class="fa fa-cart-plus counter_fa"></i></p>
                                <h3>{{ $product_count }}+</h3>
                                <p>Products</p>
                            </div>
                        </div>
                        <div class="column counter_column">
                            <div class="card counter_card">
                                <p><i class="fa fa-comment counter_fa"></i></p>
                                <h3>{{ $feedback_count }}+</h3>
                                <p>Positive Feedback</p>
                            </div>
                        </div>

                        <div class="column counter_column">
                            <div class="card counter_card">
                                <p><i class="fa fa-truck counter_fa"></i></p>
                                <h3>{{ $order_count }}+</h3>
                                <p>Products Delivered</p>
                            </div>
                        </div>
                    </div>


                </div>

            </section>
            <!--    END OF COUNTER-->
    </div>

@endsection
