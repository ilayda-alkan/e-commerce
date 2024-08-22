@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Product List</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('product.list') }}">
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category_id" class="form-control">
                    <option value="">All Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Bulk Delete Form -->
        <form action="{{ route('product.bulkDelete') }}" method="POST" id="bulk-delete-form">
            @csrf
            @method('DELETE')

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Title</th>
                        <th>CategoryName</th>
                        <th>Barcode</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><input type="checkbox" name="product_ids[]" value="{{ $product->id }}"></td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->category ? $product->category->title : 'Category Absent' }}</td>
                            <td>{{ $product->barcode }}</td>
                            <td>{{ $product->status ? 'True' : 'False' }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you want to delete this product?');" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end mb-3 pr-3">
                <button type="submit" class="btn btn-danger">Delete selected</button>
            </div>
        </form>

        <!-- Pagination links -->
        {{ $products->links() }}
    </div>

    <script>
        document.getElementById('select-all').onclick = function() {
            var checkboxes = document.querySelectorAll('input[name="product_ids[]"]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>
@endsection
