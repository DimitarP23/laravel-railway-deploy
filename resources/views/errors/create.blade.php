<!DOCTYPE html>
<html>
<head>
    <title>Create Stock Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create Stock Page</h1>

        <form action="{{ route('error-pages.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Stock Code</label>
                <input type="text" name="error_code" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('error-pages.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
