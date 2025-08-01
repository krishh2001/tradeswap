@extends('admin.layouts.admin')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <div class="user-dashboard">
        <div class="search-create-row">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2" stroke="#888"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888">
                    </line>
                </svg>
                <input type="text" id="orderSearch" placeholder="Search" />
            </div>
        </div>

        <div class="user-table-wrapper">
            <table id="ordersTable" class="user-table display">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Total Price</th>
                        <th>Address</th>
                        {{-- <th>Status</th> --}}
                        <th>Placed At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Guest' }}</td>
                            <td>{{ $order->product->name ?? 'N/A' }}</td>
                            <td>₹{{ number_format($order->total_price, 2) }}</td>
                            <td>{{ $order->address ?? 'N/A' }}</td>
                            {{-- <td>
                                <span class="badge {{ $order->status == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td> --}}
                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.view', $order->id) }}" class="btn-view">View</a>
                                <button class="btn-delete" onclick="openDeleteModal({{ $order->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Delete Modal -->
    <div class="modal" id="sliderDeleteModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete this order?</p>
            <form id="deleteSubscriptionForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="cancel" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="confirm">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        function openDeleteModal(orderId) {
            const form = document.getElementById('deleteSubscriptionForm');
            form.action = "{{ url('admin/orders') }}/" + orderId;
            document.getElementById('sliderDeleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').classList.remove('show');
        }

        $(document).ready(function() {
            const table = $('#ordersTable').DataTable({
                paging: true,
                ordering: true,
                lengthChange: false,
                dom: 'lrtip' // ✅ removes default search bar
            });

            $('#orderSearch').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection
