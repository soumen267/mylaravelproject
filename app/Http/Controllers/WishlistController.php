<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\WishlistTrait;

class WishlistController extends Controller
{
    use WishlistTrait;
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $wishlists = Wishlist::where("user_id", "=", $user->id)->orderby('id', 'desc')->paginate(3);
        return view('wishlist', compact('user', 'wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->storewishlist($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        return redirect()->route('wishlist.index')->with('flash_message', 'Item successfully deleted');
    }

    public function cartadd(Request $request){
        if(Auth::user())
        {
        $getData = Product::findOrFail($request->productid);
        $prdid = $request->productid;
        $cart = session()->get('cart', []);
        if(isset($cart[$prdid])){
            $cart[$prdid]['qty']++;
        }else{
            if($request->qty){
                $cart[$prdid] = [
                    'id' => $prdid,
                    "name" => $getData->name,
                    "prdid" => $getData->id,
                    'qty' => $request->qty,
                    "price" => $getData->price,
                    "image" => $getData->image,
                ];
            }else{
                $cart[$prdid] = [
                    'id' => $prdid,
                    'name' => $getData->name,
                    "prdid" => $getData->id,
                    'qty' => 1,
                    "price" => $getData->price,
                    "image" => $getData->image,
                ];
            }
        }
        session()->put('cart', $cart);
        $data = Wishlist::findOrFail($request->id);
        $data->delete();
        return redirect()->back()->with('success', 'Product added to cart successfully!');
        }else{
        return redirect()->back()->with('error', 'Please login first');
        }
    }
}
