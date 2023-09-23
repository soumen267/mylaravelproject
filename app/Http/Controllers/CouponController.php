<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Reedem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(! auth()->guard('admin')->user(), 403);
        $data = [];
        $product = Product::get();
        $getCoupons = Coupon::where('product','!=',Null)->pluck('product');
        $getCoupon = Coupon::sortable()->paginate(7);
        return view('coupons.index', compact('getCoupon','product','getCoupons'));
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        abort_if(! auth()->guard('admin')->user(), 403);
        $getProduct = Product::all();
        return view('coupons.create', compact('getProduct'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:coupons,name',
            'description' => 'nullable',
            'product' => 'nullable',
            'discount' => 'required',
            'type' => 'required',
            'percentage' => 'required|numeric',
            'maximum_value' => 'nullable|numeric',
            'maximum_usage' => 'nullable|digits_between:1,5',
            'expires_at' => 'nullable|after:yesterday'
        ]);
        $date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->expires_at)->format('Y-m-d');
        $saveCoupon = new Coupon();
        $saveCoupon->name = $request->name;
        $saveCoupon->description = $request->description;
        if($request->product){
            $saveCoupon->product = implode(',',$request->product);
        }
        $saveCoupon->percentage = $request->percentage;
        $saveCoupon->maximum_value = $request->maximum_value;
        $saveCoupon->maximum_usage = $request->maximum_usage;
        $saveCoupon->discount = $request->discount;
        $saveCoupon->type = $request->type;
        $saveCoupon->expires_at = $date;
        if($saveCoupon){
            $saveCoupon->save();
            return redirect(route('coupons.create'))->with('success', 'Coupon created successfully!');
        }else{
            return redirect(route('coupons.create'))->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        abort_if(! auth()->guard('admin')->user(), 403);
        $getProduct = Product::all();
        $products = explode(',',$coupon->product);
        return view('coupons.edit', compact('coupon','getProduct','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:coupons,name,'.$id,
            'description' => 'nullable',
            'product' => 'nullable',
            'discount' => 'required',
            'type' => 'required',
            'percentage' => 'nullable|numeric',
            'maximum_value' => 'nullable|numeric',
            'maximum_usage' => 'nullable|digits_between:1,5',
            'expires_at' => 'nullable|after:yesterday'
        ]);
        $date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->expires_at)->format('Y-m-d');
        $saveCoupon = Coupon::findOrFail($id);
        $saveCoupon->name = $request->name;
        $saveCoupon->description = $request->description;
        if($request->product){
            $saveCoupon->product = implode(',',$request->product);
        }
        $saveCoupon->percentage = $request->percentage;
        $saveCoupon->maximum_value = $request->maximum_value;
        $saveCoupon->maximum_usage = $request->maximum_usage;
        $saveCoupon->discount = $request->discount;
        $saveCoupon->type = $request->type;
        $saveCoupon->expires_at = $date;
        if($saveCoupon){
            $saveCoupon->update();
            return redirect(route('coupons.index'))->with('success', 'Coupon updated successfully!');
        }else{
            return redirect(route('coupons.index'))->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        if($coupon){
            $coupon->delete();
            return redirect(route('coupons.index'))->with('error', 'Coupon deleted successfully.');
        }else{
            return redirect(route('coupons.index'))->with('error', 'Something went wrong.');
        }
    }

    public function changeStatus(Request $request)
    {
        $user = Coupon::find($request->user_id);
        if($user){
            $user->is_active = $request->status;
            $user->save();
            return response()->json(['success'=>'Status change successfully.']);
        }else{
            return response()->json(['error'=>'Something went wrong.']);
        }
        
    }

    public function applyCoupon(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $today_date = Carbon::now()->format('Y-m-d');
        $coupon = Coupon::where('name', $request->name)->first();
        $checkExpired = Coupon::where('name', $request->name)
                        ->where('expires_at', '>=', $today_date)
                        ->first();
        $checkUserApplied = Reedem::where('coupon_code','=' ,$request->name)
                                    ->where('user_id', '=', Auth::id())
                                    ->first();
        if($checkUserApplied){
            return response()->json(['error'=>'Already applied.']);
        }else{
            $sessionproduct = [];
            foreach(session()->get('cart') as $key => $value){
                $sessionproduct[] = $value['prdid'];
            }
            $sessionprdid = implode(',',$sessionproduct);
            if($coupon){
                if($checkExpired){
                    if(is_null($coupon->product)){
                        $res = [];
                        foreach(session()->get('cart') as $key => $value){
                            if($coupon->discount == 'Percent'){
                                $res[] = ($value['price'] * $coupon->percentage) / 100;
                            }else{
                                $res[] = $coupon->percentage;
                            }                            
                        }
                        $sum = array_sum($res);
                        $coupon = array(
                                'name' => $request->name,
                                'discountamount' => $sum
                        );
                        session()->put('coupon', $coupon);
                        
                        return response()->json(['success'=>'Coupon applied.']);
                    }else{
                        $productID = explode(',',$coupon->product);
                        if(is_array($productID) && array_intersect($sessionproduct, $productID))
                        {
                            $key = array_intersect($productID, $sessionproduct);
                            $res = [];
                            foreach(session()->get('cart') as $keys => $value){
                                foreach($key as $k => $v){
                                    if($v == session()->get('cart')[$keys]['prdid']){
                                        if($coupon->discount == 'Percent'){
                                            $res[] = session()->get('cart')[$keys]['price'] = (session()->get('cart')[$keys]['price'] * $coupon->percentage) / 100;
                                        }else{
                                            $res[] = session()->get('cart')[$keys]['price'] = $coupon->percentage;
                                        }
                                        break;
                                    }
                                }
                            }
                            $sum = array_sum($res);
                            $coupon = array(
                                'name' => $request->name,
                                'discountamount' => $sum
                            );
                            session()->put('coupon', $coupon);
                            return response()->json(['success'=>'Coupon applied.']);
                        }else{
                            return response()->json(['error'=>'This product is not valid for this coupon.']);
                        }
                    }
                }else{
                    return response()->json(['error'=>'Coupon is already expired!']);
                }
                return response()->json(['success'=>'Coupon applied!']);
            }else{
                return response()->json(['error'=>'Invalid Coupon!']);
            }
        }
        
    }
}
