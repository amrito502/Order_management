<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $wishlists = Wishlist::where('user_id', auth()->id())->get();
         $totalAmount = $wishlists->sum(function ($wishlists) {
            return $wishlists->product->price;
        });

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
        ]);

        $wishlists->each->delete();

        return redirect()->route('orders.index');
    }
}
