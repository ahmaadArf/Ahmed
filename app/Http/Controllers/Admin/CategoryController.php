<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'titel'=>'required',
            'image'=>'required',
        ]);

        $img_name=time().rand(). $request->image->getClientOriginalName();
        $request->image->move(public_path('image/category'), $img_name);

        Category::create([
            'name'=>$request->name,
            'titel'=>$request->titel,
            'image'=> $img_name,
        ]);

        // Redirect
        return redirect()->route('admin.categories.index')->with('msg', 'Category added successfully')->with('type', 'success');
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
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));

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
        $category=Category::find($id);
        $request->validate([
            'name'=>'required',
            'titel'=>'required',

        ]);
        $image_name=$category->image;
        if( $request->image){
            $image_name=time().rand(). $request->image->getClientOriginalName();
            $request->image->move(public_path('image/category'), $image_name);
        }

        $category->update([
            'name'=>$request->name,
            'titel'=>$request->titel,
            'image'=> $image_name,
        ]);

        // Redirect
        return redirect()->route('admin.categories.index')->with('msg', 'Category updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        File::delete(public_path('image/category/'). $category->image);
        // Redirect
        return redirect()->route('admin.categories.index')->with('msg', 'Category deleted successfully')->with('type', 'danger');

    }

    public function trach()
    {
        $categories=Category::onlyTrashed()->paginate(10);
        return view('admin.category.trach',compact('categories'));
    }

    public function restore($id)
    {
        Category::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.categories.index')->with('msg', 'Category restored successfully')->with('type', 'warning');

    }

    public function forcedelete($id)
    {
        Category::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.categories.index')->with('msg', 'Category deleted permanintly successfully')->with('type', 'danger');
    }
}
