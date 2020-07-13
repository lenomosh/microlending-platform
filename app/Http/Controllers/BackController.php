<?php

namespace App\Http\Controllers;
use App\Company;
use App\Job;
use App\JobApplicant;
use App\JobApplication;
use App\Payment;
use App\Testimonial;
use App\Transaction;
use Illuminate\Http\Request;

class BackController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
 public function index (Request $request){
     $data = [
         'applicants'=>count(JobApplicant::all()),
         'applications'=>count(JobApplication::all()),
         'jobs'=>count(Job::all()),
         'testimonials'=>count(Testimonial::all()),
         'companies'=>count(Company::all()),
         'earnings'=>count(Payment::where('paid','=','1')->get())*100,
         'transaction_attempts'=>count(Transaction::all()),
         'failed_attempts'=>count(Transaction::where('resultcode','!=','0')->get())
     ];
     return view('back.index')->with('data',(object)$data);
 }
}
