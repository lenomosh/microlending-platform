<?php

namespace App\Http\Controllers;

use GraphQL\Examples\Blog\Data\Image;
use Illuminate\Http\Request;
use App\Testimonial;
use Intervention\Image\Image as Img;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = Testimonial::all();
        $cleansed = [];
        foreach ($test as $static){
            $arr = (object)[
                'id'=>$static->id,
                'details'=>$static->details,
                'author_name'=>$static->author_name,
                'author_career'=>$static->author_career,
                'author_image'=> (string) str_replace('public',asset('storage'),$static->author_image)
            ];
            $cleansed[] = $arr;
        }
        return view('back.testimonials.create')->with('testimonials',$cleansed);
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
            'details'=>'required|max:500',
            'author_name'=>'required|max:30',
            'author_career'=>'required|max:30',
            'author_image'=>'image|required|mimes:png'
        ]);
        if ($data->fails()){
            return redirect()->back()->withErrors($data->errors())->withInput();
        }
        try{
            $data = (object) $data->validated();
            $img = $request->file('author_image')->store('public/testimonials');
            $data->author_image = $img;
            $test = new Testimonial((array)$data);
            $test->save();
            return redirect()->back()->with('success','Testimonial created successfully');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        try{
            $testimonial->delete();
            return redirect()->back()->with('success','Testimonial Deleted successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }
}
