@extends('admin.layouts.admin')

@section('content')

    <div class="user-dashboard">
        <h2 class="page-title">Reports Overview</h2>

        {{-- Filters Section --}}
        <div class="report-filters">
            <form action="#" method="GET">
                <div class="filter-row">
                    <div class="form-group">
                        <label for="report-type">Report Type</label>
                        <select id="report-type" name="report_type">
                            <option value="wallet">Wallet</option>
                            <option value="bill">Bills</option>
                            <option value="orders">Orders</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date-from">From Date</label>
                        <input type="date" id="date-from" name="from_date">
                    </div>

                    <div class="form-group">
                        <label for="date-to">To Date</label>
                        <input type="date" id="date-to" name="to_date">
                    </div>

                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn-filter">Generate</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Report Table --}}
        <div class="user-table-wrapper">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Report Name</th>
                        <th>Date</th>
                        <th>Total Entries</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Wallet Transactions</td>
                        <td>2025-06-18</td>
                        <td>45</td>
                        <td><span class="badge badge-success">Completed</span></td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bill Summary</td>
                        <td>2025-06-17</td>
                        <td>20</td>
                        <td><span class="badge badge-info">In Progress</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
