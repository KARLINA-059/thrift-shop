@extends('layouts.app')

@section('content')
<div class="container px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Create Category</h1>

    @if($errors->any())<div class="alert alert-danger">{{ implode(', ', $errors->all()) }}</div>@endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label class="form-label form-label-custom">Name</label>
                    <input name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label class="form-label form-label-custom">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="form-actions d-flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
