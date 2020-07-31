@extends('layouts.layout')

@section('content')
    <section>
        <!-- head banner start-->
        <div class="container-fluid bg-light">
            <div class="image-container text-center d-flex justify-content-center">
                <h1 class="mt-5">PRODUCTS</h1>
            </div>
        </div>
        <!-- head banner end -->

        <div class="container product-display">
            <!-- category nav start -->
            <div class="container text-center d-flex justify-content-center">
                <form method="POST" action="{{ route('product.filter') }}">
                    @csrf
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                            <select class="custom-select mr-sm-2" name="filter">
                                @foreach($filter_set as $filter)
                                    @if(strpos(Request::path(), $filter) != false)
                                        <option selected value="{{ $filter }}">{{ $filter }}</option>
                                    @else
                                        <option value="{{ $filter }}">{{ $filter }}</option>

                                    @endif

                                @endforeach

                            </select>
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-success">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- category nav end -->
            <div class="container text-center mt-5">
                <h3>{{ $title }}</h3>
            </div>

            <hr>

            @if(count($products) != 0)
                <div class="container product-container">
                    <div class="row row-cols-1 row-cols-md-4">
                        @foreach ($products as $product)
                            <div class="col mb-4">
                                <div class="card text-center">
                                    <a href="{{route('product.show', $product->id)}}" class="nav-link text-dark">
                                        <img class="img-fluid" src="{{route('productImage.show', $product->image)}}"/>
                                    </a>
                                    <div class="card-body">
                                        <a href="{{route('product.show', $product->id)}}" class="nav-link text-dark">
                                            <h5 class="card-title">{{$product->name}}</h5>
                                        </a>
                                        <p class="card-text">
                                            Rs.{{$product->price}}
                                        </p>


                                        @if ($product->stock_qnty > 0)
                                            <a href="" class="btn btn-success rounded-pill text-center"
                                               onclick="event.preventDefault();
                                                   document.getElementById('addToCart-form-{{ $product->id }}').submit();">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        @else
                                            <button class="btn btn-success rounded-pill text-center mt-2 mt-sm-0"
                                                    disabled>
                                                <i class="fas fa-shopping-cart">
                                                </i>
                                            </button>
                                        @endif


                                        <a href="" class="btn btn-danger rounded-pill text-center"
                                           onclick="event.preventDefault();
                                               document.getElementById('addToWishlist-form-{{ $product->id }}').submit();">
                                            <i class="far fa-heart"></i>
                                        </a>
                                        <form id="addToCart-form-{{ $product->id }}"
                                              action="{{ route('cart.store', $product->id) }}"
                                              method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                        <form id="addToWishlist-form-{{ $product->id }}"
                                              action="{{ route('wishlist.store', $product->id) }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="container product-container text-center">
                    <p class="text-info">NO RESULT</p>
                </div>
            @endif
        </div>
    </section>




@endsection
