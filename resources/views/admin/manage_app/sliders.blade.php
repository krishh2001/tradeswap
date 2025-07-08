@extends('admin.layouts.admin')

@section('content')
    <div class="slider-wrapper">
        <div class="slider-header">
            <h2>Manage Sliders</h2>
            <button class="user-create-btn" onclick="openSliderModal('create')">+ Create</button>
        </div>

        <div class="slider-grid">
            <div class="slider-card">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/053/003/435/small_2x/glowing-red-succulent-plant-in-dark-nature-photo.jpg"
                    alt="Slider" />
                <div class="slider-card-body">
                    <div class="slider-card-actions">
                        <label class="slider-switch">
                            <input type="checkbox" checked>
                            <span class="slider-toggle"></span>
                        </label>

                        <div class="slider-button-group">
                            <button class="btn-edit" onclick="openSliderModal('edit')">Edit</button>
                            <button class="btn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="slider-card">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/053/003/435/small_2x/glowing-red-succulent-plant-in-dark-nature-photo.jpg"
                    alt="Slider" />
                <div class="slider-card-body">
                    <div class="slider-card-actions">
                        <label class="slider-switch">
                            <input type="checkbox" checked>
                            <span class="slider-toggle"></span>
                        </label>

                        <div class="slider-button-group">
                            <button class="btn-edit" onclick="openSliderModal('edit')">Edit</button>
                            <button class="btn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="slider-card">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/053/003/435/small_2x/glowing-red-succulent-plant-in-dark-nature-photo.jpg"
                    alt="Slider" />
                <div class="slider-card-body">
                    <div class="slider-card-actions">
                        <label class="slider-switch">
                            <input type="checkbox" checked>
                            <span class="slider-toggle"></span>
                        </label>

                        <div class="slider-button-group">
                            <button class="btn-edit" onclick="openSliderModal('edit')">Edit</button>
                            <button class="btn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="slider-card">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/053/003/435/small_2x/glowing-red-succulent-plant-in-dark-nature-photo.jpg"
                    alt="Slider" />
                <div class="slider-card-body">
                    <div class="slider-card-actions">
                        <label class="slider-switch">
                            <input type="checkbox" checked>
                            <span class="slider-toggle"></span>
                        </label>

                        <div class="slider-button-group">
                            <button class="btn-edit" onclick="openSliderModal('edit')">Edit</button>
                            <button class="btn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="slider-card">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/053/003/435/small_2x/glowing-red-succulent-plant-in-dark-nature-photo.jpg"
                    alt="Slider" />
                <div class="slider-card-body">
                    <div class="slider-card-actions">
                        <label class="slider-switch">
                            <input type="checkbox" checked>
                            <span class="slider-toggle"></span>
                        </label>

                        <div class="slider-button-group">
                            <button class="btn-edit" onclick="openSliderModal('edit')">Edit</button>
                            <button class="btn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="slider-card">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/053/003/435/small_2x/glowing-red-succulent-plant-in-dark-nature-photo.jpg"
                    alt="Slider" />
                <div class="slider-card-body">
                    <div class="slider-card-actions">
                        <label class="slider-switch">
                            <input type="checkbox" checked>
                            <span class="slider-toggle"></span>
                        </label>

                        <div class="slider-button-group">
                            <button class="btn-edit" onclick="openSliderModal('edit')">Edit</button>
                            <button class="btn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div class="slider-modal-overlay" id="sliderCreateModal">
        <div class="slider-modal">
            <div class="slider-modal-header">Create Slider</div>
            {{-- <input type="text" placeholder="Slider Title" /> --}}
            <input type="file" />
            <div class="slider-modal-actions">
                <button class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                <button class="slider-btn-primary">Save</button>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="slider-modal-overlay" id="sliderEditModal">
        <div class="slider-modal">
            <div class="slider-modal-header">Edit Slider</div>
            {{-- <input type="text" value="Existing Title" /> --}}
            <input type="file" />
            <div class="slider-modal-actions">
                <button class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                <button class="slider-btn-primary">Update</button>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="slider-modal-overlay" id="sliderDeleteModal">
        <div class="slider-modal">
            <div class="slider-modal-delete-header">Confirm Delete</div>
            <p style="text-align:center;">Are you sure you want to delete this slider?</p>
            <div class="slider-modal-actions centered">
                <button class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                <button class="slider-btn-danger">Yes, Delete</button>
            </div>
        </div>
    </div>
@endsection
