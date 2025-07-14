@extends('admin.layouts.admin')

@section('content')
    <div class="user-dashboard">
        <!-- Filters -->
        <form method="GET" action="{{ route('admin.supports.index') }}" class="filter-row">
            <div class="search-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"></line>
                </svg>
                <input type="text" name="search" placeholder="Search by User" value="{{ request('search') }}">
            </div>


            <select name="status">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
            </select>

            <button class="btn-small btn-search" type="submit">Search</button>
        </form>

        <!-- Tickets Table -->
        <div class="support-table-wrapper">
            <table class="support-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $index => $ticket)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ticket->user_name }}</td>
                            <td>{{ $ticket->user_email }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ Str::limit($ticket->message, 50) }}</td>
                            <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('admin.supports.toggleStatus', $ticket->id) }}" method="POST"
                                    style="display:inline-block">
                                    @csrf
                                    <button type="submit"
                                        class="btn-small 
    {{ $ticket->status == 'pending' ? 'btn-pending' : 'btn-resolved' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </button>
                                </form>
                                <button class="btn-small btn-reply"
                                    onclick="openReplyModal({{ $ticket->id }}, '{{ $ticket->user_email }}')">Reply</button>
                                <button class="btn-small btn-delete"
                                    onclick="openDeleteModal({{ $ticket->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;">No tickets found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $tickets->links() }}
        </div>
    </div>

    <!-- ✅ Delete Modal -->
    <div class="modal" id="sliderDeleteModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete this ticket?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="cancel" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="confirm">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ✅ Reply Modal -->
    <div class="modal" id="replyModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeReplyModal()">&times;</button>
            <h3>Reply</h3>
            <form id="replyForm" method="POST">
                @csrf
                <div class="form-group">
                    <label style="text-align: left;">Email</label>
                    <input type="email" id="replyEmail" readonly>
                </div>
                <div class="form-group">
                    <label style="text-align: left;">Reply Message</label>
                    <textarea name="reply" rows="4" placeholder="Write your reply..." required></textarea>
                </div>
                <button class="btn-small btn-reply" type="submit">Send Reply</button>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.support-table').DataTable({
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
            const form = document.getElementById('deleteForm');
            form.action = '/admin/supports/' + id;
            document.getElementById('sliderDeleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').style.display = 'none';
        }

        function openReplyModal(id, email) {
            const form = document.getElementById('replyForm');
            form.action = '/admin/supports/' + id + '/reply';
            document.getElementById('replyEmail').value = email;
            document.getElementById('replyModal').style.display = 'flex';
        }

        function closeReplyModal() {
            document.getElementById('replyModal').style.display = 'none';
        }
    </script>
@endsection
