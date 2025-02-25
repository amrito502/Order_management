@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cart</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <td>{{ $cart->product->name }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>{{ $cart->product->price * $cart->quantity }}</td>
                <td>
                    <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('orders.store') }}" class="btn btn-primary">Checkout</a>
</div>
@endsection
