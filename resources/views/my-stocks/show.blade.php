@extends('layouts.app')

@section('title', 'Stock Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Stock Details</span>
                    <div>
                        <a href="{{ route('my-stocks.edit', $myStock) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('my-stocks.index') }}" class="btn btn-secondary btn-sm">Back to Portfolio</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Stock Code</h5>
                            <p class="text-muted">{{ $myStock->error_code }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Stock Name</h5>
                            <p class="text-muted">{{ $myStock->title }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Description</h5>
                            <p class="text-muted">{{ $myStock->description }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <small class="text-muted">Added: {{ $myStock->created_at->format('M d, Y H:i') }}</small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Last Updated: {{ $myStock->updated_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>

                    <div class="mt-4">
                        <form action="{{ route('my-stocks.destroy', $myStock) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this stock from your portfolio?')">
                                <i class="bi bi-trash"></i> Remove from Portfolio
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
