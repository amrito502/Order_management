@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Wishlist</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wishlists as $wishlist)
                    <tr>
                        <td>{{ $wishlist->product->name }}</td>
                        <td>${{ $wishlist->product->price }}</td>
                        <td>
                            <form action="{{ route('wishlists.destroy', $wishlist->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @php
                    $totalAmount = $wishlists->where('user_id', auth()->id())->sum(function ($wishlist) {
                        return $wishlist->product->price;
                    });
                @endphp
                <tr>
                    <td>Total Price</td>
                    <td>${{ $totalAmount }}.00</td>
                </tr>
            </tbody>
        </table>
        <form action="{{ route('orders.store') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Order Now</button>
        </form>
    </div>
@endsection
