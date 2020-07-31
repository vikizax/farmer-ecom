@extends('layouts.layout')

@section('content')
<section>
    <div class="container-fluid bg-light">
        <div class="image-container text-center d-flex align-items-center justify-content-center">
            <h1 class="mt-5">Wish List</h1>
        </div>
    </div>

    <div class="container">

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
                            <div class="py-2 text-uppercase">Stock</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                            <div class="py-2 text-uppercase">Remove</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <th scope="row" class="border-0">
                            <div class="p-2">
                                <a href="{{route('product.show', $product->id)}}" class="nav-link">
                                    <img src="./img/about.jpg" alt="" width="70" class="img-fluid rounded shadow-sm" />
                                    <div class="ml-3 d-inline-block align-middle">
                                        <h5 class="mb-0">
                                            <p class="text-dark d-inline-block align-middle">{{$product->name}}</p>
                                        </h5>
                                    </div>
                                </a>
                            </div>
                        </th>
                        <td class="border-0 align-middle"><strong>Rs.{{$product->price}}</strong></td>
                        <td class="border-0 align-middle">
                            @if ($product->stock_qnty > 0)
                            <p class="text-dark">In Stock</p>
                            @else
                            <p class="text-dark">Out of Stock</p>
                            @endif

                        </td>
                        <td class="border-0 align-middle">
                            <a href="" class="text-dark" onclick="event.preventDefault();
                            document.getElementById('deleteFromWishlist-form').submit();"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                        <form id="deleteFromWishlist-form" action="{{route('wishlist.destroy', $product->wishlist_id)}}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE');
                        </form>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</section>
@endsection
