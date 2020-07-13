<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.skill.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name'=>'required|max:35'
        ]);
        if ($data->fails()){
            return response()->json($data->errors()->messages(),500);
        }
        try{
            $store = new Skill();
            $store->name= $request->name;
            $store->save();
            return response()->json("Skill created successfully",200);
        } catch (\Exception $exception){
            return response()->json($exception->getCode(),500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        try{
            $cleansed = [
                'name'=>$skill->name
            ];
            return response()->json($cleansed,200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $data = Validator::make($request->all(),[
            'name'=>'required|max:35'
        ]);
        if ($data->fails()){
            return response()->json($data->errors(),500);
        }
        try{
            $name = $skill->name;
            $skill->name = $request->name;
            $skill->save();
            return response()->json('Success, field name changed from '.$name.' to '.$skill->name,200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        try{
            $name = $skill->name;
            $skill->delete();
            return response()->json("Success, the <b>'$name'</b> skill has been deleted successfully",200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }
    }
    public function all_skills(){
        try{
            $skills = Skill::all();
            $arr = array();
            foreach ($skills as $static){
                $cleansed =[
                    'name'=>$static->name,
                    'id'=>$static->skill_id,
                ];
                array_push($arr,$cleansed);
            }
            return \response()->json($arr,200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }

    }
}
