@extends('admin.master')
@section('titel','Edit Size')
@section('content')
<h1>Edit new Size</h1>

    @include('admin.errors')
    <form action="{{ route('admin.sizes.update',$size->id) }}" method="POST" >
        @csrf
        @method('put')

        <div class="mb-3">
            <label>Size</label>
            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $size->name }}">
        </div>

        <button class="btn btn-success px-5">Update</button>
    </form>
@stop
