@extends('admin.master')
@section('titel','Slides')
@section('content')

    <h1>All Sliders</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Titel</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($sliders as $slider)
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->name }}</td>
                    <td>{{ $slider->titel }}</td>
                    <td><img src="{{ asset('image/slider/'.$slider->image)}}" width="80"  alt=""></td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.sliders.edit', $slider->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
