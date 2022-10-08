<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\instructor;
use App\category;
use App\course;
use App\categories_course;
use App\cart;
use App\user;

class frontcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
        $courses=course::with(['instructor'])->get();
        $instructors=instructor::get();
        return view('front/index')->with('courses',$courses)->with('instructors',$instructors);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $course=course::with(['instructor'])->find($id);
        $course->category_id=categories_course::select('category_id')->with(["category"])->where('course_id',$id)->get();
        return view('front/detail')->with('course',$course);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function feature($id)
    {
        $courses=categories_course::select('course_id')->with(["course"])->where('category_id',$id)->get();
        // return $courses;
        return view('front/feature')->with('courses',$courses);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function instructor($id)
    {
        $courses=course::with(['instructor'])->where('instructor_id',$id)->get();
        return view('front/instructor')->with('courses',$courses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cart($id)
    {
        if(Auth::check()){
            $user = auth()->user()->id;
            $courses_id=cart::select('course_id')->where('user_id',$user)->get();
            // return $courses_id;
            foreach ($courses_id as $value) {
                if ($value->course_id == $id) {
                    return 'already added' ;
                }
            }
    
           $user = auth()->user()->id;
           $cart=cart::create([
             'course_id'=>$id,
             'user_id'=>$user,
           ]);
        return redirect("front/my_cart");
          
        }else{
            return  redirect('login');

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function my_cart()
    {
        if(Auth::check()){
            $user = auth()->user()->id;
            $courses=cart::select()->with(["course"])->where('user_id',$user)->get();
          
            foreach ($courses as $course) {
                $course->instructor=user::select('name')->find($course->course->instructor_id);  
                // return $course;
            }
            //    return $courses;
            return view('front/my_cart')->with('courses',$courses);
          
        }else{
            return  redirect('login');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::destroy($id);
        return back();
        
    }
}
