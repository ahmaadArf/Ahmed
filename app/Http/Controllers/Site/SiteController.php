<?php

namespace App\Http\Controllers\Site;

use App\Models\Cart;
use App\Models\Size;
use App\Mail\Contact;
use App\Models\Color;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favourite;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function index()
    {
       $sliders= Slider::all();
       $categories= Category::all();
       $products= Product::all();
       $favorites= Favourite::pluck('id')->all();
        return view('site.index',compact('sliders','categories','products','favorites'));
    }

    public function about()
    {
        return view('site.about');
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function product()
    {
        $categories= Category::all();
        $products= Product::all();
        $favorites= Favourite::pluck('id')->all();
        return view('site.product',compact('categories','products','favorites'));
    }

    public function product_detail($id)
    {
        $product= Product::find($id);
        $products= Product::all();
        $favorites= Favourite::pluck('id')->all();
        return view('site.product_detail',compact('products','product','favorites'));
    }

    public function shoping_cart()
    {
        return view('site.shoping_cart');
    }

    public function add_to_cart(Request $request)
    {
        $request->validate([
            'product_id'=>'exists:products,id',
            'size'=>'required',
            'color'=>'required',
        ]);

        $product= Product::select('price')->where('id', $request->product_id)->first();
        $cart= Cart::where('user_id',1)->where('product_id',$request->product_id)->first();
        if($cart){
            $cart->update([
                'quantity'=>$cart->quantity+$request->quantity,
                'size'=>$request->size,
                'color'=>$request->color,
            ]);
        }else{
            Cart::create([
                'price'=> $product->price,
                'quantity'=>$request->quantity,
                'product_id'=>$request->product_id,
                'size'=>$request->size,
                'color'=>$request->color,
                'user_id'=>1,
            ]);
        }

        return redirect()->back();

    }

    public function add_review(Request $request)
    {
        $request->validate([
            'product_id'=>'exists:products,id',
        ]);

        Review::create([
            'review'=>$request->review,
            'name'=>$request->name,
            'email'=>$request->email,
            'product_id'=>$request->product_id,
            'user_id'=>1,
        ]);

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $products= Product::where('name','like','%'.$request->search.'%')->get();
        $search=$request->search;
        $categories= Category::all();
        return view('site.product',compact('products','search','categories'));
    }

    public function category_detail($id)
    {
        //
    }

    public function contact_data(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'msg'=>'required',
        ]);

        $data=$request->except('_token');
        Mail::to('h.7383039@gmail.com')->send(new Contact($data));
    }

    public function add_to_favorite(Request $request)
    {

        $request->validate([
            'product_id'=>'exists:products,id',
        ]);

        $favorites= Favourite::where('product_id',$request->product_id)->first();
        if($favorites){
            $favorites->delete();

        }else{
            Favourite::create([
                'product_id'=>$request->product_id,
            ]);
        }

        return redirect()->back();
    }
}
