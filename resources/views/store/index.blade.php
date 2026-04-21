@extends('layouts.app')
@section('title', 'products')
@section('sidebar')
    <h1>Filtres</h1>
    <form method="get">
        <div class="form-group">
            <label for="name">Name or Description</label>
            <input type="text" name="name" id='name' value="{{request('name')}}" class="form-control" placehloder="name">
        </div>

        <h3>Categorires</h3>

        @php
            $categoriesId = request('categories', []);
            $categoriesSelect = request('categoriesii', []);
        @endphp
        @foreach($categories as $category)
            <div class="form-check">
                <input @checked(in_array($category->id, $categoriesId)) id="{{ $category->id }}" type="checkbox"
                    name="categories[]" value="{{ $category->id }}" class="form-check-input">
                <label for="{{ $category->id }}">{{ $category->name}}</label>
            </div>
        @endforeach

        <select name="categoriesii[]" class="form-select" aria-label="Default select example">

            <option selected>Open this select menu</option>
            @foreach($categories as $category)
                <option @selected(in_array($category->id, $categoriesSelect)) id="{{ $category->id }}"
                    value="{{ $category->id}}">{{ $category->name}}</option>
            @endforeach
        </select>



        <h3>Pricing</h3>
        <div class="form-group">
            <label for="min">Min</label>
            <input min="" max="" type="number" name="min" id="min" value="" class="form-control" placeholder="Min price">
            <label for="max">Max</label>
            <input min="" max="" type="number" name="max" id="max" value="" class="form-control" placeholder="Max price">
        </div>

        <div class="form-group my-2">
            <input type="submit" class="btn btn-primary" value="Filter">
            <a type="reset" class="btn btn-secondary" href="{{ route('home_page') }}">Reset</a>
        </div>
    </form>
@endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h1>last Products </h1>
    </div>

    <div class="row row-col-1 row-cols-md-3 g-4">
        @foreach ($products as $product)

            <div class="col">
                <div class="card h-100">

                    <img class="card-img-top" width='100px' src="storage/{{ $product->image }}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{!! $product->description !!}</p>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Quantity: <span class="badge bg-primary">{{ $product->quantity }}</span></span>
                            <span> Price: <span class="badge bg-success">{{ $product->price }} $</span></span>
                        </div>
                        <span> Category: <span class="badge bg-success">{{ $product->category?->name }} </span></span>


                    </div>
                    <div class="card-footer">
                        <small class="text-muted"> {{$product->created_at  }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


@endsection