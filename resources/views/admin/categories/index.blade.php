@extends('layouts.app')

@section('content')
<div class="container px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-4">Create Category</a>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->description }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
