@extends('admin.layouts.admin')

@section('content')
    <style>
        .user-table td:last-child {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            justify-content: center;
            min-width: 120px;
        }

        .btn-view,
        .btn-edit,
        .btn-delete {
            display: inline-block;
            width: 100px;
            height: 35px;
            text-align: center;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
    <div class="user-dashboard">
        <div class="search-create-row">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2" stroke="#888"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888" />
                </svg>
                <input type="text" id="productSearch" placeholder="Search products...">
            </div>
            <a href="{{ route('admin.product.create') }}" class="user-create-btn">+ Create</a>
        </div>


        <div class="user-table-wrapper">
            <table id="productTable" class="user-table display" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Actual Price (₹)</th>
                        <th>Current Price (₹)</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img style="height: 30px; width: 30px;"
                                    src="{{ asset('storage/' . $product->product_img) }}" alt="{{ $product->name }}"
                                    class="product-image">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>₹{{ number_format($product->actual_price, 2) }}</td>
                            <td>₹{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>
                                <form action="{{ route('admin.product.toggleStatus', $product) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="status-toggle-btn {{ $product->status == 'active' ? 'active' : 'inactive' }}">
                                        {{ ucfirst($product->status) }}
                                    </button>
                                </form>

                            </td>
                            <td>
                                <a href="{{ route('admin.product.show', $product->id) }}" class="btn-view">View</a>
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn-edit">Edit</a>
                                <button type="button" class="btn-delete" onclick="openDeleteModal({{ $product->id }})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal" id="sliderDeleteModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete this product?</p>
            <form id="deleteProductForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="cancel" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="confirm">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.user-table').DataTable({
                paging: true,
                ordering: true,
                info: false,
                searching: false,
                lengthChange: false
            });
        });
    </script>
    <script>
        function openDeleteModal(productId) {
            const form = document.getElementById('deleteProductForm');
            form.action = "{{ url('admin/product') }}/" + productId;
            document.getElementById('sliderDeleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').style.display = 'none';
        }

        // Simple search
        document.getElementById('productSearch').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#productTable tbody tr');

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchValue) ? '' : 'none';
            });
        });
    </script>
@endsection
