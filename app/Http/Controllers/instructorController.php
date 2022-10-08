<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\instructor;
use App\category;

class instructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors=instructor::paginate(3);
        // return $instructors;
        return view('instructors/index')->with('instructors',$instructors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=category::get();
        return view('instructors/create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  return $request;
        $image= $request->file('file'); 
        $image->move(public_path('images'), $image->getClientOriginalName());
        $path =  'images/'.$image->getClientOriginalName();
        // return $path;

        $instructor = instructor::create([
            'name' => $request->name,
            'image' => $path,
            'department' => $request->department,
        ]);

        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(instructor $instructor)
    {
        // $instructor=instructor::find($id);
        return view('instructors/show')->with('instructor',$instructor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(instructor $instructor)
    {
        return view('instructors/edit')->with('instructor',$instructor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(instructor $instructor, Request $request)
    {
        // $image= $request->file('image'); 
        // $image->move(public_path('images'), $image->getClientOriginalName());
        // $path =  'images/'.$image->getClientOriginalName();

        // $request->image=$path;

        $instructor->update($request->all());
        return redirect("course");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(instructor $instructor)
    {
        $instructor->delete();
     
         return redirect()->route('instructor.index')
                         ->with('success','instructor deleted successfully');
 
     }
}
