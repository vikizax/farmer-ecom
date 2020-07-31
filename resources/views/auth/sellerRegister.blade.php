@extends('layouts.layout')

@section('content')
<div class="container-fluid bg-light">
    <div class="text-center">
        <h1 class="my-5">REGISTER AS SELLER</h1>
    </div>
    <div class="d-flex align-items-center justify-content-center ">
        <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data" class="border p-3">
            @csrf
            <div class="form-group">
                <label for="proof-file">Please Provide ID Proof (Adhaar or PAN)</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="proof-file" name="image" required>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

</div>

@endsection
