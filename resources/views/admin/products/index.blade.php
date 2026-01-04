@extends('layouts.app')

@section('content')
<div class="container px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-4">Create Product</a>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($p->image)
                        <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" style="width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd;">
                    @else
                        <div style="width: 60px; height: 60px; background: #f8f9fa; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    @endif
                </td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category?->name }}</td>
                <td>{{ number_format($p->price,2) }}</td>
                <td>{{ $p->stock }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete?');">
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
