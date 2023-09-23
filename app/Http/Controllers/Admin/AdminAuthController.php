<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class AdminAuthController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $user = auth()->guard('admin')->user();
            // if($user->is_admin == 1){
                return redirect()->route('adminDashboard')->with('success','You are Logged in successfully.');
            // }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }
 
    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout successfully');
        return redirect(route('adminLogin'));
    }

    public function getadminInfo(){
        abort_if(! auth()->guard('admin')->user(), 403);
        $getData = Admin::get();
        return view('admin.adminownetails', compact('getData'));
    }

    public function editadmininfo($id){
        abort_if(! auth()->guard('admin')->user(), 403);
        $getData = Admin::find($id);
        return view('admin.edit', compact('getData'));
    }

    public function updateadmininfo(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $updateData = Admin::find($id);
        $updateData->name = $request->name;
        $updateData->email = $request->email;
        $updateData->password = $request->password;
        $updateData->save();
        return redirect(route('getadminInfo'))->with('success', 'User updated successfully.');
    }
}
