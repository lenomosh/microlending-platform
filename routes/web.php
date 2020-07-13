<?php

use App\App;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontController@index')->name('loans.index');
Route::get('/about', 'FrontController@about');
Route::get('/services', 'FrontController@services');
Route::get('/grant', 'FrontController@grant');
Route::get('/contact', 'FrontController@contact');
Route::post('/contact', 'FrontController@contact_post');
Route::get('/signup', 'FrontController@signup');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/index', 'FrontController@homepage');
Route::get('/index', 'FrontController@homepage');
Route::get('/pay', 'FrontController@pay');
//Route::get('/regcom', 'FrontController@regcom');

Route::post('/regcom/initiate', 'SignupController@initiate');
Route::post('/regcom/regcom/initiate', 'SignupController@initiate');
Route::post('/regcom/checkstatus', 'SignupController@status');
Route::post('/mpesacall', 'SignupController@callbackurl');
Route::post('/signup', 'SignupController@fetch');
Route::post('/regcom/signup', 'SignupController@fetch');
Route::post('/regcom', 'SignupController@fetch');
Route::get('/regcom', function () {
    // Retrieve a piece of data from the session...
    if (Session::has('name')){
        return view('regcom');
    }else
    return view('signup');
});
Route::get('back/admin/','BackController@index')->name('back.main');
Route::middleware('auth')->group(function (){
    Route::prefix('back/admin')->group(function (){
        Route::get('company','CompanyController@index')->name('company.index');
        Route::post('company/store','CompanyController@store')->name('company.store');
        Route::get('field','FieldController@index')->name('field.index');
        Route::get('requirement','RequirementController@index')->name('requirement.index');
        Route::get('skill','SkillController@index')->name('skill.index');
        Route::get('app','AppController@index')->name('app.index');
        Route::put('app/update','AppController@update')->name('app.update');
        Route::resource('testimonial','TestimonialController');
        Route::resource('applications','JobApplicationController');
        Route::resource('job','JobController');
//    Route::resource('field','FieldController');
//    Route::resource('company','CompanyController');
    });

});
Route::prefix('careers')->group(function (){
    Route::get('/','JobsController@index')->name('jobs.index');
    Route::get('/job-listing','JobsController@job_listing')->name('jobs.all');
    Route::get('/testimonials','JobsController@recommendations')->name('jobs.testimonials');
    Route::get('/about', 'JobsController@about')->name('jobs.about');
    Route::get('/contact','JobsController@contact')->name('jobs.contact');
    Route::get('/job_info/{job}','JobsController@job_single')->name('jobs.single');
    Route::get('/job_info/{job}/apply', 'JobsController@apply')->name('jobs.apply');
    Route::post('/job_info/{job}/apply', 'JobsController@submit')->name('jobs.apply.submit');
    Route::get('/job_info/{job}/apply/final_step', 'JobsController@prompt_pay')->name('jobs.prompt_pay');
    Route::get('/job_info/{job}/apply/stkpush', 'JobsController@initiateSTK')->name('jobs.initiateSTK');
    Route::get('/job_info/{job}/apply/stkpush/codes', 'JobsController@getcodes')->name('jobs.getCodes');
    Route::get('flush', function () {
//        dd(\session('applicant'));
        \session()->flush();
//        return redirect()->route('jobs.index');
    });
    Route::get('put', function () {
        $a = (object) [
            'phone'=>254759387453,
            'name'=>'Lennox',
            'job_id'=>2,
            'application_id'=>'4c18d4e6-6e20-4225-9b5f-8ee8d55bb730',
            'id'=>'e096a2b4-c3d4-49c0-8ee0-f4ec18c834ed'
        ];
        session()->put('applicant',$a);
//        return redirect()->route('jobs.index');
    });
});






