<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {

            $categories=  Category::paginate(3);
            return view('categories/index')->with('categories',$categories);
    
        } else {
    
            dd('You are not Admin');
    
        }


    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {

            return view ("categories/create");
    
        } else {
    
            dd('You are not Admin');
    
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        if (Gate::allows('isAdmin')) {

            Category::create(['name'=>$request->name]);
            return redirect("category");    
        } else {
    
            dd('You are not Admin');
    
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (Gate::allows('isAdmin')) {

            return view("categories/show")->with('category',$category);

        } else {
    
            dd('You are not Admin');
    
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Gate::allows('isAdmin')) {

            return view("categories/edit")->with('category',$category);

              
        } else {
    
            dd('You are not Admin');
    
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // return $request->all();
         $category->update($request->all());
          return redirect("category");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
       $category->delete();
    
        return redirect()->route('category.index')
                        ->with('success','Category deleted successfully');

    }
}