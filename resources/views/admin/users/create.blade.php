@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="Name" required>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="HR">HR Manager</option>
            <option value="caregiver">Caregiver</option>
        </select>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
