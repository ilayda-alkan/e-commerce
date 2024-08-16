@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Category List</h1>

      <!-- Toplu silme formu -->
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
                        
                        <!-- Silme Formu -->
                        <form action="{{ route('category.destroy', $category->id) }}" method="GET" style="display:inline;" 
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
  
            <!-- Toplu silme butonu -->
            <div class="d-flex justify-content-end mb-3 pr-3">
                <button type="submit" class="btn btn-danger">Delete selected</button>
            </div>
        </form>

{{-- @section('scripts')
<script>
document.getElementById('select-all').addEventListener('click', function() {
    const isChecked = this.checked;
    document.querySelectorAll('input[name="category_ids[]"]').forEach(checkbox => {
        checkbox.checked = isChecked;
    });
});
</script>
@endsection --}}
@endsection
