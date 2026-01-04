@extends('layouts.app')

@section('content')
<div class="container px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    @if($errors->any())<div class="alert alert-danger">{{ implode(', ', $errors->all()) }}</div>@endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label form-label-custom">Name</label>
                    <input name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label form-label-custom">Brand</label>
                    <input name="brand" class="form-control" value="{{ old('brand', $product->brand) }}">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label form-label-custom">Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- none --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label form-label-custom">Price</label>
                    <input name="price" type="number" step="0.01" class="form-control" value="{{ old('price', $product->price) }}" required>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label form-label-custom">Stock</label>
                    <input name="stock" type="number" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label form-label-custom">Size</label>
                    <input name="size" class="form-control" value="{{ old('size', $product->size) }}">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label form-label-custom">Condition</label>
                    <select name="condition" class="form-control">
                        <option value="">-- Select Condition --</option>
                        <option value="baru" {{ old('condition', $product->condition) == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="bekas bagus" {{ old('condition', $product->condition) == 'bekas bagus' ? 'selected' : '' }}>Bekas Bagus</option>
                        <option value="bekas normal" {{ old('condition', $product->condition) == 'bekas normal' ? 'selected' : '' }}>Bekas Normal</option>
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label class="form-label form-label-custom">Product Image</label>
                    @if($product->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ddd;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Upload new image to replace current one (optional)</small>
                </div>
            </div>

            <div class="col-12">
                <div class="form-actions d-flex gap-2">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
