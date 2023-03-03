@extends('admin.master')
@section('titel','Add Color')
@section('content')
<h1>Add new Color</h1>
    @include('admin.errors')
    <form action="{{ route('admin.colors.store') }}" method="POST" >
        @csrf

        <div class="mb-3">
            <label>Color</label>
            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
        </div>


        <button class="btn btn-success px-5">Add</button>
    </form>
@stop
