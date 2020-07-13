<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index(){
        return view('index');
    }
    public function about(){
        return view('about');
    }
    public function services(){
        return view('services');
    }
    public function grant(){
        return view('grant');
    }
    public function contact(){
        return view('contact');
    }
    public function signup(){
        return view('signup');
    }
    public function regcom(){
        return view('regcom');
    }
    public function initiate(){
        return view('initiate');
    }
    public function homepage(){
        return view('index');
    }
    public function contact_post(Request $request){
        $data = Validator::make($request->all(),[
            'name'=>'string|required',
            'email'=>'email|required',
            'subject'=>'string|required',
            'message'=>'required|string|min:100|max:1500'
        ]);
        if ($data->fails()){
            return redirect()->back()->withErrors($data->errors())->withInput();
        }
        $data= (object) $data->validated();
        Mail::to($request->get('email'))->send(new ContactForm($data));
        return redirect()->back()->with('success','Message submitted successfully');
    }
}
