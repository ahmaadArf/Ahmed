<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images=ProductImage::with('product')->get();
        return view('admin.image.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products= Product::all();
        return view('admin.image.create',compact('products'));
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
            'path'=>'required',
            'product_id'=>'required',
        ]);

        $path_name=time().rand(). $request->path->getClientOriginalName();
        $request->path->move(public_path('image/path'),$path_name);

        ProductImage::create([
            'product_id'=>$request->product_id,
            'path'=> $path_name,
        ]);

        // Redirect
        return redirect()->route('admin.images.index')->with('msg', 'ProductImage added successfully')->with('type', 'success');
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
        $image=ProductImage::find($id);
        $products= Product::all();
        return view('admin.image.edit',compact('image','products'));

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
        $image=ProductImage::find($id);
        $request->validate([
            'product_id'=>'required',
        ]);

        $path_name=$image->path;
        if( $request->path){
            $path_name=time().rand(). $request->path->getClientOriginalName();
            $request->path->move(public_path('image/path'), $path_name);
        }

        $image->update([
            'product_id'=>$request->product_id,
            'path'=> $path_name,
        ]);

        // Redirect
        return redirect()->route('admin.images.index')->with('msg', 'ProductImage updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image=ProductImage::find($id);
        $image->delete();
        File::delete(public_path('image/path/'). $image->path);
        // Redirect
        return redirect()->route('admin.images.index')->with('msg', 'ProductImage deleted successfully')->with('type', 'danger');

    }

    public function trach()
    {
        $images=ProductImage::onlyTrashed()->paginate(10);
        return view('admin.image.trach',compact('images'));
    }

    public function restore($id)
    {
        ProductImage::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.images.index')->with('msg', 'ProductImage restored successfully')->with('type', 'warning');

    }

    public function forcedelete($id)
    {
        ProductImage::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.images.index')->with('msg', 'ProductImage deleted permanintly successfully')->with('type', 'danger');
    }
}

