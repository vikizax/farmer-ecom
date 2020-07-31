@extends('layouts.layout')

@section('content')
<section>
    <div class="container-fluid product-container mt-4 px-4">
        <div class="row">
            <div class="col mb-4">
                <div class="card m-auto">
                    <div class="container">
                        <div class="text-center m-auto w-50">
                            <img class="img-fluid" src="{{route('productImage.show', $product->image)}}" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">
                                Rs.{{$product->price}} / {{$product->type}}
                            </p>
                            <p class="card-text">
                                {{$product->description}}
                            </p>
                            <div class="row">
                                <div class="col text-center">
                                    @if ($product->stock_qnty > 0)
                                    <a href="" class="btn btn-success rounded-pill text-center mt-2 mt-sm-0" onclick="event.preventDefault();
                                    document.getElementById('addToCart-form').submit();">
                                        <i class="fas fa-shopping-cart">
                                            <span class="icon-text">Add to Cart</span>
                                        </i>
                                    </a>
                                    @else
                                    <button class="btn btn-success rounded-pill text-center mt-2 mt-sm-0" disabled>
                                        <i class="fas fa-shopping-cart">
                                            <span class="icon-text">Out of Stock</span>
                                        </i>
                                    </button>
                                    @endif

                                    <a href="" class="btn btn-danger rounded-pill text-center mt-2 mt-sm-0" onclick="event.preventDefault();
                                    document.getElementById('addToWishlist-form').submit();">
                                        <i class="far fa-heart">
                                            <span class="icon-text">Add to Wishlist</span>
                                        </i>
                                    </a>
                                    <form id="addToCart-form" action="{{ route('cart.store', $product->id) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="addToWishlist-form" action="{{ route('wishlist.store', $product->id) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
</section>




@endsection
