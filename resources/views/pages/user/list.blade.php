@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Users List</h1>
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

                        <a onclick="globalSweetAlert('Are you sure?', 'You want to delete this user!', 'warning', ' {{route('user.destroy', $user->id) }}' ,true,true,'Yes,delete it')" class="btn btn-danger btn-sm text-white">Delete</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
 
    <div class="d-flex justify-content-end mb-3 pr-3">
        <button type="submit" class="btn btn-danger btn-sm">Delete selected</button>
    </div>

</div>
</form>

<script>
    document.getElementById('select-all').onclick = function() {
        var checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
  
</script>
@endsection
