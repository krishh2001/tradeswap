@extends('admin.layouts.admin')

@section('content')
    <div class="user-dashboard">
        <div class="search-create-row">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2" stroke="#888"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888" />
                </svg>
                <input type="text" id="billSearch" placeholder="Search" onkeyup="filterBills()">
            </div>
        </div>

        <div class="user-table-wrapper">
            <table class="user-table" id="billTable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Plan</th>
                        <th>Bill No</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Reward</th>
                        <th>View Bill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bills as $index => $bill)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $bill->plan }}</td>
                            <td>{{ $bill->bill_no }}</td>
                            <td>{{ $bill->user->name ?? 'N/A' }}</td>
                            <td>₹{{ number_format($bill->amount, 2) }}</td>
                            
                            <td>
                                @if ($bill->status === 'pending')
                                    <form action="{{ route('admin.bill_reward.approve', $bill->id) }}" method="POST"
                                        style="display: flex; flex-direction: column; gap: 6px;">
                                        @csrf
                                        <input type="number" name="reward" class="cashback-input" placeholder="₹ Reward"
                                            required style="width: 100%; padding: 6px;">

                                        <div style="display: flex; gap: 8px; justify-content: center;">
                                            <button type="submit" class="btn-approve">Approve</button>
                                    </form>

                                    <form action="{{ route('admin.bill_reward.discard', $bill->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-discard">Discard</button>
                                    </form>
        </div>
    @else
        ₹{{ number_format($bill->reward, 2) ?? '0.00' }} <br>
        <span class="status-{{ $bill->status }}">{{ ucfirst($bill->status) }}</span>
        @endif
        </td>

        <td>
            @if ($bill->bill_pdf)
                @php
                    $extension = pathinfo($bill->bill_pdf, PATHINFO_EXTENSION);
                    $fileUrl = url('public/' . $bill->bill_pdf); // Add 'public/' prefix manually
                @endphp

                <a href="{{ $fileUrl }}" target="_blank" class="btn-delete">View</a>
            @else
                N/A
            @endif
        </td>

        <td>
            <a href="{{ route('admin.bill_reward.view', $bill->id) }}" class="btn-view">View</a>
            <button class="btn-delete" onclick="openDeleteModal({{ $bill->id }})">Delete</button>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    </div>

    {{-- Delete Confirmation Modal --}}
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

    {{-- DataTables CSS/JS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    {{-- Custom JS --}}
    <script>
        $(document).ready(function() {
            $('#billTable').DataTable({
                paging: true,
                ordering: true,
                info: false,
                searching: false,
                lengthChange: false
            });
        });

        function openDeleteModal(id) {
            document.getElementById('deleteProductForm').action = "{{ url('admin/bill-reward') }}/" + id;
            document.getElementById('sliderDeleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').classList.remove('show');
        }

        function filterBills() {
            const input = document.getElementById("billSearch");
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll("#billTable tbody tr");

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(filter) ? '' : 'none';
            });
        }
    </script>
@endsection
