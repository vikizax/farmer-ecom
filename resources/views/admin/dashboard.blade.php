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
                        <a class="sidebar-brand img-responsive" href="{{route('admin.index', 'approveSeller')}}">
                            <span class="icon icon-leaf sidebar-brand-icon"></span>
                        </a>
                    </div>

                    <div class="collapse nav-toggleable-md" id="nav-toggleable-md">
                        ACTION MENU
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index', 'approveSeller')}}">Approve
                                    Seller</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index', 'approveProduct')}}">Approves
                                    Product</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.addCategoryForm')}}">Add New Product
                                    Category
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index', 'categoryAll')}}"> Manage Product
                                    Category Category
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index', 'sellerAll')}}">All Sellers</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index', 'transaction')}}">All Transaction</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index', 'productAnalysis')}}">Product
                                    Analysis</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index', 'sellerAnalysis')}}">Seller
                                    Analysis</a>
                            </li>
                        </ul>
                        <hr class="visible-xs mt-3">
                        CMS MENU
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admincms.banner') }}">Banner Form</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admincms.topAd')}}">Top Ad Form</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admincms.customerReview')}}">Customer Review Form</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admincms.bottomAd')}}">Bottom Ad Form</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admincms.bannerAll')}}">All Banners
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admincms.topAdAll')}}">All Top Ad
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admincms.customerReviewAll')}}">All Customer
                                    Review</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admincms.bottomAdAll')}}">All Bottom Ad
                                </a>
                            </li>

                        </ul>
                        <hr class="visible-xs mt-3">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}">Return Home</a>
                            </li>
                        </ul>
                        <hr class="visible-xs mt-3">

                    </div>
                </nav>
            </div>

            {{-- Action Menu --}}
            @if ($page == 'approveProduct')
                <div id="seller-details" class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Product Details</h2>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price / Unit</th>
                                <th>More Details</th>
                                <th>Approved</th>
                                <th>Denied</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category}}</td>
                                    <td>Rs. {{$product->price}}</td>
                                    <td>
                                        <a href="{{route('admin.more', ['page' => 'approveProduct','id' => $product->id])}}"
                                           class="btn btn-primary">Details</a></td>
                                    <td><a href=""
                                           onclick="event.preventDefault(); document.getElementById('approveProduct-form-{{$product->id}}').submit();"><i
                                                class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i></a></td>
                                    <td><a href=""
                                           onclick="event.preventDefault(); document.getElementById('rejectProduct-form-{{$product->id}}').submit();"><i
                                                class="
                                    fa fa-times fa-2x" aria-hidden="true"></i></a></td>
                                </tr>
                                <form id="approveProduct-form-{{$product->id}}"
                                      action="{{ route('admin.productApprove', $product->id) }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                                <form id="rejectProduct-form-{{$product->id}}"
                                      action="{{ route('admin.productReject', $product->id) }}" method="POST"
                                      style="display: none;">
                                    @csrf

                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="text-center">
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
            @endif

            @if ($page == 'approveProductMore')
                <div class="col-md-9 content">
                    <div class="content-panel">
                        <img src="{{route('productImage.show', $product->image)}}" alt="image" class="img-fluid">
                        <form class="mt-4">
                            @csrf

                            <h3 class="fieldset-title">Product Info</h3>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" value="{{ $product->name}}" name="name"
                                           readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Quantity</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="number" class="form-control" value="{{ $product->stock_qnty}}"
                                           name="stock_qnty">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Price Per Quantity</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="number" class="form-control" value="{{ $product->price}}"
                                           name="price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Type</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="text" class="form-control" value="{{ $product->type}}"
                                           name="type">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Description</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="text" class="form-control" value="{{ $product->description}}"
                                           name="description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Category</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input readonly type="text" class="form-control" value="{{ $product->category}}"
                                           name="category">
                                </div>
                            </div>
                            <fieldset class="fieldset">
                                <h3 class="fieldset-title mt-3">By Seller</h3>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Name</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="text" class="form-control"
                                               value="{{ $seller->first_name}} {{$seller->last_name}}"
                                               name="seller-name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="text" class="form-control" value="{{ $seller->email}}"
                                               name="seller-email">
                                    </div>
                                </div>
                            </fieldset>

                            <hr>
                            @if (!$product->approved)
                                <div class="form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">

                                        <a href="" class="btn btn-success mx-3"
                                           onclick="event.preventDefault(); document.getElementById('approveProduct-form').submit();">
                                            Approve
                                        </a>

                                        <a href="" class="btn btn-danger mx-3"
                                           onclick="event.preventDefault(); document.getElementById('rejectProduct-form').submit();">
                                            Deny
                                        </a>

                                    </div>
                                </div>
                            @endif

                        </form>
                        @if (!$product->approved)
                            <form id="approveProduct-form" action="{{ route('admin.productApprove', $product->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                            <form id="rejectProduct-form" action="{{ route('admin.productReject', $product->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        @endif

                    </div>
                </div>
            @endif

            @if ($page == 'approveSeller')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Seller Details</h2>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>More Details</th>
                                <th>Approved</th>
                                <th>Denied</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><a href="{{route('admin.more', ['page' => 'approveSeller','id' => $user->id])}}"
                                           class="btn btn-primary">Details</a></td>
                                    <td><a href=""
                                           onclick="event.preventDefault(); document.getElementById('approveSeller-form-{{$user->id}}').submit();">
                                            <i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i></a></td>
                                    <td><a href=""
                                           onclick="event.preventDefault(); document.getElementById('rejectSeller-form-{{$user->id}}').submit();">
                                            <i class="fa fa-times fa-2x" aria-hidden="true"></i></a></td>
                                </tr>
                                <form id="approveSeller-form-{{$user->id}}"
                                      action="{{ route('admin.sellerApprove', $user->id) }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                                <form id="rejectSeller-form-{{$user->id}}"
                                      action="{{ route('admin.sellerReject', $user->id) }}"
                                      method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="text-center">
                        {{-- <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav> --}}
                    </div>
                </div>
            @endif

            @if ($page == 'sellerAll')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Seller Details</h2>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>More Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="#">{{ $user->first_name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{route('admin.more', ['page' => 'approveSeller','id' => $user->id,  'show' => true])}}"
                                           class="btn btn-primary">Details</a></td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="text-center">
                        {{-- <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav> --}}
                    </div>
                </div>
            @endif

            @if ($page == 'approveSellerMore')
                <div class="col-md-9 content">
                    <div class="content-panel">
                        <img src="{{route('image.show', $user->img)}}" alt="image" class="img-fluid">
                        <form class="mt-4">
                            @csrf
                            <fieldset class="fieldset">
                                <h3 class="fieldset-title">User Info</h3>

                                <div class="form-group">
                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">First Name</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" value="{{ $user->first_name}}"
                                               name="first-name"
                                               readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Last Name</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="text" class="form-control" value="{{ $user->last_name}}"
                                               name="last-name">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset">
                                <h3 class="fieldset-title">Contact Info</h3>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="email" class="form-control" value="{{ $user->email}}"
                                               name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Phone No</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="phone" class="form-control" value="{{ $user->phone_no}}"
                                               name="phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Address</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="phone" class="form-control" value="{{ $user->address}}"
                                               name="address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Pin Code</label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input readonly type="phone" class="form-control" value="{{ $user->pin_code}}"
                                               name="pincode">
                                    </div>
                                </div>
                            </fieldset>
                            <hr>
                            @if ($user->role === 3)
                                <div class="form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">

                                        <a href="" class="btn btn-success mx-3"
                                           onclick="event.preventDefault(); document.getElementById('approveSeller-form').submit();">
                                            Approve
                                        </a>

                                        <a href="" class="btn btn-danger mx-3"
                                           onclick="event.preventDefault(); document.getElementById('rejectSeller-form').submit();">
                                            Deny
                                        </a>

                                    </div>
                                </div>
                            @endif

                        </form>
                        @if ($user->role === 3)
                            <form id="approveSeller-form" action="{{ route('admin.sellerApprove', $user->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                            <form id="rejectSeller-form" action="{{ route('admin.sellerReject', $user->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        @endif

                    </div>
                </div>
            @endif

            @if($page == 'transaction')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Transactions</h2>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Payment Request ID</th>
                                <th>Product ID</th>
                                <th>Order Quantity</th>
                                <th>Paid Amount</th>
                                <th>Seller ID</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->payment_id }}</td>
                                    <td>{{ $order->payment_request_id }}</td>
                                    <td>
                                        <a href="{{ route('product.show', ['id' => $order->product_id]) }}">{{ $order->product_id }}</a>
                                    </td>
                                    <td>{{ $order->qnty }}</td>
                                    <td>{{ $order->total_amnt }}</td>
                                    <td>
                                        <a href="{{route('admin.more', ['page' => 'approveSeller','id' => $order->seller_user_id,  'show' => true])}}">{{ $order->seller_id }}</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="text-center">
                        {{-- <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav> --}}
                    </div>
                </div>
            @endif

            @if ($page == 'addCategory')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Add Category</h2>
                        </div>
                    </div>
                    <form class="mt-4" action="{{route('admin.addCategory')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category">Category Name</label>
                            <input type="text" class="form-control" id="category" name="name">
                            <button type="submit" class="btn btn-success mt-3">ADD</button>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                    </form>
                </div>
            @endif

            @if ($page == 'editCategory')
                <div class="col-md-9 content">
                    <div class="content-panel">
                        <form class="mt-4" action="{{route('admin.updateCategory', $category->id)}}" method="POST">
                            @csrf

                            <h3 class="fieldset-title">Category Edit</h3>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Category Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" value="{{ $category->name}}" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <button href="" class="btn btn-success mx-2" type="submit">Update</button>
                            <a href="" class="btn btn-danger mx-2"
                               onclick="event.preventDefault(); document.getElementById('deleteCategory').submit();">Delete</a>
                        </form>

                        <form id="deleteCategory" action="{{ route('admin.deleteCategory', $category->id) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif

            @if ($page == 'categoryAll')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Category List</h2>
                        </div>
                    </div>

                    {{--                    <div class="flextable table-actions">--}}
                    {{--                        <div class="flextable-item flextable-primary">--}}
                    {{--                            <div class="btn-toolbar-item input-with-icon">--}}
                    {{--                                <input type="text" class="form-control input-block" placeholder="Search Category">--}}
                    {{--                                <span class="icon icon-magnifying-glass"></span>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}

                    {{--                    </div>--}}

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    {{-- {{route('admin.editCategory', ['page' => 'editCategory','id' => $category->id])}} --}}
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{route('admin.more', ['page' => 'editCategory','id' => $category->id])}}"
                                           class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="text-center">
                        {{-- <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav> --}}
                    </div>
                </div>
            @endif

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
                                <h4 class="dashhead-title mb-4">Top 5 Products (based on total order received)</h4>

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

            @if ($page == 'sellerAnalysis')
                <div id="seller-details" class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Seller Analysis</h2>
                        </div>
                    </div>
                    <br>

                    <div class="container">

                        <hr class="mt-0 mb-5">
                        <!--            START OF USERS-->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="traffic">

                                <h4 class="dashhead-title mb-4">Top 5 Sellers (based on total order
                                    received)</h4>

                                <div role="tabpanel" class="tab-pane" id="sales">
                                    <div class="ex-line-graphs mb-5">
                                        <canvas width="600" height="400" data-chart="bar"
                                                data-dataset="[[{{$data_set}}]]"
                                                data-labels="{{$seller_label}}"
                                                data-dark="true">
                                        </canvas>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            @endif

            {{-- CMS Menu --}}
            @if($page == 'bannerForm')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Banner Form</h2>
                        </div>
                    </div>

                    <hr>

                    <div class="content-panel col-md-9 content">
                        <div class="table-responsive">
                            <form class="form-horizontal" method="POST" action="{{route('admincms.bannerStore')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <fieldset class="fieldset">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Banner Title
                                        </label>

                                        <input type="text" class="form-control" name="title" required>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group avatar">
                                        <label class="control-label" for="image">Select Banner Image</label>
                                        <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                            <input type="file" class="file-uploader pull-left" id="chosse-file"
                                                   name="image"
                                                   accept="image/*"
                                                   required>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Sub Title</label>

                                        <input type="text" class="form-control" name="sub_title">
                                        @error('sub_title')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Link</label>

                                        <input type="url" class="form-control" name="link" required>
                                        @error('link')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </fieldset>

                                <hr>

                                <div class="form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if($page == 'topAdForm')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Top Ad Form</h2>
                        </div>
                    </div>
                    <hr>
                    <div class="content-panel col-md-9 content">
                        <div class="table-responsive">
                            <form class="form-horizontal" method="POST" action="{{route('admincms.topAdStore')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <fieldset class="fieldset">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Ad Title
                                        </label>

                                        <input type="text" class="form-control" name="ad_title" required>
                                        @error('ad_title')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group avatar">
                                        <label class="control-label" for="image">Select Ad Image</label>
                                        <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                            <input type="file" class="file-uploader pull-left" id="chosse-file"
                                                   name="image"
                                                   accept="image/*"
                                                   required>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Link</label>

                                        <input type="url" class="form-control" name="ad_link" required>
                                        @error('ad_link')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </fieldset>

                                <hr>

                                <div class="form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if($page == 'customerReviewForm')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Customer Review Form</h2>
                        </div>
                    </div>
                    <hr>
                    <div class="content-panel col-md-9 content">
                        <div class="table-responsive">
                            <form class="form-horizontal" method="POST"
                                  action="{{route('admincms.customerReviewStore')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <fieldset class="fieldset">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Customer Name
                                        </label>

                                        <input type="text" class="form-control" name="name" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group avatar">
                                        <label class="control-label" for="image">Customer Image</label>
                                        <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                            <input type="file" class="file-uploader pull-left" id="chosse-file"
                                                   name="image"
                                                   accept="image/*"
                                            >
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Designation</label>

                                        <input type="text" class="form-control" name="designation" >
                                        @error('designation')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">
                                            Customer Name
                                        </label>
                                        <textarea name="review" class="form-control" rows="4" cols="50"
                                                  required></textarea>

                                        @error('review')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </fieldset>

                                <hr>

                                <div class="form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if($page == 'bottomAdForm')
                <div class="col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Bottom Ad Form</h2>
                        </div>
                    </div>
                    <hr>
                    <div class="content-panel col-md-9 content">
                        <div class="table-responsive">
                            <form class="form-horizontal" method="POST" action="{{route('admincms.bottomAdStore')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <fieldset class="fieldset">
                                    <div class="form-group avatar">
                                        <label class="control-label" for="image">Select Ad Image</label>
                                        <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                            <input type="file" class="file-uploader pull-left" id="chosse-file"
                                                   name="image"
                                                   accept="image/*"
                                                   required>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Link</label>

                                        <input type="url" class="form-control" name="ad_link" required>
                                        @error('ad_link')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </fieldset>

                                <hr>

                                <div class="form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            @endif

            @if($page == 'bannerAll')
                <div class="content-panel col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Banners (Max: 5 Banners)</h2>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{route('cmsBannerImage.show', $banner->image)}}"
                                                 alt="product-image"
                                                 width="70" class="img-fluid rounded shadow-sm"/>
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">
                                                    {{$banner->title}}
                                                </h5>
                                                <span class="text-muted font-weight-normal font-italic d-block">Sub Title:
                                            {{$banner->sub_title}}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <a href="{{ $banner->link }}}"
                                           target="_blank"><strong>{{$banner->link}}</strong></a>
                                    </td>
                                    <td><a href=""
                                           onclick="event.preventDefault(); document.getElementById('removeBanner-form-{{$banner->id}}').submit();"><i
                                                class="
                                    fa fa-times fa-2x" aria-hidden="true"></i></a></td>
                                </tr>
                                <form id="removeBanner-form-{{$banner->id}}"
                                      action="{{ route('admincms.bannerDelete', $banner->id) }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>

            @endif

            @if($page == 'topAdAll')
                <div class="content-panel col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Top Ads (Max: 2 Ads)</h2>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($topAds as $topAd)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{route('cmsTopAdImage.show', $topAd->image)}}"
                                                 alt="product-image"
                                                 width="70" class="img-fluid rounded shadow-sm"/>
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">
                                                    {{$topAd->ad_title}}
                                                </h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <a href="{{ $topAd->ad_link }}"
                                           target="_blank"><strong>{{$topAd->ad_link}}</strong></a>
                                    </td>
                                    <td><a href=""
                                           onclick="event.preventDefault(); document.getElementById('removeTopAd-form-{{$topAd->id}}').submit();"><i
                                                class="
                                    fa fa-times fa-2x" aria-hidden="true"></i></a></td>
                                </tr>
                                <form id="removeTopAd-form-{{$topAd->id}}"
                                      action="{{ route('admincms.topAdDelete', $topAd->id) }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
            @endif

            @if($page == 'customerReviewAll')
                <div class="content-panel col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Customer Reviews</h2>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Review</th>
                                <th>Designation</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            @if($review->image == 'user.png')
                                                <img src="{{asset('img/user.png')}}"
                                                     alt="user-image"
                                                     width="70" class="img-fluid rounded shadow-sm"/>
                                            @else
                                                <img src="{{route('cmsCustomerReviewImage.show', $review->image)}}"
                                                     alt="user-image"
                                                     width="70" class="img-fluid rounded shadow-sm"/>
                                            @endif

                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">
                                                    {{$review->name}}
                                                </h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <strong>{{$review->review}}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <strong>{{$review->designation}}</strong>
                                    </td>
                                    <td><a href=""
                                           onclick="event.preventDefault(); document.getElementById('removeReview-form-{{$review->id}}').submit();"><i
                                                class="
                                    fa fa-times fa-2x" aria-hidden="true"></i></a></td>
                                </tr>
                                <form id="removeReview-form-{{$review->id}}"
                                      action="{{ route('admincms.customerReviewDelete', $review->id) }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
            @endif

            @if($page == 'bottomAdAll')
                <div class="content-panel col-md-9 content">
                    <div class="dashhead">
                        <div class="dashhead-titles">
                            <h6 class="dashhead-subtitle">Dashboards</h6>
                            <h2 class="dashhead-title">Bottom Ads (Max: 4 Ads)</h2>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" data-sort="table">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Link</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bottomAds as $bottomAd)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{route('cmsBottomAdImage.show', $bottomAd->image)}}"
                                                 alt="ad-image"
                                                 width="70" class="img-fluid rounded shadow-sm"/>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <a href="{{ $bottomAd->ad_link }}"
                                           target="_blank"><strong>{{$bottomAd->ad_link}}</strong></a>
                                    </td>
                                    <td><a href=""
                                           onclick="event.preventDefault(); document.getElementById('removeBottomAd-form-{{$bottomAd->id}}').submit();"><i
                                                class="
                                    fa fa-times fa-2x" aria-hidden="true"></i></a></td>
                                </tr>
                                <form id="removeBottomAd-form-{{$bottomAd->id}}"
                                      action="{{ route('admincms.bottomAdDelete', $bottomAd->id) }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>

            @endif

        </div>

    </div>
@endsection
