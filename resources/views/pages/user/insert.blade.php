@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>User Insert</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.create') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password </label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" onclick="globalSweetAlert(
            'Success!', 
            'User has been inserted successfully.', 
            'success',null,false,false,'OK' )" class="btn btn-primary btn-sm">Add</button>

    </form>
</div>
@endsection
