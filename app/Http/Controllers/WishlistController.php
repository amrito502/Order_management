<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())->get();
        return view('wishlists.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'product_id' => 'required|exists:products,id',
        // ]);

        Wishlist::updateOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('wishlists.index');
    }

    public static function wishlistCount()
    {
        $totalWishlists = Wishlist::where('user_id', Auth::id())->count();
        $totalWishlists = $totalWishlists > 9 ? '9+' : $totalWishlists;
        $totalWishlists = $totalWishlists > 0 ? $totalWishlists : '';
        return $totalWishlists();
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect()->route('wishlists.index');
    }
}
