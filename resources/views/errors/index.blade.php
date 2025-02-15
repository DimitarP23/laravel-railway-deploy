@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Stock Pages</span>
                    <a href="{{ route('error-pages.create') }}" class="btn btn-primary">Create New Stock</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

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
                            @foreach ($errorPages as $errorPage)
                                <tr>
                                    <td>{{ $errorPage->error_code }}</td>
                                    <td>{{ $errorPage->title }}</td>
                                    <td>{{ Str::limit($errorPage->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('error-pages.edit', $errorPage) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('error-pages.destroy', $errorPage) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
