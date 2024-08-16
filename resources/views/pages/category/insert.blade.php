@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Category Insert</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('category.create') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status </label>&nbsp&nbsp
            <input type="checkbox" id="status" name="status" value="1"  {{ old('status', isset($category) ? $category->status : true) ? 'checked' : '' }}>
            <span>{{ old('status', isset($category) ? ($category->status ? 'True' : 'False') : 'True') }}</span>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
@endsection
