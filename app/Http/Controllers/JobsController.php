<?php

namespace App\Http\Controllers;
use App\Document;
use App\JobApplicant;
use App\JobApplication;
use App\Payment;
use App\Rules\AgeOfAdult;
use App\Rules\ProperName;
use App\Rules\KenyanPhoneCode;
use App\Rules\SafaricomLine;
use App\Rules\ValideID;
use App\App;
use App\Job;
use App\Testimonial;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Safaricom\Mpesa\Mpesa as Mpesa;

class JobsController extends Controller
{
    public function __construct()
    {
        $webdata = App::all()->first();
        $webdata->favicon = asset('storage').str_replace('public','',$webdata->favicon);
        $webdata->logo = asset('storage').str_replace('public','',$webdata->logo);
        session()->put('w',$webdata);
    }
    public function index(){
        $all = Job::all();
        $jobs = Job::with('company','period')->paginate(7);
        $cleansed = array();
//        return $jobs;
        foreach ($jobs as $job){
            $arr = [
                'id'=>$job->job_id,
                'title'=>$job->title,
                'location'=>$job->location,
                'period_name'=>$job->period->name,
                'period_id'=>$job->period->id,
                'company_logo'=>asset('storage'). str_replace('public','',$job->company->logo)?? "CJ5DE4oKpoyaWZhZ1e7wkceoJVd3KSKjcJmCkyhY.png",
                'company_name'=>$job->company->name
            ];
            $cleansed[] = $arr;
        }
        return view('jobs.main')->with(
            [
                'jobs'=>$cleansed,
                'jobs_count'=>count($all),
                'links'=>$jobs,
                'testimonials'=>$this->testimonials()
            ]);
    }
    public function Convert($array,$mode=0){
        if ($mode == 1){
            $arr = implode(',',$array);
//            foreach ($array as $value){
////                $arr .= $value.',';
////            }
            return $arr;
        }else{
            $arr = explode(',',$array);
            return $arr;
        }


    }
    public function job_single(Job $job){
        $company = $job->company();

        $cleansed = array(
            'id'=>$job->job_id,
            'title'=>$job->title,
            'period'=>$job->period()->select('name')->first()->name,
            'deadline'=>$job->deadline,
            'vacancy'=>$job->slots,
            'salary'=>$job->salary,
            'description'=>$job->description,
            'responsibility'=>$job->responsibility,
            'other_info'=>$job->other_information,
            'location'=>$job->location,
            'created_at'=>$job->created_at,
            'company_logo'=>$job->company()->select('logo')->first()->logo,
            'company_name'=>$job->company()->select('name')->first()->name
        );
//        dd($testimonials);
        return view('jobs.single')->with(['job'=>(object)$cleansed,'testimonials'=>$this->testimonials()]);
    }
    public function job_listing(Request $request){
        $all = count(Job::all());
        $jobs = Job::with('company','period')->paginate(7);
        $cleansed = array();
        foreach ($jobs as $job){
            $arr = [
                'id'=>$job->job_id,
                'title'=>$job->title,
                'location'=>$job->location,
                'period_name'=>$job->period->name,
                'period_id'=>$job->period->id,
                'company_logo'=>$job->company->logo,
                'company_name'=>$job->company->name
            ];
            $cleansed[] = $arr;
        }
        return view('jobs.all')->with(['jobs'=>$cleansed,'jobs_count'=>$all,'links'=>$jobs]);
    }
    public function testimonials($random = 5){
        $t = Testimonial::all()->random($random);
        $testimonials = [];
        foreach ($t as $item){
            $arr = [
                'details'=>$item->details,
                'name'=>$item->author_name,
                'image'=>$item->author_image,
                'career'=>$item->author_career
            ];
            $testimonials[] = (object)$arr;
        }
        return $testimonials;
    }
    public function recommendations(){
        $testimonials = $this->testimonials(20);
        $rantest = $this->testimonials(1);
        return view('jobs.testimonials')->with([
            'testimonials'=>$testimonials,
            'random_testimonial'=>(object)$rantest[0]
        ]);
    }
    public  function about(){
        return view('jobs.about');
    }
    public  function contact(){
        $test = $this->testimonials(4);
        return view('jobs.contact')->with([
            'testimonials'=>$test
        ]);
    }
    public function apply(Request $request, Job $job){
        if (session()->has('applicant')){
            return redirect()->route('jobs.prompt_pay',$job->job_id);
        }
        $cleansed = array(
                'id'=>$job->job_id,
                'title'=>$job->title,
                'period'=>$job->period()->select('name')->first()->name,
                'deadline'=>$job->deadline,
                'vacancy'=>$job->slots,
                'salary'=>$job->salary,
                'description'=>$job->description,
                'responsibility'=>$job->responsibility,
                'other_info'=>$job->other_information,
                'location'=>$job->location,
                'created_at'=>$job->created_at,
                'company_logo'=>$job->company()->select('logo')->first()->logo,
                'company_name'=>$job->company()->select('name')->first()->name
            );
        return view('jobs.apply')->with([
            'job'=>(object)$cleansed
        ]);
    }
    public function submit(Request $request,Job $job){
        $data = Validator::make($request->all(),[
            'first_name'=>['required', new ProperName()],
            'last_name'=>'string|max:30|required',
            'gender'=>'required',
            'email'=>'email|required',
            'dob'=>['required', new AgeOfAdult],
            'kra'=>'string|sometimes',
            'id_number'=>[
                'required',
                'min:7',
                'max:8',
                'regex:/^\d+$/',
                new ValideID()],
            'location'=>'required',
            'phone'=>[new KenyanPhoneCode(),new SafaricomLine()],
            'education_level'=>'required',
            'current_job'=>'required',
            'experience'=>'required',
            'availability'=>'required',
            'cv'=>'mimes:pdf|required',
            'other_documents.*'=>'file|mimes:pdf|sometimes',
            'application_letter'=>'required',
        ],[
            'first_name.required'=>'Please enter your first name.',
            'last_name.required'=>'Please enter your last name.',
            'gender.required'=>'Please specify your gender',
            'email.email'=>'Please enter a valid email',
            'email.required'=>'The email cannot be blank',
            'dob.required'=>'The date of birth field is required',
            'id_number.min'=> 'The ID Number must be at least 7 characters',
            'id_number.regex'=> 'Please enter a valid ID Number',
            'id_number.max'=> 'Your ID Number may not be greater than 8 characters.',
            'cv'=>'Kindly upload your CV in PDF format'
        ]);
        if ($data->fails()){
            return redirect()->back()->withErrors($data->errors())->withInput();
        }
        try{
            $applicant = new JobApplicant($request->input());
            $applicant->save();
            $cv = $request->file('cv')->store('public/documents');
            $cvfile = [
              'type'=>1,
              'path'=>$cv,
              'applicant_id'=>$applicant->applicant_id
            ];
            $cv = new Document($cvfile);
            $cv->save();
            foreach ($request->file('other_documents') as $static){
                $file = $static->store('public/documents');
                $doc = [
                    'type'=>2,
                    'path'=>$file,
                    'applicant_id'=>$applicant->applicant_id
                ];
                $doc = new Document($doc);
                $doc->save();
                //store the number in the session. will be used fpr payment.
                $number = $applicant->phone;
                $number = ltrim($number,'+');
                //the applicant's name
                $name = $applicant->first_name;
                //Add the application to the database
                $array = [
                    'applicant_id'=>$applicant->applicant_id,
                    'job_id'=>$job->job_id
                ];
                $application = new JobApplication($array);
                $application->save();
//                make an array of applicant's info to return to view
                $a = (object) [
                    'phone'=>$number,
                    'name'=>$name,
                    'job_id'=>$job->job_id,
                    'id'=>$applicant->applicant_id,
                    'application_id'=>$application->application_id
                ];
                session()->put('applicant',$a);
                return redirect()->route('jobs.prompt_pay',$job->job_id);
            }
//            return response([
//                'app'=>$applicant,
//                'cv'=>$cv,
//                'doc'=>$doc
//            ]);

        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput();
        }
    }
    public function prompt_pay(Job $job){
        if (!session()->has('applicant')){
            return redirect()->route('jobs.index');
        }
        return view('jobs.payments.prompt');
    }
    public function initiateSTK(){
        if (!session()->has('applicant')){
           return redirect()->route('jobs.index');
        }
        /*----------------------------------
         * Session Data for the applicant
         * ---------------------------------
        key = applicant(array)
          details
         * name
         * number
         * job_id
         * application_id
         * id
         * */
        $applicant = session()->get('applicant');
        //mpesa credentials
        $BusinessShortCode = '174379';
        $Amount = '1';
        $PartyA = $applicant->phone;
        $PartyB = $BusinessShortCode;
        $PhoneNumber = $PartyA;
        $CallBackURL = "https://a2e2cbd3.ngrok.io/api/careers/mpesa/callback";
//        $AccountReference = $applicant->id;
        $Remarks= 'Job Application Fee';
        $TransactionType = 'CustomerPayBillOnline';
        $AccountReference = $applicant->name;
        $TransactionDesc = 'Job Application Fee';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        //end of mpesa credentials
        $stkPushSimulation=new Mpesa();
        $stkPushSimulation = $stkPushSimulation->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);
        $decodedResponse = json_decode($stkPushSimulation, false);
        $checkoutRequestID= $decodedResponse->CheckoutRequestID;
        $merchant_request_id = $decodedResponse->MerchantRequestID;
        $arr = [
          'application_id'=>$applicant->application_id,
          'mrid'=>  $merchant_request_id,
            'crid'=>$checkoutRequestID
        ];
        $transaction = new Transaction($arr);
        $transaction->save();
        if (isset($decodedResponse->ResponseCode)) {
            $ResponseCode = $decodedResponse->ResponseCode;
            if ($ResponseCode == '0') {
//                $message = 'M-Pesa Express initiated successfully';
//                echo '<script type="text/javascript">alert("'.$message.'");</script>';
                return view('jobs.payments.complete');
            }
            $message = 'An error occurred while trying to initiate the process. Please try again';
            echo '<script type="text/javascript">alert("'.$message.'");</script>';
            return \redirect()->route('jobs.index');
        }
        /*if (isset($decodedResponse->errorCode)) {
            $errorMessage = $decodedResponse->errorMessage;
            $message = "We ran into a problem, our developers are working on it";
        }
        echo '<script type="text/javascript">alert("Internal server error. Our Developers are working on it");</script>';
        return \redirect('index');*/
    }
    public function callback(Request $request){
        $mpesa= new Mpesa();
        $callbackData=$mpesa->getDataFromCallback();
        $callbackData=json_decode($callbackData,false);
        if ($callbackData->Body->stkCallback->ResultCode == '0'){
            $resultCode=$callbackData->Body->stkCallback->ResultCode;
//            $resultDesc=$callbackData->Body->stkCallback->ResultDesc;
            $merchantRequestID=$callbackData->Body->stkCallback->MerchantRequestID;
            $checkoutRequestID=$callbackData->Body->stkCallback->CheckoutRequestID;
            $amount=$callbackData->Body->stkCallback->CallbackMetadata->Item[0]->Value;
            $mpesaReceiptNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[1]->Value;
//            $balance=$callbackData->Body->stkCallback->CallbackMetadata->Item[2]->Value;
            $transactionDate=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
            $phoneNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[4]->Value;
            $result=array(
//                "resultDesc"=>$resultDesc,
                "resultcode"=>$resultCode,
                "mrid"=>$merchantRequestID,
                "crid"=>$checkoutRequestID,
                "amount"=>$amount,
                "mpesa_receipt"=>$mpesaReceiptNumber,
                "date"=>$transactionDate,
                "phone"=>$phoneNumber
            );
            $transaction = Transaction::where('mrid','=',$merchantRequestID)->get()->first();
            $transaction->update($result);
            $transaction->save();
            $arr = [
                'application_id'=>$transaction->application_id,
                'transaction_id'=>$transaction->transaction_id,
                'paid'=>true
            ];
            $payment = new Payment($arr);
            $payment->save();
        }
        else{
            $merchantRequestID=$callbackData->Body->stkCallback->MerchantRequestID;
            $checkoutRequestID=$callbackData->Body->stkCallback->CheckoutRequestID;
            $resultCode=$callbackData->Body->stkCallback->ResultCode;
//            $resultDesc=$callbackData->Body->stkCallback->ResultDesc;
            $result = array(
                'resultcode'=>$resultCode
            );
            $transaction = Transaction::where('mrid','=',$merchantRequestID)->get()->first();
            $transaction->update($result);
            $transaction->save();
        }
    }
    public function getcodes(){
        if (!session()->has('applicant')){
           return redirect()->route('jobs.index');
        }
        /*----------------------------------
         * Session Data for the applicant
         * ---------------------------------
         * key = applicant(array)
         * details
         * name
         * number
         * job_id
         * application_id
         * id
         * */
        $applicant = session()->get('applicant');
        $payment = Payment::where('application_id','=',$applicant->application_id)
            ->where('paid','=',true)->get()->first();
        if ($payment === null){
            return view('jobs.payments.receipt')->with('response','No Payment has been received');
        }
        $codes = [
            'application_id' => $applicant->application_id,
            'applicant_id' => $applicant->id,
            'payment_id' => $payment->payment_id
        ];
        session_cache_expire('10');
        return view('jobs.payments.receipt')->with('codes',(object)$codes);
    }

}
