@extends('admin.layouts.admin')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <div class="user-dashboard">
        <div class="search-create-row">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2" stroke="#888"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888"/>
                </svg>
                <input type="text" id="userSearch" placeholder="Search users...">
            </div>
            <a href="{{ route('admin.users.create') }}" class="user-create-btn">+ Create</a>
        </div>

        <div class="user-table-wrapper">
            <table id="userTable" class="user-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Date of Joining</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile_number }}</td>
                        <td>{{ $user->date_of_joining ? $user->date_of_joining->format('d M Y') : 'N/A' }}</td>
                        <td>
                            <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="status-toggle-btn {{ $user->status == 'active' ? 'active' : 'inactive' }}">
                                    {{ ucfirst($user->status) }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.view', $user->id) }}" class="btn-view">View</a>
                            <button type="button" class="btn-delete" onclick="openDeleteModal({{ $user->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;">No users found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="sliderDeleteModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete this user?</p>
            <form id="deleteUserForm" method="POST" action="">
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
        function openDeleteModal(userId) {
            const form = document.getElementById('deleteUserForm');
            form.action = "{{ url('admin/users') }}/" + userId;
            document.getElementById('sliderDeleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').style.display = 'none';
        }

        document.getElementById('userSearch').addEventListener('keyup', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userTable tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });

        $(document).ready(function () {
            $('#userTable').DataTable({
                paging: true,
                ordering: true,
                searching: false,
                lengthChange: false,
                info: false,
                pageLength: 10
            });
        });
    </script>
@endsection
