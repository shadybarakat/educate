<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\course;
use App\category;
use App\instructor;
use App\categories_course;
use App\cart;
use App\user;
class coursesapicontroller extends Controller
{
    public function categories_store(Request $request){
        $categories=Category::create(['name'=>$request->name]);
       return response()->json(['message'=>'category added successfully','categories'=>$categories]);
    }

    public function categories_show($id){
        $categories=category::find($id);
        return response()->json(['categories',$categories]);
    }

    public function all_categories()
    {
        $categories=Category::get();
        return response()->json(['categories',$categories]);
    }

    public function category_update(Request $request)
    {
       $category= Category::where('id', $request->id)
      ->update(['name' => $request->name]);
         return response()->json(['category'=>$category,'message'=>'updated succesfully']);
    }

    public function category_destroy($id)
    {
       category::destroy($id);
    
       return response()->json(['message'=>'deleted succesfully']);


    }

    public function all_instructors()
    {
        $instructors=instructor::paginate(3);
        return response()->json(['instructors'=>$instructors]);
    }
    public function instructor_store(Request $request)
    {
        //  return $request;
        $image= $request->file('file'); 
        $image->move(public_path('images'), $image->getClientOriginalName());
        $path =  'images/'.$image->getClientOriginalName();


        $instructor = instructor::create([
            'name' => $request->name,
            'image' => $path,
            'department' => $request->department,
        ]);

        return response()->json(['message'=>'added successfully','instructor'=>$instructor]);
    }
    
    public function instructor_show($id){
        $instructor=instructor::find($id);
        return response()->json(['instructor',$instructor]);
    }
    
    public function instructor_destroy($id)
    {
       instructor::destroy($id);
    
       return response()->json(['message'=>'deleted succesfully']);
    }

    public function instructor_update(Request $request)
    {
        // return $user;
        $image= $request->file('image'); 
        $image->move(public_path('images'), $image->getClientOriginalName());
        $path =  'images/'.$image->getClientOriginalName();

        $instructor= instructor::where('id', $request->id)
        ->update(['name' => $request->name,'department'=>$request->department,'image'=>$path]);
           return response()->json(['instructor'=>$instructor,'message'=>'updated succesfully']);
    }

    public function course_store(Request $request)
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
            'Language'=>$request->language,
            'price'=>$request->price,
            'description'=>$request->description,
            'instructor_id'=>$user->id,
            'image'=>$path,
        ]);
          
        
        for ($i=0; $i <count($request->category_id) ; $i++) { 
            categories_course::create(['course_id'=>$course->id,"category_id"=>$request->category_id[$i]]);
         }

         return response()->json(['message'=>'added succesfully']);
           }

        public function course_show($id)
        {
            $course=course::find($id);
            return response()->json(['course'=>$course]);

        }
        public function all_courses()
        {
            $courses=course::with(['instructor'])->paginate(3);
            return response()->json(['courses'=>$courses]);
        }

        public function course_destroy($id)
        {
           course::destroy($id);
        
           return response()->json(['message'=>'deleted succesfully']);
        }

        public function course_update(Request $request)
        {
            $image= $request->file('image'); 
            $image->move(public_path('images'), $image->getClientOriginalName());
            $path =  'images/'.$image->getClientOriginalName();
            $course= course::where('id', $request->id)
            ->update([
                'name'=>$request->name,
                'Rating'=>$request->rating,
                'Lectures'=>$request->lectures,
                'Duration'=>$request->duration,
                'level'=>$request->level,
                'Language'=>$request->language,
                'price'=>$request->price,
                'description'=>$request->description,
                'image'=>$path,
            ]);

            for ($i=0; $i <count($request->category_id) ; $i++) { 
                categories_course::where('course_id', $request->id)
                ->update([
                    "category_id"=>$request->category_id[$i]]);
                }
               return response()->json(['course'=>$course,'message'=>'updated succesfully']);
        }

        public function front_index(){
            $courses=course::with(['instructor'])->get();
            $instructors=instructor::get();
            return response()->json(['courses'=>$courses,'instructors'=>$instructors]);
        }

        public function front_detail($id){
            $course=course::with(['instructor'])->find($id);
            $course->category=categories_course::select('category_id')->with(["category"])->where('course_id',$id)->get();
            return response()->json(['course'=>$course]);
        }

        public function front_feature($id){
            $courses=categories_course::select('course_id')->with(["course"])->where('category_id',$id)->get();
            // return $courses;
            return response()->json(['courses'=>$courses]);
        }

        public function front_instructor($id){
            $courses=course::with(['instructor'])->where('instructor_id',$id)->get();
            return response()->json(['courses'=>$courses]);
        }

        public function add_to_cart($id)
        {
           $user = auth()->user()->id;
           $cart=cart::create([
             'course_id'=>$id,
             'user_id'=>$user,
           ]);
        }

        public function destroy($id)
        {
            Cart::destroy($id);
            return back();
        }

        public function my_cart($id)
        { 

        $courses=cart::select()->with(["course"])->where('user_id',$id)->get();
      
        foreach ($courses as $course) {
            $course->instructor=user::select('name')->find($course->course->instructor_id);  
        }

        return response()->json(['courses'=>$courses]);
      }
}
