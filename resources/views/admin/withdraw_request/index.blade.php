@extends('admin.layouts.admin')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffb300, #835200);
            color: #fff;
            padding: 7px 10px;
            border-radius: 4px;
        }

        .badge-info {
            background: linear-gradient(135deg, #018d3d, #00501e);
            color: #fff;
            padding: 7px 10px;
            border-radius: 6px;
        }

      
    </style>

    <div class="user-dashboard">
        <div class="search-create-row">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"></line>
                </svg>
                <input type="text" id="requestSearch" placeholder="Search withdraw requests...">
            </div>
        </div>

        <div class="support-table-wrapper">
            <table class="support-table" id="withdrawTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($withdrawRequests as $index => $request)
                        @if (in_array($request->status, ['pending', 'approved']))
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $request->user->name ?? 'N/A' }}</td>
                                <td>₹{{ $request->amount }}</td>
                                <td>{{ $request->method }}</td>
                                <td>{{ $request->created_at->format('d M Y') }}</td>
                                <td>
                                    <button
                                        class="status-toggle-btn badge {{ $request->status === 'pending' ? 'badge-warning' : 'badge-info' }}"
                                        data-id="{{ $request->id }}" data-status="{{ $request->status }}">
                                        {{ ucfirst($request->status) }}
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('admin.withdraw_request.view', $request->id) }}"
                                        class="btn-small btn-view">View</a>
                                    <button class="btn-small btn-delete"
                                        onclick="openDeleteModal({{ $request->id }})">Delete</button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal" id="sliderDeleteModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete this withdraw request?</p>
            <form id="deleteRequestForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="cancel" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="confirm">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let withdrawTable;

        $(document).ready(function() {
            withdrawTable = $('#withdrawTable').DataTable({
                paging: true,
                info: true,
                searching: true,
                lengthChange: false,
                order: [],
                columnDefs: [{
                    orderable: false,
                    targets: [5, 6]
                }],
                dom: 'lrtip'
            });

            $('#requestSearch').on('keyup', function() {
                withdrawTable.search(this.value).draw();
            });

            $(document).on('click', '.status-toggle-btn', function() {
                const button = $(this);
                const id = button.data('id');
                const current = button.data('status');

                const next = current === 'pending' ? 'approved' : null;

                if (!next) return;

                fetch(`{{ url('admin/withdraw_request') }}/${id}/toggle-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            status: next
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            button.text('Approved')
                                .removeClass('badge-warning')
                                .addClass('badge-info')
                                .data('status', 'approved');
                        } else {
                            alert('Status update failed.');
                        }
                    })
                    .catch(() => alert('Request failed.'));
            });
        });

        function openDeleteModal(id) {
            const form = document.getElementById('deleteRequestForm');
            form.action = `{{ route('admin.withdraw_request.destroy', ':id') }}`.replace(':id', id);
            document.getElementById('sliderDeleteModal').classList.add('show');
        }


        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').classList.remove('show');
        }
    </script>
@endsection
