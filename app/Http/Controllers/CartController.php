<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Token;
use Stripe\Stripe;
use App\Models\View;
use App\Models\Coupon;
use App\Models\Reedem;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    public function getshop(Request $request){
        $popular = Payment::select('productname', DB::raw('COUNT(*) as `count`'))->groupBy('productname')->orderBy('count', 'DESC')->limit(5)->pluck('productname')->toArray();
        $popularProduct = Product::query()->whereIn('id',$popular)->orderBy('price','desc')->get();
        
        if($request->input('min') || $request->input('max')){
            $getProduct = Product::whereBetween('price', [$request->input('min'), $request->input('max')])
                          ->orderBy('price')
                          ->paginate(12);
            $category = Category::whereHas('products')->get();
            return response()->json([
                'getProduct' => $getProduct,
                'category' => $category
                ]);
        }
        if(request()->id){
            $product = Product::get();
            $minprice = $product->min('price');
            $maxprice = $product->max('price');
            // if(request()->id == 0){
            //     $getProduct = Product::inRandomOrder()->paginate(12);
            // }
            $getProduct = Product::with('categories')->where('category_id', request()->id)->orderBy('price')->paginate(12);
            $getDesc = Product::with('categories')->where('category_id', request()->id)->get();
            $desc = '';
            $catname = '';
            foreach($getDesc as $row){
                $desc = $row->categories->description;
                $catname = $row->categories->name;
            }
            $checkExist = Product::with('categories')->where('category_id', request()->id)->exists();
            $category = Category::all();
            if($checkExist == true){
                return response()->json([
                    'getProduct' => $getProduct,
                    'minprice' => $minprice,
                    'maxprice' => $maxprice,
                    'category' => $category,
                    'message' => '',
                    'desc' => $desc,
                    'catname' => $catname
                ]);
            }else{
                return response()->json([
                    'getProduct' => $getProduct,
                    'category' => $category,
                    'minprice' => $minprice,
                    'maxprice' => $maxprice,
                    'message' => 'Product not found',
                    'desc' => 'No description found',
                    'catname' => ''
                ]);
            }
            
        }else{
            $product = Product::get();
            $minprice = $product->min('price');
            $maxprice = $product->max('price');
            $getProduct = Product::orderBy('price', 'desc')->inRandomOrder()->paginate(12);
            $category = Category::all();
        }
        return view('shop', compact('getProduct','minprice','maxprice','category','popularProduct'));
    }

    public function recentView(Request $request){
        $data = new View();
        $data->user_id = $request->user_id;
        $data->product_id = $request->product_id;
        $data->save();        
    }

    public function getSingleProuctByID(Request $request, $id){
        if(Auth::id()){
            $getRecentView = DB::table('views')
            ->join('products', 'products.id', '=', 'views.product_id')
            ->where('user_id','=',Auth::id())
            ->select('products.id as id', 'products.name as name', 'products.image as image', 'products.originalprice as originalprice', 'products.price as price')
            ->distinct()
            ->get();
        $getProduct = Product::findOrFail($request->id);
        $relatedProduct = Product::with('categories')->where('category_id','=',$getProduct->category_id)->get();
        return view('single', compact('getProduct','relatedProduct','getRecentView'));
        }else{
            return redirect()->route('home');
            //return response()->json(['error'=>'Please login first to view.']);
        }
        
    }
    
    public function getProductById(Request $request){
        $getProductsById = Product::findOrFail($request->id);
        if($getProductsById){
            return $getProductsById;
        }else{
            return response()->json(['error'=>'Something went wrong.']);
        }
        
    }

    public function show(){
        $cartdata = session()->get('cart');
        if(empty(session()->get('cart'))){
            return redirect()->route('shop');
        }
        return view('cart', ['cartdata' => $cartdata]);
    }

    public function addcart(Request $request, $id){
        if(Auth::user())
        {
        $getData = Product::findOrFail($request->id);
        $prdid = $request->id;
        //dd($getData);
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
        $cartdata = session()->get('cart', $cart);
            return response()->json([
                'success'=> 'Product added to cart successfully!.',
                'product' => $cartdata
            ]);
        }else{
           return response()->json(['error'=>'Please login first.']);
        }
    }

    public function cartUpdate(Request $request, $id){
        $cart = session()->get('cart');
        if($request->data == 'decrement'){
            if($request->qty == 1){
                $cart[$request->id]['qty'] ++;
            }
            $cart[$request->id]['qty'] --;
            session()->put('cart', $cart);
            $cartdata = session()->get('cart');
            return response()->json($cartdata);
        }elseif($request->data == "increment"){
            $cart[$request->id]['qty'] ++;
            session()->put('cart', $cart);
            $cartdata = session()->get('cart');
            return response()->json($cartdata);
        }else{
            return response()->json(['error'=>'Something went wrong.']);
        }
    }

    public function cartDeleteByID(Request $request){
        if($request->id){
        $cart = session()->get('cart');
        if(isset($cart[$request->id])){
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
            $cartdata = session()->get('cart');
            // return response()->json([
            //     'cartdata' => $cartdata,
            //     'status'=>202,
            //     'message'=>'Success!',
            // ]);
            return response()->json($cartdata);
        }
    }

    public function cartDelete(Request $request){
        if(session()->get('cart')){
            session()->forget('cart');
            $cartdata = session()->get('cart');
            // return response()->json([
            //     'cartdata' => $cartdata,
            //     'status'=>202,
            //     'message'=>'Success!',
            // ]);
            return response()->json($cartdata);
        }else{
            $cartdata = session()->get('cart');
            return response()->json([
                'cartdata' => $cartdata,
                'status'=>404,
                'message'=>'Error!',
            ]);
        }
    }

    public function checkout(){
        if(empty(session()->get('cart'))){
            session()->forget('coupon');
            return redirect()->route('shop');
        }
        $value = env("COUNTRY_API");
        $url = "https://api.countrystatecity.in/v1/countries/";
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-CSCAPI-KEY: '.$value.''
          ),
        ));
        $response = curl_exec ($ch);
        $err = curl_error($ch);  //if you need
        curl_close ($ch);
        $country = json_decode($response, true);
        return view('checkout', compact('country'));
    }

    public function getStatesByCountry(Request $request, $id){
        $value = env("COUNTRY_API");
        $ids = $request->id;
        $url = "https://api.countrystatecity.in/v1/countries/$ids/states";
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-CSCAPI-KEY: '.$value.''
          ),
        ));
        $response = curl_exec ($ch);
        $err = curl_error($ch);  //if you need
        curl_close ($ch);
        if($err){
            return "cURL Error #:" . $err;
        }else{
            return $response;
        }
        
    }
   

    public function processOrder(Request $request){
        //dd($request->all());
        $request->validate([
            "firstname" => 'required',
            "lastname" => 'required',
            "email" =>  'required|email',
            "telephone" => 'required|numeric',
            "company" => 'required',
            "address_1" => 'required',
            "address_2" => 'nullable',
            "city" => 'required',
            "postcode" => 'required|numeric',
            "country_id" => 'required',
            "zone_id" => 'required',
            "notes" => 'nullable',
            'cardno' => 'required_if:cashondelivery,0',
            'year' => 'required_if:cashondelivery,0',
            'month' => 'required_if:cashondelivery,0',
            'cvv' => 'required_if:cashondelivery,0',
            'cashondelivery' => 'nullable',
            'cardtype' => 'required'
        ]);
                $iscrm = 0;
                foreach(session()->get('cart') as $key => $row){
                    //if($row['prdid'] != 1 || $row['prdid'] != 2){
                    if($row['prdid'] == 1){
                        $iscrm = 1;
                    }
                }
                if($iscrm == 0){
                    $token = null;
                    try{
                        $token = $this->stripe->tokens->create([
                            'card' => [
                                'number' => $request->cardno,
                                'exp_month' => $request->month,
                                'exp_year' => $request->year,
                                'cvc' => $request->cvv,
                                ],
            
                        ]);
                        $charge = null;
                        $charge = $this->stripe->charges->create([
                            'card' => $token['id'],
                            'currency' => 'INR',
                            'amount' =>  100 * 100,
                            'description' => 'wallet',
                        ]);
                        if($charge['status'] == 'succeeded') {
                            $data = new Billing();
                            $data->firstname = $request->firstname;
                            $data->lastname = $request->lastname;
                            $data->company = $request->company;
                            $data->address_1 = $request->address_1;
                            $data->address_2 = $request->address_2;
                            $data->country_id = $request->country_id;
                            $data->city = $request->city;
                            $data->zone_id = $request->zone_id;
                            $data->postcode = $request->postcode;
                            $data->email = $request->email;
                            $data->telephone = $request->telephone;
                            $data->save();
                            $ordersid = rand(1000000,9999999);
                            foreach(session()->get('cart') as $key => $row){
                                $newData = new Payment();
                                $newData->order_id = $ordersid;
                                $newData->billing_id = $data->id;
                                $newData->user_id = Auth::id();
                                $newData->productname = $row['prdid'];
                                $newData->qty = $row['qty'];
                                $newData->price = $row['price'];
                                $newData->image = $row['image'];
                                $newData->tranaction_id = $charge->id;
                                $newData->last4 = $charge->payment_method_details->card->last4;
                                $newData->cardtype = $request->cardtype;
                                $newData->paymentstatus = $charge['status'];
                                $newData->save();
                            }
                            $couponamount = 0;
                            if(Session::has('coupon')){
                                $sessionproduct = [];
                                foreach(session()->get('cart') as $key => $value){
                                    $sessionproduct[] = $value['prdid'];
                                }
                                $sessionprdid = implode(',',$sessionproduct);
                                $reedem = new Reedem();
                                $reedem->coupon_code = session()->get('coupon.name');
                                $reedem->user_id = Auth::id();
                                $reedem->product_id = $sessionprdid;
                                $reedem->save();
                                $couponamount = session()->get('coupon.discountamount');
                                $billid = array(
                                    'id' => $data->id,
                                    'couponamount' => $couponamount
                                );
                                $orddata = [
                                    "order_id" => $newData->order_id,
                                    "firstname" => $request->firstname,
                                    "lastname" => $request->lastname,
                                    "address_1" => $request->address_1,
                                    "address_2" => $request->address_2,
                                    "country" => $request->country_id,
                                    "city" => $request->city,
                                    "zone_id" => $request->zone_id,
                                    "postcode" => $request->postcode,
                                    "email" => $request->email,
                                    "title" => "Order Confirmation",
                                    "body" => "This is Demo"
                                ];
                                session()->put('thankyoudata', $billid);
                                $data = session()->get('thankyoudata');
                                $productdata = Product::all();
                                $product = Billing::with('payment')->where('id', '=', $data)->get();
                                Mail::to($orddata['email'])->send(new OrderConfirmation($orddata,$product,$productdata));
                                session()->forget('cart');
                                session()->forget('coupon');
                            }else{
                                //dd($product);
                                $orddata = [
                                    "order_id" => $newData->order_id,
                                    "firstname" => $request->firstname,
                                    "lastname" => $request->lastname,
                                    "address_1" => $request->address_1,
                                    "address_2" => $request->address_2,
                                    "country" => $request->country_id,
                                    "city" => $request->city,
                                    "zone_id" => $request->zone_id,
                                    "postcode" => $request->postcode,
                                    "email" => $request->email,
                                    "title" => "Order Confirmation",
                                    "body" => "This is Demo"
                                ];
                            //dd($orddata);
                            //$pdf = View::make('mail.orderconfirm', $orddata);
                            $billid = array(
                                    'id' => $data->id,
                                );
                            session()->put('thankyoudata', $billid);
                            $data = session()->get('thankyoudata');
                            $productdata = Product::all();
                            $product = Billing::with('payment')->where('id', '=', $data)->get();
                            Mail::to($orddata['email'])->send(new OrderConfirmation($orddata,$product,$productdata));
                            session()->forget('cart');
                            session()->forget('coupon');
                            }
                            
                            return response()->json(['success'=> 'Payment Success!']);
                            
                        } else {
                            return response()->json(['error'=> 'Something went to wrong.']);
                        }
                    }catch(\Exception $e){
                            return response()->json(['error'=> $e->getMessage()]);
                            //dd($e->getMessage());
                    }
                }elseif($iscrm == 1){
                $expdate = $request->month . substr( $request->year, -2);
                        $crmpush = $this->crmorderpush(
                            $request->firstname, 
                            $request->lastname,
                            $request->address_1,
                            $request->city,
                            $request->zone_id,
                            $request->postcode,
                            $request->country_id,
                            $billingSameAsShipping = "YES",
                            $billingFirstName = null,
                            $billingLastName = null,
                            $billingAddress1 = null,
                            $billingCity = null,
                            $billingState = null,
                            $billingZip = null,
                            $billingCountry = null,
                            $request->telephone,
                            $request->email,
                            $request->cardtype,
                            $request->cardno,
                            $expdate,
                            $request->cvv
                        );
                // echo "<pre>";
                // print_r($crmpush);
                // die;
                try {
                    $data = new Billing();
                    $data->firstname = $request->firstname;
                    $data->lastname = $request->lastname;
                    $data->company = $request->company;
                    $data->address_1 = $request->address_1;
                    $data->address_2 = $request->address_2;
                    $data->country_id = $request->country_id;
                    $data->city = $request->city;
                    $data->zone_id = $request->zone_id;
                    $data->postcode = $request->postcode;
                    $data->email = $request->email;
                    $data->telephone = $request->telephone;
                    $data->save();

                foreach(session()->get('cart') as $key => $row){
                    $newData = new Payment();
                    $newData->order_id = $crmpush->order_id;
                    $newData->billing_id = $data->id;
                    $newData->user_id = Auth::id();
                    $newData->productname = $row['prdid'];
                    $newData->qty = $row['qty'];
                    $newData->price = $row['price'];
                    $newData->image = $row['image'];
                    $newData->tranaction_id = $crmpush->order_id;
                    $newData->last4 = substr($request->cardno,-4);
                    $newData->cardtype = $request->cardtype;
                    $newData->paymentstatus = $crmpush->resp_msg;
                    $newData->save();
                }
                $couponamount = 0;
                if(Session::has('coupon')){
                    $sessionproduct = [];
                    foreach(session()->get('cart') as $key => $value){
                        $sessionproduct[] = $value['prdid'];
                    }
                    $sessionprdid = implode(',',$sessionproduct);
                    $reedem = new Reedem();
                    $reedem->coupon_code = session()->get('coupon.name');
                    $reedem->user_id = Auth::id();
                    $reedem->product_id = $sessionprdid;
                    $reedem->save();
                    $couponamount = session()->get('coupon.discountamount');
                    $billid = array(
                        'id' => $data->id,
                        'couponamount' => $couponamount
                    );
                    $orddata = [
                        "order_id" => $newData->order_id,
                        "firstname" => $request->firstname,
                        "lastname" => $request->lastname,
                        "address_1" => $request->address_1,
                        "address_2" => $request->address_2,
                        "country" => $request->country_id,
                        "city" => $request->city,
                        "zone_id" => $request->zone_id,
                        "postcode" => $request->postcode,
                        "email" => $request->email,
                        "title" => "Order Confirmation",
                        "body" => "This is Demo"
                    ];
                    session()->put('thankyoudata', $billid);
                    $data = session()->get('thankyoudata');
                    $productdata = Product::all();
                    $product = Billing::with('payment')->where('id', '=', $data)->get();
                    Mail::to($orddata['email'])->send(new OrderConfirmation($orddata,$product,$productdata));
                    session()->forget('cart');
                    session()->forget('coupon');
                }else{
                    //dd($product);
                    $orddata = [
                        "order_id" => $newData->order_id,
                        "firstname" => $request->firstname,
                        "lastname" => $request->lastname,
                        "address_1" => $request->address_1,
                        "address_2" => $request->address_2,
                        "country" => $request->country_id,
                        "city" => $request->city,
                        "zone_id" => $request->zone_id,
                        "postcode" => $request->postcode,
                        "email" => $request->email,
                        "title" => "Order Confirmation",
                        "body" => "This is Demo"
                    ];
                    //dd($orddata);
                    //$pdf = View::make('mail.orderconfirm', $orddata);
                    $billid = array(
                            'id' => $data->id,
                        );
                    session()->put('thankyoudata', $billid);
                    $data = session()->get('thankyoudata');
                    $productdata = Product::all();
                    $product = Billing::with('payment')->where('id', '=', $data)->get();
                    Mail::to($orddata['email'])->send(new OrderConfirmation($orddata,$product,$productdata));
                    session()->forget('cart');
                    session()->forget('coupon');
                }
                return response()->json(['success', 'Payment Success!']);
            }catch (Exception $e) {
                    $message = $e->getMessage();
                    return response()->json(['error'=> $message]);
        
                    $code = $e->getCode();       
                    return response()->json(['error'=> $code]);
        
                    $string = $e->__toString();       
                    return response()->json(['error'=> $string]);
                    exit;
                }
            }

    }

    public function crmorderpush(
        $firstName,
        $lastName,
        $shippingAddress1,
        $shippingCity,
        $shippingState,
        $shippingZip,
        $shippingCountry,
        $billingSameAsShipping,
        $billingFirstName = null,
        $billingLastName = null,
        $billingAddress1 = null,
        $billingCity = null,
        $billingState = null,
        $billingZip = null,
        $billingCountry = null,
        $phone = null,
        $email,
        $creditCardType,
        $creditCardNumber,
        $expirationDate,
        $CVV
        )
        {
        $data = array();
                foreach(session()->get('cart') as $key => $row){
                    if($row['prdid'] == 1){
                        $prdid = 907;
                    }elseif($row['prdid'] == 2){
                        $prdid = 908;
                    }else{
                        $prdid = 907;
                    }
                    $rec = array(
                        "offer_id" => 107,
                        "product_id"=> (int)$prdid,
                        "billing_model_id"=> 2,
                        "quantity" => $row['qty']
                    );
                    array_push($data, $rec);
                }
        $query = json_encode($data);
        $postdata = '{
            "firstName": "'.$firstName.'",
            "lastName": "'.$lastName.'",
            "currency": "USD",
            "billingFirstName": "'.$billingFirstName.'",
            "billingLastName": "'.$billingLastName.'",
            "billingAddress1": "'.$billingAddress1.'",
            "billingCity": "'.$billingCity.'",
            "billingState": "'.$billingState.'",
            "billingZip": "'.$billingZip.'",
            "billingCountry": "'.$billingCountry.'",
            "phone": "'.$phone.'",
            "email": "'.$email.'",
            "creditCardType": "'.$creditCardType.'",
            "creditCardNumber": "'.$creditCardNumber.'",
            "expirationDate": "'.$expirationDate.'",
            "CVV": "'.$CVV.'",
            "shippingId": "8",
            "tranType": "Sale",
            "ipAddress": "2600:1003:b110:ce17:fc26:ae54:ad0d:f67",
            "campaignId": "125",
            "offers": '.$query.',
            "billingSameAsShipping": "'.$billingSameAsShipping.'",
            "shippingAddress1": "'.$shippingAddress1.'",
            "shippingCity": "'.$shippingCity.'",
            "shippingState": "'.$shippingState.'",
            "shippingZip": "'.$shippingZip.'",
            "shippingCountry": "'.$shippingCountry.'",
            "preserve_force_gateway": "1"
        }';
        //dd($postdata);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sandboxdemo.sticky.io/api/v1/new_order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postdata,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic Y3J5cHRvdGVzdGRldjpQMmdjRTY0cVNSTXJRdA=='
        ),
        ));

        $response = curl_exec($curl);
        if(curl_errno($curl)){
            echo 'Curl error: '.curl_error($curl);
        }
        curl_close($curl);
        return json_decode($response);
        //die;
    }
    public function cartCount(){
        if(session()->get('cart')){
            $cartcount = count(session()->get('cart'));
        }else{
            $cartcount = 0;
        }        
        return response()->json(['count' => $cartcount]);
    }
    public function wishCount(){
        $wishcount = Wishlist::where('user_id', Auth::id())->get();
        $count = count($wishcount);
        return response()->json(['count' => $count]);
    }
    public function thankyou(){
        $data = session()->get('thankyoudata');
        $productdata = Product::all();
        $bill = Billing::with('payment')->where('id', '=', $data)->get();
        return view('thank-you',compact('bill','productdata'));
    }

}
