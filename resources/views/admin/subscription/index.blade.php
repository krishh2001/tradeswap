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
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888">
                    </line>
                </svg>
                <input type="text" id="searchInput" placeholder="Search plans...">
            </div>
            <a href="{{ route('admin.subscription.create') }}" class="user-create-btn">+ Create</a>
        </div>

        <div class="user-table-wrapper">
            <table class="user-table" id="subscriptionTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Plan Name</th>
                        <th>Actual Price</th>
                        <th>Current Price</th>
                        <th>Validity</th>
                        <th>Reward Limit</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $index => $subscription)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subscription->plan_name }}</td>
                            <td>₹{{ number_format($subscription->actual_price, 2) }}</td>
                            <td>₹{{ number_format($subscription->price, 2) }}</td>
                            <td>{{ $subscription->validity_days }} days</td>
                            <td>₹{{ $subscription->reward_limit }}</td>
                            <td>{{ Str::limit($subscription->description, 50) }}</td>
                            <td>
                                <a href="{{ route('admin.subscription.view', $subscription->id) }}"
                                    class="btn-view">View</a>
                                <a href="{{ route('admin.subscription.edit', $subscription->id) }}"
                                    class="btn-edit">Edit</a>
                                <button class="btn-delete"
                                    onclick="openDeleteModal({{ $subscription->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">No subscription plans found.</td>
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
            <p>Are you sure you want to delete this subscription plan?</p>
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

    <!-- ✅ Scripts -->
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
        function openDeleteModal(subscriptionId) {
            const form = document.getElementById('deleteSubscriptionForm');
            form.action = "{{ url('admin/subscription') }}/" + subscriptionId;
            document.getElementById('sliderDeleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').style.display = 'none';
        }

        // 🔍 Filter table rows
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#subscriptionTable tbody tr');

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchValue) ? '' : 'none';
            });
        });
    </script>
@endsection
