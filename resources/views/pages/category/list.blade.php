@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Category List</h1>

      <form
      action="{{ route('category.bulkDelete') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Category Title</th>
                    <th>Category Description</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    
                    <td><input type="checkbox" name="categories_ids[]" value="{{ $category->id }}"></td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->status ? 'True' : 'False' }}</td>
                    <td>{{ $category->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <a onclick="globalSweetAlert('Are you sure?', 'You want to delete this category!', 'warning', ' {{route('category.destroy', $category->id) }}',true,true,'Yes,delete it')" class="btn btn-danger btn-sm text-white">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            <div class="d-flex justify-content-end mb-3 pr-3">
                <button type="submit" class="btn btn-danger btn-sm">Delete selected</button>
            </div>
        </form>

        <script>
            document.getElementById('select-all').onclick = function() {
                var checkboxes = document.querySelectorAll('input[name="product_ids[]"]');
                for (var checkbox of checkboxes) {
                    checkbox.checked = this.checked;
                }
            }
        </script>
@endsection
