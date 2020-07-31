@extends('layouts.layout')


@section('content')

    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block"
                             src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name">{{ Auth::user()->first_name}} {{Auth::user()->last_name }}</li>

                        </ul>
                    </div>
                    <nav class="side-menu">
                        <ul class="nav">
                            <li>
                                <a href="{{route('setting.index', 'account')}}">
                                    <span class="fa fa-user c1"></span>
                                    Profile
                                </a>
                            </li>

                            <li>
                                <a href="{{route('setting.index', 'orderHistory')}}">
                                    <span class="fa fa-cog c1 "></span>
                                    Order History
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>

                @if ($page == 'account')
                    <div class="content-panel">
                        <form class="form-horizontal" method="POST"
                              action={{route('setting.update',  Auth::user()->id)}}>
                            @csrf
                            <fieldset class="fieldset">
                                <h3 class="fieldset-title">Personal Info</h3>


                                <div class="form-group">
                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">First Name</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12 ">
                                        <input type="text"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               value="{{ $errors->has('first_name') ? old('first-name')  : Auth::user()->first_name }}"
                                               name="first-name">
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Last Name</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" value="{{ Auth::user()->last_name}}"
                                               name="last-name">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset">
                                <h3 class="fieldset-title">Contact Info</h3>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12 ">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{  $errors->has('email') ? old('email')  : Auth::user()->email}}"
                                               name="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Phone No</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12 ">
                                        <input type="phone" class="form-control @error('phone_no') is-invalid @enderror"
                                               value="{{  $errors->has('phone_no') ? old('phone')  : Auth::user()->phone_no}}"
                                               name="phone">
                                        @error('phone_no')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Phone number length</strong>
                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Address</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                               value="{{  $errors->has('address') ? old('address')  : Auth::user()->address}}"
                                               name="address">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Pin Code</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="number"
                                               class="form-control @error('pin_code') is-invalid @enderror"
                                               value="{{  $errors->has('pin_code') ? old('pincode') : Auth::user()->pin_code}}"
                                               name="pincode">
                                        @error('pin_code')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Pincode length</strong>
                                </span>
                                        @enderror
                                    </div>

                                </div>
                            </fieldset>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                    <button class="btn btn-primary" type="submit">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif


                @if ($page == 'orderHistory')
                    <div class="content-panel">
                        <!--ORDER HISTORY TABLE-->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Total Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Quantity</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Date</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <th scope="row" class="border-0">
                                            <div class="p-2">
                                                <img src="{{route('productImage.show', $order->img)}}" alt="image"
                                                     width="70"
                                                     class="img-fluid rounded shadow-sm"/>
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0">
                                                        <a href="{{route('product.show', $order->product_id)}}"
                                                           class="text-dark d-inline-block align-middle">{{$order->item_name}}</a>
                                                    </h5>
                                                    <span class="text-muted font-weight-normal font-italic d-block">Category: {{$order->category}}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="border-0 align-middle">
                                            <strong>Rs.{{$order->total_amnt}}</strong>
                                        </td>
                                        <td class="border-0 align-middle"><strong>{{$order->qnty}}</strong></td>
                                        <td class="border-0 align-middle">
                                            {{$order->updated_at}}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </section>
    </div>

@endsection
