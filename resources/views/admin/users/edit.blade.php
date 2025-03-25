@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        <select name="role" class="form-control">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="HR" {{ $user->role == 'HR' ? 'selected' : '' }}>HR Manager</option>
            <option value="caregiver" {{ $user->role == 'caregiver' ? 'selected' : '' }}>Caregiver</option>
        </select>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
