<?php

namespace App\Http\Controllers;

use App\Field;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.field.index');
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
        $store = new Field();
        $store->field_name= $request->name;
        $store->save();
        return response()->json("Field created successfully",200);

        } catch (\Exception $exception){
            return response()->json($exception->getCode(),500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
        try{
            $cleansed = [
                'name'=>$field->field_name
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
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field)
    {
        $data = Validator::make($request->all(),[
            'name'=>'required|max:35'
        ]);
        if ($data->fails()){
            return response()->json($data->errors(),500);
        }
        try{
            $name = $field->field_name;
            $field->field_name = $request->name;
            $field->save();
            return response()->json('Success, field name changed from '.$name.' to '.$field->field_name,200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        try{
            $name = $field->field_name;
            $field->delete();
            return response()->json("Success, the <b>'$name'</b> field has been deleted successfully",200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }
    }
    public function all_fields(){
        try{
            $fields = Field::with('companies')->get();
            $arr = array();
            foreach ($fields as $field){
                $cleansed =[
                    'field_name'=>$field->field_name,
                    'id'=>$field->field_id,
                    'companies'=>$field->companies()->count()
                ];
                array_push($arr,$cleansed);
            }
            return \response()->json($arr,200);
        }catch (\Exception $exception){
            return response()->json('Error code: '.$exception->getCode().' Message:'.$exception->getMessage(),404);
        }

    }
}
