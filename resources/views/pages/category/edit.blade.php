@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Category</h1>

    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $category->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $category->description) }}" required>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status </label>&nbsp
            <input type="checkbox" id="status" name="status" value="1"  {{ old('status', isset($category) ? $category->status : true) ? 'checked' : '' }}>
            {{-- <span>{{ old('status', isset($category) ? ($category->status ? 'True' : 'False') : 'True') }}</span> --}}
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button onclick="globalSweetAlert(
            'Success!', 
            'Category has been updated successfully.', 
            'success',null,false,false,'Great!')" class="btn btn-primary btn-sm">Update Category</button>
         <a href="{{ route('category.list') }}" class="btn btn-secondary btn-sm">Cancel</a>
    </form>
</div>
@endsection





