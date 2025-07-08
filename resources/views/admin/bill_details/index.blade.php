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
                        <th>Bill No</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Cashback</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>#BILL001</td>
                        <td>John Doe</td>
                        <td>₹2,500</td>
                        <td>
                            <input type="number" class="cashback-input" placeholder="₹ Cashback">
                            <div class="cashback-buttons">
                                <button class="btn-approve">Approve</button>
                                <button class="btn-discard">Discard</button>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.bill_details.view') }}" class="btn-view">View</a>
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
            <p style="text-align:center;">Are you sure you want to delete this?</p>
            <div class="slider-modal-actions centered">
                <button class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                <button class="slider-btn-danger">Yes, Delete</button>
            </div>
        </div>
    </div>
@endsection
