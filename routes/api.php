<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->group(function (){
    Route::prefix('field')->group(function (){
        Route::post('store','FieldController@store')->name('api.field.store');
        Route::get('get_all','FieldController@all_fields')->name('api.field.all_fields');
        Route::put('update/{field}','FieldController@update')->name('api.field.update');
        Route::delete('delete/{field}','FieldController@destroy')->name('api.field.destroy');
    });
    Route::prefix('company')->group(function (){
        Route::post('store','CompanyController@store')->name('api.company.store');
        Route::get('all_companies','CompanyController@all_companies')->name('api.company.all_companies');
        Route::get('show/{company}','CompanyController@show')->name('api.company.show');
        Route::put('update/{company}','CompanyController@update')->name('api.company.update');
        Route::delete('delete/{company}','CompanyController@destroy')->name('api.company.destroy');
    });
    Route::prefix('requirement')->group(function (){
        Route::get('all_requirements','RequirementController@all_requirements')->name('api.requirement.all_requirements');
        Route::post('store','RequirementController@store')->name('api.requirement.store');
        Route::put('update/{requirement}','RequirementController@update')->name('api.requirement.update');
        Route::delete('delete/{requirement}','RequirementController@destroy')->name('api.requirement.destroy');
    });
    Route::prefix('skill')->group(function (){
        Route::get('all_skills','SkillController@all_skills')->name('api.skill.all_skills');
        Route::post('store','SkillController@store')->name('api.skill.store');
        Route::put('update/{skill}','SkillController@update')->name('api.skill.update');
        Route::delete('delete/{skill}','SkillController@destroy')->name('api.skill.destroy');
    });
    Route::prefix('testimonial')->group(function (){
        Route::delete('delete/{id}', 'TestimonialController@destroy')->name('api.testimonial.destroy');
    });
});
//Route::middleware('auth')->group(function (){
//});
Route::post('careers/mpesa/callback', 'JobsController@callback')->name('jobs.callback');
