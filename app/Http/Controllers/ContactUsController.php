<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Notifications\ContactUsNotification;
use Illuminate\Support\Facades\Notification;

class ContactUsController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function store(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:contacts,email',
            'phone' => 'required',
            'message' => 'required'
        ]);
        $contact = new Contact();
        $contact->firstname = $request->firstname;
        $contact->lastname = $request->lastname;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $details = [
            "greeting" => "Hi Admin",
            "body" => "Someone tried to contact you, Please see the below details:-",
            "name" => 'Name:- ' .$contact->firstname." ".$contact->lastname,
            "phone" => 'Phone:- ' .$contact->phone,
            "email" => 'Email:- '.$contact->email,
            'message'=> 'Message:- ' .$contact->message,
            'thanks' => 'Thank you for using Ecommerce Store'
        ];
        
        if($contact){
            $contact->save();
            //Notification::route('Mail', ['soumen8412@gmail.com' => 'Ecommerce Store'])->
            $contact->notify(new ContactUsNotification($details));
            return response()->json(['success' => 'Thank you for contact us. we will contact you shortly!.']);
        }else{
            return response()->json(['error' => 'Something went wrong.']);
        }
    }
}
