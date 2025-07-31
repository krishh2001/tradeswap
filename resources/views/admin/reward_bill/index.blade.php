@extends('admin.layouts.admin')

@section('content')
    <div class="user-dashboard">
        <div class="search-create-row">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2" stroke="#888"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888">
                    </line>
                </svg>
                <input type="text" id="searchInput" placeholder="Search by customer name or bill no">
            </div>
        </div>

        <div class="user-table-wrapper">
            <table class="user-table" id="cashbackTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bill No</th>
                        <th>Customer</th>
                        <th>Reward</th>
                        <th>View Bill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reward_bills as $bill)
                        <tr>
                            <td>{{ $bill->id }}</td>
                            <td>{{ $bill->bill_number }}</td>
                            <td>{{ $bill->user->name ?? 'N/A' }}</td>
                            <td>
                                @if ($bill->status === 'pending')
                                    <form action="{{ route('admin.reward_bill.approve', $bill->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        <input type="number" name="cashback" class="cashback-input"
                                            id="cashback_{{ $bill->id }}" placeholder="₹ Reward"
                                            class="form-control mb-2">
                                        <div class="cashback-buttons">
                                            <button class="btn-approve"
                                                onclick="approveCashback({{ $bill->id }})">Approve</button>
                                            <button class="btn-discard"
                                                onclick="discardCashback({{ $bill->id }})">Discard</button>
                                        </div>
                                    </form>
                                @else
                                    ₹{{ number_format($bill->cashback ?? 0, 2) }} <br>
                                    <span class="status-label status-{{ $bill->status }}">
                                        {{ ucfirst($bill->status) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if ($bill->file)
                                    @php
                                        $extension = pathinfo($bill->file, PATHINFO_EXTENSION);
                                        $fileUrl = url('public/storage/' . $bill->file); // Add 'public/' prefix manually
                                    @endphp

                                    <a href="{{ $fileUrl }}" target="_blank" class="btn-delete">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.reward_bill.view', $bill->id) }}" class="btn-view">View</a>
                                <button class="btn-delete" onclick="openDeleteModal({{ $bill->id }})">Delete</button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal" id="sliderDeleteModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete this bill?</p>
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
        function openDeleteModal(id) {
            document.getElementById('deleteProductForm').action = `{{ url('/admin/reward-bill/delete') }}/${id}`;
            document.getElementById('sliderDeleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').classList.remove('show');
        }

        function approveCashback(id) {
            let cashback = document.getElementById('cashback_' + id).value;
            if (cashback === '') return alert('Please enter cashback amount');

            fetch(`{{ url('/admin/bill-cashback/approve') }}/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cashback
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) location.reload();
                });
        }

        function discardCashback(id) {
            fetch(`{{ url('/admin/reward-bill/discard') }}/${id}`, {

                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) location.reload();
                });
        }

        // Manual Search Function
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#cashbackTable tbody tr');
            rows.forEach(row => {
                let billNo = row.children[1].textContent.toLowerCase();
                let customer = row.children[2].textContent.toLowerCase();
                row.style.display = billNo.includes(filter) || customer.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection
