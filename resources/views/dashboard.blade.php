@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Admin Dashboard</h2>

        {{-- Kiểm tra nếu user có quyền admin thì hiển thị chức năng quản lý user --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>You do not have permission to access this page.</p>
        @endif
    </div>
@endsection
