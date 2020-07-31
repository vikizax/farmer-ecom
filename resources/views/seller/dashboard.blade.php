@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar">
                <nav class="sidebar-nav">
                    <div class="sidebar-header">
                        <button class="nav-toggler nav-toggler-md sidebar-toggler" type="button" data-toggle="collapse"
                                data-target="#nav-toggleable-md">
                            <span class="sr-only">Toggle nav</span>
                        </button>
                        <a class="sidebar-brand img-responsive" href="{{ route('sellerDash.index', 'listOrders') }}">
                            <span class="icon icon-leaf sidebar-brand-icon"></span>
                        </a>
                    </div>

                    <div class="collapse nav-toggleable-md" id="nav-toggleable-md">
                        <ul class="nav nav-pills flex-column">

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sellerDash.addProductForm')}}">Add
                                    Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sellerDash.index', 'listApprovedProduct')}}">Manage
                                    Approved
                                    Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sellerDash.index', 'listPendingProduct')}}">List
                                    Pending
                                    Products</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sellerDash.index', 'listOrders')}}">List Orders</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sellerDash.index', 'productAnalysis')}}">Product
                                    Analysis</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}">Return Home</a>
                            </li>

                        </ul>
                        <hr class="visible-xs mt-3">
                    </div>
                </nav>
            </div>


            @if ($page == 'productAnalysis')
                <div id="seller-details" class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Product Analysis</h2>
                        </div>
                    </div>
                    <br>


                    <div class="container">

                        <hr class="mt-0 mb-5">
                        <!--            START OF USERS-->
                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="traffic">
                                <h4 class="dashhead-title mb-4">Your Top 5 Products (based on total order received)</h4>

                                <div role="tabpanel" class="tab-pane" id="sales">
                                    <div class="ex-bar-graphs mb-5">
                                        <canvas class="ex-line-graph" width="600" height="400" data-chart="bar"
                                                data-dataset="[[{{$data_set}}]]"
                                                data-labels="{{$product_label}}"
                                                data-dark="true">
                                        </canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif


            @if ($page == 'userAnalysis')
                <div id="seller-details" class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Users Analysis</h2>
                        </div>
                    </div>
                    <br>
                    <div class="container">

                        <hr class="mt-0 mb-5">
                        <!--            START OF USERS-->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="traffic">


                                <div role="tabpanel" class="tab-pane" id="sales">
                                    <div class="ex-line-graphs mb-5">
                                        <canvas class="ex-line-graph" width="600" height="400" data-chart="line"
                                                data-dataset="[[2500, 3300, 2512, 2775, 2498, 3512, 2925, 4275, 3507, 3825, 3445, 3985]]"
                                                data-labels="['','Aug 29','','','Sept 5','','','Sept 12','','','Sept 19','']"
                                                data-dark="true">
                                        </canvas>
                                    </div>
                                </div>

                            </div>


                            <hr class="my-12">

                            <div class="row">
                                <div class="col-lg-4 mb-5">
                                    <div class="list-group mb-3">
                                        <h6 class="list-group-header">
                                            Most Active Month
                                        </h6>

                                        <a class="list-group-item list-group-item-action justify-content-between"
                                           href="#">
                                            <span class="list-group-progress" style="width: 62.4%;"></span>
                                            <span>Jan</span>
                                            <span class="text-muted">62.4%</span>
                                        </a>

                                    </div>
                                </div>

                                <div class="col-lg-4 mb-5">
                                    <div class="list-group mb-3">
                                        <h6 class="list-group-header">
                                            Least Active Month
                                        </h6>

                                        <a class="list-group-item list-group-item-action justify-content-between"
                                           href="#">
                                            <span>April</span>
                                            <span class="text-muted">1%</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-12">
                    </div>
                </div>
            @endif


            @if ($page == 'addProduct')
                <div class="content-panel col-md-9 content">

                    <!--  ADD PRODUCT TABLE-->
                    <div class="table-responsive">
                        <form class="form-horizontal" method="POST" action="{{route('sellerDash.addProduct')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <fieldset class="fieldset">
                                <h3 class="fieldset-title">Fill Up All the below details to Add your product
                                </h3>
                                <div class="form-group">
                                    <label class="control-label">Product
                                        Name</label>

                                    <input type="text" class="form-control" name="name" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                                <div class="form-group avatar">

                                    <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                        <input type="file" class="file-uploader pull-left" id="chosse-file" name="image"
                                               required>
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-2 col-sm-3 col-xs-12 ">
                                    <label class="control-label">Category</label>
                                    <select class="selectpicker form-group" name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2 col-sm-3 col-xs-12">
                                    <label class="control-label">Quantity Type</label>
                                    <select class="selectpicker" name="type" required>
                                        <option value="packet">In Packet</option>
                                        <option value="g">In Grams (g)</option>
                                        <option value="kg">In Killo Grams (kg)</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Quantity</label>

                                    <input type="number" class="form-control" name="stock_qnty" required>
                                    @error('stock_qnty')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Price Per Unit Quantity</label>

                                    <input type="number" class="form-control" name="price" required>
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Product Description</label>

                                    <input type="text" class="form-control" name="description" required>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                            </fieldset>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            @endif


            @if ($page == 'listApprovedProduct')
                <div class="content-panel col-md-9 content">
                    <!--ORDER HISTORY TABLE-->
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{route('productImage.show', $product->image)}}"
                                                 alt="product-image"
                                                 width="70" class="img-fluid rounded shadow-sm"/>
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">
                                                    <a href="{{route('sellerDash.updateProductForm', $product->id)}}"
                                                       class="text-dark d-inline-block align-middle">{{$product->name}}</a>
                                                </h5>
                                                <span class="text-muted font-weight-normal font-italic d-block">Category:
                                            {{$product->category}}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <strong>Rs.{{$product->price}}</strong>
                                    </td>
                                    <td class="border-0 align-middle"><strong>{{$product->stock_qnty}}</strong></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if ($page == 'manageApprovedProduct')
                <div class="col-md-9 content">
                    <div class="content-panel">
                        <form class="mt-4" action="{{route('sellerDash.updateApprovedProduct', $product->id)}}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <h3 class="fieldset-title">Edit Product Details</h3>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" value="{{ $product->name}}" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group avatar">

                                <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                    <input type="file" class="file-uploader pull-left" id="chosse-file" name="image"
                                           required>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-2 col-sm-3 col-xs-12 ">
                                <label class="control-label">Category</label>
                                <select class="selectpicker form-group" name="category_id" required>
                                    @foreach ($categories as $category)
                                        @if ($category->name == $product->category)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 col-sm-3 col-xs-12">
                                <label class="control-label">Quantity Type</label>
                                <select class="selectpicker" name="type" required>
                                    <option value="packet" selected="{{$product->type == 'packet' ? true : false}}">In
                                        Packet
                                    </option>
                                    <option value=" g" selected="{{$product->type == 'g' ? true : false}}">In Grams
                                        (g)
                                    </option>

                                    <option value="kg" selected="{{$product->type == 'kg' ? true : false}}">In Killo
                                        Grams (kg)
                                    </option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Quantity</label>

                                <input type="number" class="form-control" name="stock_qnty" required
                                       value="{{(float)$product->stock_qnty}}">
                                @error('stock_qnty')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label">Price Per Unit Quantity</label>

                                <input type="number" class="form-control" name="price" required
                                       value="{{(float)$product->price}}">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label">Product Description</label>

                                <input type="text" class="form-control" name="description" required
                                       value="{{$product->description}}">
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>

                            <hr>

                            <button href="" class="btn btn-success mx-2" type="submit">Update</button>
                            <a href="" class="btn btn-danger mx-2"
                               onclick="event.preventDefault(); document.getElementById('deleteProduct').submit();">Delete</a>
                        </form>

                        <form id="deleteProduct" action="{{ route('sellerDash.deleteProduct', $product->id) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif

            @if ($page == 'listPendingProduct')
                <div class="content-panel col-md-9 content">
                    <!--ORDER HISTORY TABLE-->
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{route('productImage.show', $product->image)}}" alt="" width="70"
                                                 class="img-fluid rounded shadow-sm"/>
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0 text-primary">
                                                    {{$product->name}}
                                                </h5>
                                                <span class="text-muted font-weight-normal font-italic d-block">Category:
                                            {{$product->category}}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <strong>Rs.{{$product->price}}</strong>
                                    </td>
                                    <td class="border-0 align-middle"><strong>{{$product->stock_qnty}}</strong></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if($page == 'listOrders')
                <div class="content-panel col-md-9 content">
                    <h3 class="fieldset-title">Orders Recieved</h3>
                    <!--ORDER  TABLE-->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Product</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Quantity</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Total Amount Paid</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Payment ID</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{route('productImage.show', $order->img)}}" alt="image"
                                                 width="70"
                                                 class="img-fluid rounded shadow-sm"/>
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0 text-primary">
                                                    <a href="{{route('sellerDash.orderDetails', $order->id)}}">{{$order->product_name}}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>{{ $order->qnty }}</strong></td>
                                    <td class="border-0 align-middle">
                                        <strong>Rs.{{ $order->total_amnt }}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <strong>{{ $order->payment_id }}</strong>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if($page == 'orderDetails')
                <div class="col-md-9 content">
                    <div class="content-panel">
                        <form class="mt-4">
                            @csrf

                            <h3 class="fieldset-title">Order Info</h3>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Product Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" value="{{ $order->product_name }}"
                                           name="name" readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Quantity</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="number" class="form-control" value="{{ $order->qnty}}"
                                           name="stock_qnty">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Amount Paid</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="number" class="form-control" value="{{ $order->total_amnt}}"
                                           name="price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Payment ID</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="text" class="form-control" value="{{ $order->payment_id}}"
                                           name="payment_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Payment Request ID</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="text" class="form-control"
                                           value="{{ $order->payment_request_id}}" name="payment_request_id">
                                </div>
                            </div>

                            <fieldset class="fieldset">

                                <h3 class="fieldset-title mt-3">Buyer Info</h3>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Name</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="text" class="form-control"
                                               value="{{ $order->name}}"
                                               name="buyer-name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Phone Number</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="number" class="form-control" value="{{ $order->phone_no}}"
                                               name="buyer-phone">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Pin Code</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="text" class="form-control" value="{{ $order->pincode}}"
                                               name="buyer-pincode">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">City</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="text" class="form-control" value="{{ $order->city}}"
                                               name="buyer-city">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">State</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="text" class="form-control" value="{{ $order->state}}"
                                               name="buyer-state">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Address</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="text" class="form-control" value="{{ $order->address}}"
                                               name="buyer-address">
                                    </div>
                                </div>
                            </fieldset>

                            <hr>

                        </form>

                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
