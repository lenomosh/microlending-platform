<?php

namespace App\Http\Controllers;

use App\Company;
use App\Job;
use App\Requirement;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Scalar\String_;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $req = Requirement::all();
        $skill = Skill::all();
        $jobs = Job::all();
        $arr = array();
        foreach ($jobs as $job){
            $c = array(
                'id'=>$job->job_id,
                'title'=>(string)$job->title,
                'location'=>(string) $job->location,
                'applicants'=>count($job->applications()->get())
            );
            $arr[] = $c;
        }
        return view('back.job.index')->with(
            [
                'jobs'=>json_encode($arr)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $req = Requirement::all();
        $skill = Skill::all();
        $company = Company::all();
        /*session()->put([
           'requirements'=>$req,
           'skills'=>$skill,
           'companies'=>$company
        ]);*/
        return view('back.job.create')->with(
            [
                'requirements'=>$req,
                'skills'=>$skill,
                'companies'=>$company
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
           'title'=>'required|max:100|min:10',
           'description'=>'required',
           'location'=>'required|string|max:100',
           'skill_id'=>'somietimes',
            'company_id'=>'integer|required|max:10',
            'slots'=>'required|integer|min:1',
            'responsibility'=>'required',
            'requirement_id'=>'required',
            'employment_period'=>'required|integer',
            'other_information'=>'sometimes|max:1000',
            'salary'=>'required|min:100|max:500000|integer',
            'deadline'=>'date|required'
        ]);
        if ($data->fails()){
            return redirect()->back()->withErrors($data->errors())->withInput();
        }
        try{
            $data = (object)$request->input();
            $data->skill_id = $this->Convert($data->skill_id,1);
            $data->requirement_id = $this->Convert($data->requirement_id,1);
            $data =(array)$data;
            $store = new Job($data);
            $store->save();
            return redirect()->back()->with('success','Job created successfully');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $req = Requirement::all();
        $skill = Skill::all();
        $company = Company::all();
        $job->skill_id = $this->Convert($job->skill_id);
        $job->requirement_id = $this->Convert($job->requirement_id);
        return view('back.job.edit')->with(
            [
                'requirements'=>$req,
                'skills'=>$skill,
                'companies'=>$company,
                'job'=>$job
            ]
        );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        
        $data = Validator::make($request->all(),[
            'title'=>'required|max:100|min:20',
            'description'=>'required',
            'location'=>'required|string|max:100',
            'skill_id'=>'sometimes',
            'company_id'=>'integer|required|max:10',
            'slots'=>'required|integer|min:1',
            'responsibility'=>'required',
            'requirement_id'=>'required',
            'employment_period'=>'required|integer',
            'other_information'=>'sometimes|max:1000',
            'salary'=>'required|min:100|max:500000|integer'
        ]);
        if ($data->fails()){
            return redirect()->back()->withErrors($data->errors())->withInput();
        }
        try{
            $data = (object)$request->input();
            $data->skill_id = $this->Convert($data->skill_id,1);
            $data->requirement_id = $this->Convert($data->requirement_id,1);
            $data =(array)$data;
            $job->update($data);
            $job->save();
            return redirect(route('job.index'))->with('success','Record updated successfully');

        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        try{
            $job->delete();
            return redirect(route('job.index'))->with('success','Job deleted successfully');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput();
        }
    }
}
