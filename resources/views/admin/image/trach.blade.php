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
                <th>Path</th>
                <th>Product</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($images as $image)
                <td>{{ $images->id }}</td>
                <td><img src="{{ asset('image/path/'.$image->path)}}" width="80"  alt=""></td>
                <td>{{ $image->product->name }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.images.restore', $image->id) }}"><i class="fas fa-undo"></i></a>
                        <form class="d-inline" action="{{ route('admin.images.forcedelete', $image->id) }}" method="POST">
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
