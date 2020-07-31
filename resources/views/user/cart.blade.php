@extends('layouts.layout')


@section('content')
    <section>
        <div class="container-fluid bg-light">
            <div class="image-container text-center d-flex align-items-center justify-content-center">
                <h1 class="mt-5">MY CART</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Product</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Price</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Quantity</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Remove</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Buy</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <a href="{{route('product.show', $product->id)}}" class="nav-link">
                                                <img src="{{ route('productImage.show', $product->image) }}" alt="product-image"
                                                     width="70"
                                                     class="img-fluid rounded shadow-sm"/>
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0">
                                                        <p class="text-dark d-inline-block align-middle">{{$product->name}}
                                                        </p>
                                                    </h5>
                                                </div>
                                            </a>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <strong>Rs.{{$product->price}} / {{$product->type}}</strong>
                                    </td>
                                    <td class="border-0 align-middle"><strong>{{ round($product->qnty,0) }}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <a href="" class="text-dark" onclick="event.preventDefault();
                                    document.getElementById('deleteFromCart-form').submit();"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                    <td class="border-0 align-middle"><a href="{{route('checkout', $product->cart_id)}}"
                                                                         class="btn btn-success">Pay</a>
                                    </td>
                                    <form id="deleteFromCart-form" action="{{route('cart.destroy', $product->cart_id)}}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="order-sum">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div
                                    class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold order-sum-head">
                                    Order summary
                                </div>
                                <div class="p-4">
                                    <p class="font-italic mb-4 order-sum-det">
                                        Shipping and additional costs are calculated based on
                                        values you have entered.
                                    </p>
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex justify-content-between py-3 border-bottom">
                                            <strong class="text-muted">Total</strong>
                                            <h5 class="font-weight-bold">Rs.{{ $total_price }}</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- @if ($total_price > 0 )
                            <a href="{{route('checkout')}}" class="btn btn-primary btn-lg order-btn" role="button"
                                aria-pressed="true">Check
                                Out</a>
                            @endif --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
