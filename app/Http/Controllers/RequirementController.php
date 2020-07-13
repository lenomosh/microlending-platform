<?php

namespace App\Http\Controllers;

use App\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.requirement.index');
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
            $store = new Requirement();
            $store->name= $request->name;
            $store->save();
            return response()->json("Requirement created successfully",200);
        } catch (\Exception $exception){
            return response()->json($exception->getCode(),500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        try{
            $cleansed = [
                'name'=>$requirement->name
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
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requirement $requirement)
    {
        $data = Validator::make($request->all(),[
            'name'=>'required|max:35'
        ]);
        if ($data->fails()){
            return response()->json($data->errors(),500);
        }
        try{
            $name = $requirement->name;
            $requirement->name = $request->name;
            $requirement->save();
            return response()->json('Success, field name changed from '.$name.' to '.$requirement->name,200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement)
    {
        try{
            $name = $requirement->name;
            $requirement->delete();
            return response()->json("Success, the <b>'$name'</b> requirement has been deleted successfully",200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }
    }
    public function all_requirements(){
        try{
            $requirements = Requirement::all();
            $arr = array();
            foreach ($requirements as $static){
                $cleansed =[
                    'name'=>$static->name,
                    'id'=>$static->requirement_id,
                ];
                array_push($arr,$cleansed);
            }
            return \response()->json($arr,200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }

    }
}
