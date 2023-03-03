@extends('admin.master')
@section('titel','Add Size')
@section('content')
<h1>Add new Size</h1>
    @include('admin.errors')
    <form action="{{ route('admin.sizes.store') }}" method="POST" >
        @csrf

        <div class="mb-3">
            <label>Size</label>
            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
        </div>


        <button class="btn btn-success px-5">Add</button>
    </form>
@stop
