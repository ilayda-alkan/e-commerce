@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Users List</h1>

    <!-- Toplu Silme Formu -->
    <form 
        action="{{ route('user.bulkDelete') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')
      
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><input type="checkbox" name="user_ids[]" value="{{ $user->id }}"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Silme Formu -->
                        <form action="{{ route('user.destroy', $user->id) }}" method="GET" style="display:inline;" 
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
 
    <div class="d-flex justify-content-end mb-3 pr-3">
        <button type="submit" class="btn btn-danger">Delete selected</button>
    </div>
</form>


{{-- @section('scripts')
<script>
document.getElementById('select-all').addEventListener('click', function() {
    const isChecked = this.checked;
    document.querySelectorAll('input[name="user_ids[]"]').forEach(checkbox => {
        checkbox.checked = isChecked;
    });
});
</script>
@endsection --}}
@endsection
