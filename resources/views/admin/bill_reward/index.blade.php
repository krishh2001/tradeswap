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
                        <th>#</th>
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
                            <td>{{ $bill->bill_no }}</td>
                            <td>{{ $bill->user->name ?? 'N/A' }}</td>
                            <td>₹{{ number_format($bill->amount, 2) }}</td>
                            <td>
                                @if($bill->status === 'pending')
                                    <form action="{{ route('admin.bill_reward.approve', $bill->id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="reward" class="cashback-input" placeholder="₹ Reward" required>
                                        <div class="cashback-buttons">
                                            <button type="submit" class="btn-approve">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.bill_reward.discard', $bill->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-discard">Discard</button>
                                    </form>
                                @else
                                    ₹{{ $bill->reward ?? '0' }} 
                                    <br>
                                    <span class="status-{{ $bill->status }}">{{ ucfirst($bill->status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($bill->bill_pdf)
                                    <a href="{{ $bill->bill_pdf }}" target="_blank" class="btn-delete">View Bill</a>
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
        $(document).ready(function () {
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
            const form = document.getElementById('deleteProductForm');
            form.action = "{{ url('admin/bill-rewards') }}/" + id;
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
