<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $website = App::all()->first();
        $website->logo = str_replace('public/','',$website->logo);
        $website->favicon = str_replace('public/','',$website->favicon);
        return view('back.app.index')->with('website',$website);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param App $app
     * @return void
     */
    public function update(Request $request)
    {
        $app = App::find(1);
        $data = Validator::make($request->all(),[
            'name'=>'required',
            'location'=>'required',
            'description'=>'required',
            'logo'=>'mimes:png|sometimes|image',
            'favicon'=>'mimes:png|sometimes|image',
            'facebook'=>'url|required',
            'twitter'=>'url|required',
            'instagram'=>'url|required',
            'privacy'=>'required',
            'terms'=>'required',
            'email'=>'email|required',
            'phone'=>'required'
        ],[
            'terms.required'=>'Terms and conditions field is required',
            'privacy.required'=>'Terms of privacy is required'
        ]);
        if ($data->fails()){
            return redirect()->back()->withErrors($data->errors())->withInput();
        }
        try{
            $logo =  is_null($request->file('logo')) ? $logo =$app->logo : $logo =  $request->file('logo')->store('public');
            $favicon =  is_null($request->file('favicon')) ? $favicon =$app->favicon : $favicon =  $request->file('favicon')->store('public');
            $update = (object) $data->validated();
            $update->logo = $logo;
            $update->favicon = $favicon;
            $update = (array) $update;
            $app->update($update);
            $app->save();
            return redirect()->back()->with('success','Record updated successfully');
    }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput();
    }



    }

}
