@extends('users.admin.app')

@section('title', ($isUpdate ? 'Update' : 'Create') . ' product')



@php
    $route = route('products.store');
    if ($isUpdate) {
        $route = route('products.update', $products);
    }
@endphp
@section('content')
    <h1>@yield('title') </h1>
    <form action="{{ $route }}" method="post" enctype="multipart/form-data">
        @csrf
        @if($isUpdate){
            @method('PUT');
            }
        @endif

        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $products->name) }}">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="description"
                class="form-control">{{ old('description', $products->description) }} </textarea>
        </div>
        <div class="form-group">
            <label for="">Quantity</label>
            <input type="text" name="quantity" id="quantity" class="form-control"
                value="{{ old('quantity', $products->quantity) }}">
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
            @if ($products->image)
                <img width='100px' src="/storage/{{$products->image }}" alt="">
            @endif
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="number" step='0.5' name="price" id="price" class="form-control"
                value="{{ old('price', $products->price) }}">
        </div>


        <div class="form-group">
            <label id="category_id" for="">Category</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">Please choose your category</option>
                @foreach ($categories as $category)
                    <option @selected(old('category_id', $products->category_id === $category->id)) value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group my-3">
            <input type="submit" value="{{ $isUpdate ? 'Edit' : 'Add' }}" class="btn btn-primary w-100">
        </div>
    </form>
@endsection