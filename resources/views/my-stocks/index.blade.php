@extends('layouts.app')

@section('title', 'My Stock Portfolio')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>My Stock Portfolio</span>
                    <a href="{{ route('my-stocks.create') }}" class="btn btn-primary">Add New Stock</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($stocks->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Stock Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $stock)
                            <tr>
                                <td>{{ $stock->error_code }}</td>
                                <td>{{ $stock->title }}</td>
                                <td>{{ Str::limit($stock->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('my-stocks.show', $stock) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('my-stocks.edit', $stock) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('my-stocks.destroy', $stock) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-info">
                        <h5><i class="bi bi-info-circle"></i> No stocks in your portfolio yet!</h5>
                        <p>Start building your portfolio by adding your first stock.</p>
                        <a href="{{ route('my-stocks.create') }}" class="btn btn-primary">Add Your First Stock</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
