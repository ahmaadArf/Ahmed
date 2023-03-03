@extends('admin.master')
@section('titel','Edit Slider')
@section('content')
<h1>Edit new Slider</h1>

    @include('admin.errors')
    <form action="{{ route('admin.sliders.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control" value="{{$slider->name }}">
        </div>

        <div class="mb-3">
            <label>Titel</label>
            <input type="text" name="titel" placeholder="Titel" class="form-control" value="{{$slider->titel }}">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" >
            <img src="{{ asset('image/slider/'.$slider->image)}}" width="80"  alt="">
        </div>

        <button class="btn btn-success px-5">Update</button>
    </form>
@stop
