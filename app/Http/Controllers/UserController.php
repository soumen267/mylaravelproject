<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Cancellation;
use Illuminate\Http\Request;
use App\Mail\OrderCancellationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\OrderCancellationNotification;

class UserController extends Controller
{
    public function index(){
        $getUser = User::withTrashed()->sortable()->get();
        return view('users.index', compact('getUser'));
    }

    public function view(){
        return view('users.create');
    }

    public function createuser(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'image' => 'nullable'
        ]);
        $userdata = new User();
        $userdata->name = $request->name;
        $userdata->email = $request->email;
        $userdata->password = \bcrypt($request->password);
        if($request->file('image')){
            $file=$request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$file->move(public_path('public/images/users'), $filename);
            $file->storeAs('public/images/users', $filename);
            $userdata->image = $filename;
        }
        $userdata->save();
        return redirect(route('create'))->with('success', 'User Added successfully.');
    }

    public function edituser($id){
        $getUserById = User::find($id);
        return view('users.edit', compact('getUserById'));
    }

    public function updateuser(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $saveData = User::findOrFail($id);
        $saveData->name = $request->name;
        $saveData->email = $request->email;
        $saveData->password = \bcrypt($request->password);
        if($request->file('image')){
            $file=$request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->storeAs('public/images/users', $filename);
            $saveData->image = $filename;
        }
        
        $saveData->update();
        return redirect(route('userview'))->with('success', 'User Updated successfully.');
    }

    public function destroy($id){
        $data = User::find($id)->delete();
        return redirect(route('userview'))->with('error', 'User Deleted successfully.');
    }

    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        if($user){
            $user->status = $request->status;
            $user->save();
            return response()->json(['success'=>'Status change successfully.']);
        }else{
            return response()->json(['error'=>'Something went wrong.']);
        }
        
    }

    public function userprofileview(){
        $userprofile = User::where("id", '=', Auth::id())->first();
        return view('usersprofile', compact('userprofile'));

    }

    public function orderhistory(){
        $cancellation = Cancellation::where('user_id','=',Auth::id())->get();
        $orders = Billing::with('payment')->with('cancell')->sortable()->paginate(4);
        return view('orderhistory', compact('orders','cancellation'));

    }

    // Admin
    public function orderdetails(){
        $products = Product::get();
        $users = User::get();
        $orders = Billing::with('payment')->with('cancell')->sortable()->paginate(4);
        return view('orders', compact('orders','products','users'));

    }
    public function orderdetailss($id){
        $products = Product::get();
        $orders = Billing::with('payment')->with('cancell')->where('id','=',$id)->get();
        return view('ordersdetail',compact('orders','products'));
    }
    

    public function orderview(Request $request, $id){
        if($id){
            $orderview = Billing::with('payment')->with('cancell')->where('id','=',$id)->paginate(3);
        }
        return view('orderview', compact('orderview'));
    }

    public function cancelorderadmin(Request $request, $id){
        $request->validate([
            'feedback' => 'required'
        ]);
        $checks = Billing::with('payment')->where('id','=',$id)->first();
        if($checks){
            $checkexists = Cancellation::where('user_id','=',Auth::id())
                                    ->where('billing_id','=',$checks->id)
                                    ->exists();
            if($checkexists){
                return response()->json(['error'=>'Already cancelled this product.']);
            }else{
                $check = Billing::with('payment')->where('id','=',$id)->get();
                $order_id = 0;
                $productid = 0;
                foreach($check as $item){
                    foreach($item->payment as $value){
                        $order_id = $value->order_id;
                        $productid = $value->productname;
                    }
                }   
                $data = new Cancellation();
                $data->usertype = "admin";
                $data->user_id = 0;
                $data->product_id = $productid;
                $data->order_id = $order_id;
                $data->feedback = $request->feedback;
                $data->billing_id = $id;
                if($data){
                    $details = [
                        "greeting" => "Hi " .$checks->firstname,
                        "body" => "Admin has cancelled your order, Please see the below details:-",
                        "order_id" => 'Order ID: ' .$request->orderid,
                        "name" => 'Name:- ' .$checks->firstname." ".$checks->lastname,
                        "phone" => 'Phone:- ' .$checks->phone,
                        "email" => 'Email:- ' .$checks->email,
                        'message'=> 'Message:- ' .$request->feedback,
                        'thanks' => 'Thank you for using Ecommerce Store'
                    ];
                    $data->save();
                    Mail::to($checks->email)->send(new OrderCancellationMail($details));
                    return response()->json(['success'=>'You have successfully cancel this product.']);
                }else{
                    return response()->json(['error'=>'Something went wrong.']);
                }
                
            }
        }
    }
    public function cancelorder(Request $request){
        $request->validate([
            'feedback' => 'required'
        ]);
        $checkexists = Cancellation::where('user_id','=',Auth::id())
                                    ->where('product_id','=',$request->productid)
                                    ->where('order_id','=',$request->orderid)
                                    ->exists();
        if($checkexists){
            return response()->json(['error'=>'Already cancelled this product.']);
        }else{
            $user = User::where('id',Auth::id())->first();
            $data = new Cancellation();
            $data->user_id = Auth::id();
            $data->product_id = $request->productid;
            $data->order_id = $request->orderid;
            $data->feedback = $request->feedback;
            $data->billing_id = $request->billid;
            $email = $user->email;
            $details = [
                "greeting" => "Hi " .$user->firstname,
                "body" => "You have successfully cancel this order, Please see the below details:-",
                "order_id" => 'Order ID: ' .$request->orderid,
                "name" => 'Name:- ' .$user->firstname." ".$user->lastname,
                "phone" => 'Phone:- ' .$user->phone,
                "email" => 'Email:- ' .$user->email,
                'message'=> 'Message:- ' .$request->feedback,
                'thanks' => 'Thank you for using Ecommerce Store'
            ];
            if($data){
                $data->save();
                Mail::to($email)->send(new OrderCancellationMail($details));
                return response()->json(['success'=>'You have successfully cancel this product.']);
            }else{
                return response()->json(['error'=>'Something went wrong.']);
            }
        }
    }

    public function updateprofile(Request $request){
        $birth = Carbon::parse($request->birthdate)->format('Y-m-d');
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'companyname' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'birthdate' => 'nullable|before:today'
        ]);
                      if($request->file('image')){
                           $imagename = User::where('id', '=', $request->id)->first('image');
                           $imagePath = public_path('storage/images/users/'.$imagename->image);
                           if(File::exists($imagePath)){
                                File::delete($imagePath);
                            }
                           $file=$request->file('image');
                           $filename = date('YmdHi').$file->getClientOriginalName();
                           $file->storeAs('public/images/users', $filename);
                           $flight = User::where('id', '=', $request->id)->update(['image' => $filename]);
                      }else{
                        $flight = User::where('id', '=', $request->id)
                        ->orwhere('name', '=', $request->name)
                        ->orwhere('email', '=', $request->email)
                        ->orwhere('password', '=', $request->password)
                        ->update([
                                'firstname' => $request->get('firstname'),
                                'lastname' => $request->get('lastname'),
                                'companyname' => $request->get('companyname'),
                                'address' => $request->get('address'),
                                'phone' => $request->get('phone'),
                                'birthdate' => $birth
                        ]);
                      }
                    if($flight){
                        return redirect(route('userprofileview'))->with('success', 'User Updated successfully.');
                    }else{
                        return redirect(route('userprofileview'))->with('success', 'Wrong.');
                    }       
        
    }
}