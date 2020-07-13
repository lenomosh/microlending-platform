<?php

namespace App\Http\Controllers;

use App\Company;
use App\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = Field::all();
        $c = Company::with('fields')->get();
        $company = array();
        foreach ($c as $item){
            $arr = [
                'id'=>$item->company_id,
                'name'=>$item->name,
                'email'=>$item->email,
                'phone'=>$item->phone_number,
                'location'=>$item->location,
                'field_id'=>$item->field_id,
                'logo'=> $item->logo === null ? null:asset('storage/').str_replace('public/','/',$item->logo)
            ];
            $company[] = (object)$arr;
        }
        return view('back.company.index')->with([
            'fields'=>json_encode($fields,TRUE),
            'companies'=>$company
        ]);
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
           'name'=>'required|max:50|Min:3|string',
           'description'=>'required|min:50|max:250',
           'email'=>'email|required',
           'phone_number'=>'required|min:10|max:13',
           'location'=>'required|string|max:100|min:5',
           'field_id'=> 'required|integer',
            'logo'=>'image|required|mimes:png'
        ]);
        if ($data->fails()){
            return redirect()->back()->withErrors($data->errors())->withInput();
        }

        try{
            $logo = $request->file('logo')->store('public');
            $store = (object) $data->validated();
            $store->logo = $logo;
            $store = (array) $store;
            $company = new Company($store);
            $company->save();
            return redirect()->back()->with('success','Company created successfully');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $field = new Company();
        $id = $company->field_id;
        $field = $field->fieldDetails($id);
        $sorted = array(
            'id'=>$company->company_id,
            'cname'=>$company->name,
            'description'=>$company->description,
            'email'=>$company->email,
            'location'=>$company->location,
            'phone'=>$company->phone_number,
            'field'=>$field->field_name,
            'logo'=>is_null($company->logo)? null : asset('storage/').str_replace('public/','/',$company->logo)
        );
        return response($sorted,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $data = Validator::make($request->all(),[
            'name'=>'required|max:50|Min:3|string',
            'description'=>'required|min:50|max:250',
            'email'=>'email|required',
            'phone_number'=>'required|min:10|max:13',
            'location'=>'required|string|max:100|min:5',
            'field_id'=> 'required|integer',
            'logo'=>'image|required|mimes:png'
        ]);
        if ($data->fails()){
            return response()->json('Error: '.$data->errors(),500);
        }
        try{
            $logo =  $request->file('logo') === null ? $logo = $company->logo : $logo =  $request->file('logo')->store('public');
            $store = (object) $data->validated();
            $store->logo = $logo;
            $store = (array) $store;
            $company->update($store);
            return response()->json("<b>success</b>,Record Updated Successfully",200);
        }catch (\Exception $exception){
            return response()->json('Error: '.$exception->getMessage(),500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try{
            $company->delete();
            return response()->json('<b>success</b>, Record deleted successfully',200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }
    public function all_companies(){
        $c = Company::with('fields')->get();
        $company = array();
        foreach ($c as $item){
            $arr = [
                'id'=>$item->company_id,
              'name'=>$item->name,
              'email'=>$item->email,
              'phone'=>$item->phone_number,
              'location'=>$item->location,
                'field_id'=>$item->field_id,
                'logo'=> $item->logo === null ? null:asset('storage/').str_replace('public/','/',$item->logo)
            ];
            $company[] = $arr;
        }
        return response()->json($company,200);
    }
}
