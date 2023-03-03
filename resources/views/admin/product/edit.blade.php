@extends('admin.master')
@section('titel','Edit Product')
@section('content')
<h1>Edit new Product</h1>

    @include('admin.errors')
    <form action="{{ route('admin.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')


        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" placeholder="Price" class="form-control" value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea class="myedit" placeholder="Description" name="description">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" >
            <img src="{{ asset('image/product/'.$product->image)}}" width="80"  alt="">
        </div>

        <div class="mb-3">
            <label>Colors</label>
            <table class="table">
                @foreach ($colors as $color)
                    <tr>
                        <td width="20"><input type="checkbox" name="color[]"  value="{{ $color->id  }}" {{in_array($color->id, $colors_product) ?'checked':'' }}></td>
                        <td>{{ $color->name}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="mb-3">
            <label>Sizes</label>
            <table class="table">
                @foreach ($sizes as $size)
                    <tr>
                        <td width="20"><input type="checkbox" name="size[]"  value="{{ $size->id  }}" {{in_array($size->id, $sizes_product) ?'checked':'' }}></td>
                        <td>{{ $size->name}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                @foreach ($categories as $category)
                 <option value="{{ $category->id }}" {{ $category->id==$product->category_id? 'selected':'' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success px-5">Update</button>
    </form>
@stop
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js" integrity="sha512-tofxIFo8lTkPN/ggZgV89daDZkgh1DunsMYBq41usfs3HbxMRVHWFAjSi/MXrT+Vw5XElng9vAfMmOWdLg0YbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
tinymce.init({
    selector: '.myedit'
})
</script>
@stop
