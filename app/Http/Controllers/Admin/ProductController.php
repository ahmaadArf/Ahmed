<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::with('category')->get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::select('id','name')->get();
        $sizes=Size::all();
        $colors=Color::all();
        return view('admin.product.create',compact('categories','sizes','colors'));
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
            'price'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'color'=>'required',
            'size'=>'required',
            'image'=>'required',
        ]);

        $img_name=time().rand(). $request->image->getClientOriginalName();
        $request->image->move(public_path('image/product'), $img_name);

       $product= Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'image'=> $img_name,
        ]);
        $product->sizes()->sync($request->size);
        $product->colors()->sync($request->color);
        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product added successfully')->with('type', 'success');
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
        $product=Product::find($id);
        $categories=Category::select('id','name')->get();
        $sizes=Size::all();
        $colors=Color::all();
        $colors_product=  $product->colors->pluck('id')->all();
        $sizes_product=  $product->sizes->pluck('id')->all();
        return view('admin.product.edit',compact('product','categories','sizes','colors','colors_product','sizes_product'));

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
        $product=Product::find($id);
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'color'=>'required',
            'size'=>'required',
        ]);
        $image_name=$product->image;
        if( $request->image){
            $image_name=time().rand(). $request->image->getClientOriginalName();
            $request->image->move(public_path('image/product'), $image_name);
        }

        $product->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'image'=>  $image_name,
        ]);
        $product->sizes()->sync($request->size);
        $product->colors()->sync($request->color);

        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        File::delete(public_path('image/product/'). $product->image);
        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product deleted successfully')->with('type', 'danger');

    }

    public function trach()
    {
        $products=Product::onlyTrashed()->paginate(10);
        return view('admin.product.trach',compact('products'));
    }

    public function restore($id)
    {
        Product::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.products.index')->with('msg', 'Product restored successfully')->with('type', 'warning');

    }

    public function forcedelete($id)
    {
        Product::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.products.index')->with('msg', 'Product deleted permanintly successfully')->with('type', 'danger');
    }
}
