<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\course;
use App\categories_course;
class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses=course::with(['instructor'])->paginate(3);
        // return $courses;
        return view('courses/index')->with('courses',$courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=category::get();
        return view('courses/create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $user = auth()->user();
        // return $user;
        $image= $request->file('image'); 
        $image->move(public_path('images'), $image->getClientOriginalName());
        $path =  'images/'.$image->getClientOriginalName();

        $course=course::create([
            'name'=>$request->name,

            'Rating'=>$request->rating,
            'Lectures'=>$request->lectures,
            'Duration'=>$request->duration,
            'level'=>$request->level,
            'Language'=>$request->lang,
            'price'=>$request->price,
            'description'=>$request->description,
            'instructor_id'=>$user->id,
            'image'=>$path,
        ]);
          
        for ($i=0; $i <count($request->category_id) ; $i++) { 
            categories_course::create(['course_id'=>$course->id,"category_id"=>$request->category_id[$i]]);
         }

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(course $course)
    {
        return view('courses/show')->with('course',$course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(course $course)
    {
        return view("courses/edit")->with('course',$course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, course $course)
    {
        $course->update($request->all());
        return redirect("course");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(course $course)
    {
        $course->delete();
    
        return redirect()->route('course.index')
                        ->with('success','course deleted successfully');
    }
}
