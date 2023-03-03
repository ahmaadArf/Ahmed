<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes=Size::all();
        return view('admin.size.index',compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create');
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
        ]);

        Size::create([
            'name'=> $request->name,
        ]);

        // Redirect
        return redirect()->route('admin.sizes.index')->with('msg', 'Size added successfully')->with('type', 'success');
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
        $size=Size::find($id);
        return view('admin.size.edit',compact('size'));

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
        $size=Size::find($id);
        $request->validate([
            'name'=>'required',
        ]);

        $size->update([
            'name'=> $request->name,
        ]);

        // Redirect
        return redirect()->route('admin.sizes.index')->with('msg', 'Size updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size=Size::find($id);
        $size->delete();

        // Redirect
        return redirect()->route('admin.sizes.index')->with('msg', 'Size deleted successfully')->with('type', 'danger');

    }

    public function trach()
    {
        $sizes=Size::onlyTrashed()->paginate(10);
        return view('admin.size.trach',compact('sizes'));
    }

    public function restore($id)
    {
        Size::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.sizes.index')->with('msg', 'Size restored successfully')->with('type', 'warning');

    }

    public function forcedelete($id)
    {
        Size::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.sizes.index')->with('msg', 'Size deleted permanintly successfully')->with('type', 'danger');
    }
}

