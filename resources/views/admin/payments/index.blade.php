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
                <input type="text" placeholder="Search">
            </div>
        </div>

        <div class="user-table-wrapper">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Plan</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Premium Plan</td>
                        <td>$199</td>
                        <td>Credit Card</td>
                        <td>2025-01-10</td>
                        <td><span class="badge badge-success">Success</span></td>
                        <td>
                            <a href="{{ route('admin.payments.view', 1) }}" class="btn-view">View</a>
                            <button class="btn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </td>
                    </tr>
                   

                </tbody>
            </table>
        </div>
    </div>

     {{-- Delete Modal --}}
    <div class="slider-modal-overlay" id="sliderDeleteModal">
        <div class="slider-modal">
            <div class="slider-modal-delete-header">Confirm Delete</div>
            <p style="text-align:center;">Are you sure you want to delete this ?</p>
            <div class="slider-modal-actions centered">
                <button class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                <button class="slider-btn-danger">Yes, Delete</button>
            </div>
        </div>
    </div>
@endsection
