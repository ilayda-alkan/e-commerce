@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Product Insert</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('product.create') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <label for="category">Category:</label>
            <select id="category" name="category_id" class="form-control">
                <option value="">Select</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>

        <div class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" name="barcode" id="barcode" class="form-control" value="{{ old('barcode') }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status </label>&nbsp&nbsp
            <input type="checkbox" id="status" name="status" value="1"  {{ old('status', isset($product) ? $product->status : true) ? 'checked' : '' }}>
            <span>{{ old('status', isset($product) ? ($product->status ? 'True' : 'False') : 'True') }}</span>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" required>
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
@endsection
