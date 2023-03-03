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
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Size</th>
                <th>Color</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($products as $product)
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{!! $product->description !!}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    @foreach ($product->sizes as $size)
                       <span>{{ $size->name  }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach ($product->colors as $color)
                       <span>{{ $color->name  }}</span>
                    @endforeach
                </td>
                <td><img src="{{ asset('image/product/'.$product->image)}}" width="80"  alt=""></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.products.restore', $product->id) }}"><i class="fas fa-undo"></i></a>
                        <form class="d-inline" action="{{ route('admin.products.forcedelete', $product->id) }}" method="POST">
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
