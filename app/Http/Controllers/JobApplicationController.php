<?php

namespace App\Http\Controllers;

use App\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app = JobApplication::all();
        $cleansed = [];
        foreach ($app as $item){
            $arr = [
                'first_name'=>$item->applicant()->first('first_name')->first_name,
                'last_name'=>$item->applicant()->first('last_name')->last_name,
                'gender'=>$item->applicant()->first('gender')->gender,
                'phone_number'=>$item->applicant()->first('phone')->phone,
                'job_title'=>$item->job()->first('title')->title,
                'paid'=> $item->payment()->first('paid')['paid'],
                'transaction_attempts'=>count($item->transactions()->get())
            ];
            $cleansed[] = (object)$arr;
        }
        return view('back.applications.index')->with('applications',$cleansed);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function show(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobApplication $jobApplication)
    {
        //
    }
}
