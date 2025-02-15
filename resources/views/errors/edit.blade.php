<!DOCTYPE html>
<html>
<head>
    <title>Edit Stock Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Stock Page</h1>

        <form action="{{ route('error-pages.update', $errorPage) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Stock Code</label>
                <input type="text" name="error_code" class="form-control" value="{{ $errorPage->error_code }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="title" class="form-control" value="{{ $errorPage->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required>{{ $errorPage->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('error-pages.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
