<?php
namespace App\Traits;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait WishlistTrait {

    public function storewishlist(Request $request){
        $this->validate($request, array(
            'user_id'=>'required',
            'product_id' =>'required',
        ));
        $status=Wishlist::where('user_id',$request->user_id)
                ->where('product_id',$request->product_id)
                ->first();
        if(isset($status->user_id) and isset($request->product_id))
            {
                return redirect()->back()->with('flash_messaged', 'This item is already in your wishlist!');
            }
        else
            {
                
            $wishlist = new Wishlist;
            
            $wishlist->user_id = Auth::user()->id;
            $wishlist->product_id = $request->product_id;
    
            $wishlist->save();

            return redirect()->back()->with('flash_message', 'Item, '. $wishlist->product->title.' Added to your wishlist.');
            }
    }

}
?>