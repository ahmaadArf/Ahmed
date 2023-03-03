@extends('admin.master')
@section('titel','Edit Color')
@section('content')
<h1>Edit new Color</h1>

    @include('admin.errors')
    <form action="{{ route('admin.colors.update',$color->id) }}" method="POST" >
        @csrf
        @method('put')

        <div class="mb-3">
            <label>Color</label>
            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $color->name }}">
        </div>

        <button class="btn btn-success px-5">Update</button>
    </form>
@stop
