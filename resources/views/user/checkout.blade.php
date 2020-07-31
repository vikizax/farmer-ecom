@extends('layouts.layout')


@section('content')
<div class="container-fluid order-bg p-4">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-md-6">
            <div class="collapse" id="promo">
                <div class="form-group">
                    <label for="inputpromo" class="control-label">Promo Code</label>
                    <div class="form-inline">
                        <input type="text" class="form-control" id="inputpromo" placeholder="Enter promo code" />
                        <button class="btn btn-sm">Apply</button>
                    </div>
                </div>
            </div>
            <h3>Ship my order to&hellip;</h3>
            <div class="list-group">

                <div class="list-group-item">
                    <div class="list-group-item-heading">

                        <form role="form" action="{{route('pay', $cart_id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="inputname">Name</label>
                                <input type="text" class="form-control form-control-large" id="inputname"
                                    placeholder="Enter name" name="name" required/>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress1">Address</label>
                                <input type="text" class="form-control form-control-large" id="inputAddress1"
                                    placeholder="Enter address" name="address" required/>
                            </div>
                            <div class="form-group">
                                <label for="inputZip">PIN Code</label>
                                <input type="text" class="form-control form-control-small" id="inputZip"
                                    placeholder="Enter PIN Code" name="pincode" required/>
                            </div>
                            <div class="form-group">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Enter city" name="city" required/>
                            </div>
                            <div class="form-group">
                                <label for="inputState" class="control-label">State</label>
                                <select class="form-control form-control-large" name="state" required>
                                    <option value="Assam">Assam</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputState" class="control-label">Phone Number</label>
                                <input type="number" class="form-control form-control-small" id="phoneno"
                                placeholder="Phone Number" name="phone" required/>
                            </div>
                            <center>
                                <button type="Submit" class="btn btn-dark btn-sm">
                                    Proceed to Pay
                                </button>
                            </center>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
