<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreSliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderRequest $request)
    {
        //Form Request Validation

        // $request->validate([
        //     'name'=>'required',
        //     'titel'=>'required',
        //     'image'=>'required',
        // ]);

        $img_name=time().rand(). $request->image->getClientOriginalName();
        $request->image->move(public_path('image/slider'), $img_name);

        Slider::create([
            'name'=>$request->name,
            'titel'=>$request->titel,
            'image'=> $img_name,
        ]);

        // Redirect
        return redirect()->route('admin.sliders.index')->with('msg', 'Slider added successfully')->with('type', 'success');
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
        $slider=Slider::find($id);
        return view('admin.slider.edit',compact('slider'));

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
        $slider=Slider::find($id);
        $request->validate([
            'name'=>'required',
            'titel'=>'required',
        ]);
        $image_name=$slider->image;
        if( $request->image){
            $image_name=time().rand(). $request->image->getClientOriginalName();
            $request->image->move(public_path('image/slider'), $image_name);
        }

        $slider->update([
            'name'=>$request->name,
            'titel'=>$request->titel,
            'image'=> $image_name,
        ]);

        // Redirect
        return redirect()->route('admin.sliders.index')->with('msg', 'Slider updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider=Slider::find($id);
        $slider->delete();
        File::delete(public_path('image/slider/'). $slider->image);
        // Redirect
        return redirect()->route('admin.sliders.index')->with('msg', 'Slider deleted successfully')->with('type', 'danger');

    }

    public function trach()
    {
        $sliders=Slider::onlyTrashed()->paginate(10);
        return view('admin.slider.trach',compact('sliders'));
    }

    public function restore($id)
    {
        Slider::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.sliders.index')->with('msg', 'Slider restored successfully')->with('type', 'warning');

    }

    public function forcedelete($id)
    {
        Slider::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.sliders.index')->with('msg', 'Slider deleted permanintly successfully')->with('type', 'danger');
    }
}

