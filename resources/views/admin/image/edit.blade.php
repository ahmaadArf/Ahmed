@extends('admin.master')
@section('titel','Edit ProductImage')
@section('content')
<h1>Edit new ProductImage</h1>

    @include('admin.errors')
    <form action="{{ route('admin.images.update',$image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>Path</label>
            <input type="file" name="path" class="form-control" >
            <img src="{{ asset('image/path/'.$image->path)}}" width="80"  alt="">
        </div>

        <div class="mb-3">
            <label>Product</label>
            <select name="product_id" class="form-control">
                <option value=""></option>
                @foreach ($products as $product)
                 <option value="{{ $product->id }}" {{ $product->id==$image->product_id? 'selected':'' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>



        <button class="btn btn-success px-5">Update</button>
    </form>
@stop
