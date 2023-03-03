<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors=Color::all();
        return view('admin.color.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
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

        Color::create([
            'name'=> $request->name,
        ]);

        // Redirect
        return redirect()->route('admin.colors.index')->with('msg', 'Color added successfully')->with('type', 'success');
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
        $color=Color::find($id);
        return view('admin.color.edit',compact('color'));

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
        $color=Color::find($id);
        $request->validate([
            'name'=>'required',
        ]);

        $color->update([
            'name'=> $request->name,
        ]);

        // Redirect
        return redirect()->route('admin.colors.index')->with('msg', 'Color updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color=Color::find($id);
        $color->delete();

        // Redirect
        return redirect()->route('admin.colors.index')->with('msg', 'Color deleted successfully')->with('type', 'danger');

    }

    public function trach()
    {
        $colors=Color::onlyTrashed()->paginate(10);
        return view('admin.color.trach',compact('colors'));
    }

    public function restore($id)
    {
        Color::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.colors.index')->with('msg', 'Color restored successfully')->with('type', 'warning');

    }

    public function forcedelete($id)
    {
        Color::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.colors.index')->with('msg', 'Color deleted permanintly successfully')->with('type', 'danger');
    }
}

