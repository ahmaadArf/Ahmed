@extends('admin.master')
@section('titel','Trach')
@section('content')

    <h1>All Trach</h1>
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
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.sliders.restore', $slider->id) }}"><i class="fas fa-undo"></i></a>
                        <form class="d-inline" action="{{ route('admin.sliders.forcedelete', $slider->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-times"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
