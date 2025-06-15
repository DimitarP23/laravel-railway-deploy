@extends('layouts.app')

@section('title', 'Edit Stock')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Stock in Portfolio</div>

                <div class="card-body">
                    <form action="{{ route('my-stocks.update', $stock) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="error_code" class="form-label">Stock Code</label>
                            <input type="number" name="error_code" id="error_code" class="form-control @error('error_code') is-invalid @enderror" value="{{ old('error_code', $stock->error_code) }}" required>
                            @error('error_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Enter a unique stock identifier number</div>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Stock Name</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $stock->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $stock->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Update details about this stock investment</div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Stock</button>
                            <a href="{{ route('my-stocks.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
