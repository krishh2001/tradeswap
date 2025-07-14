@extends('admin.layouts.admin')

@section('content')
    <div class="user-dashboard">
        <h2 class="page-title">Reports Overview</h2>

        {{-- Report Table --}}
        <div class="user-table-wrapper">
            <table id="reportsTable" class="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Report Name</th>
                        <th>Date</th>
                        <th>Total Entries</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->report_name }}</td>
                            <td>{{ $report->report_date }}</td>
                            <td>{{ $report->total_entries }}</td>
                            <td>
                                @if ($report->status === 'completed')
                                    <span class="badge badge-success">Completed</span>
                                @else
                                    <span class="badge badge-info">In Progress</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn-delete"
                                    onclick="openDeleteModal({{ $report->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No reports found</td>
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
            <p>Are you sure you want to delete this report?</p>
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

    {{-- Include DataTables via CDN --}}
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

        // Modal logic
        function openDeleteModal(id) {
            const form = document.getElementById('deleteForm');
            form.action = '/admin/reports/' + id;
            document.getElementById('sliderDeleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').style.display = 'none';
        }
    </script>
@endsection
