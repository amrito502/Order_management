@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-3" style="font-size: 40px">Products</h1>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <h4><strong>Product ID</strong> : {{ $product->id }}</h4>
                    <h4><strong>User ID</strong> : {{ auth()->user()->id }}</h4>
                    <h4><strong>Product name</strong> : {{ $product->name }}</h4>
                    <p><strong>Product Desc</strong> : {{ $product->description }}</p>
                    <p class="mb-3"><strong>Product Price</strong> : {{ $product->price }}</p>
                    <form action="{{ route('wishlists.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
