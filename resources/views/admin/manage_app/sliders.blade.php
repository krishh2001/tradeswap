@extends('admin.layouts.admin')

@section('content')
    <div class="slider-wrapper">
        <div class="slider-header">
            <h2>Manage Sliders</h2>
            <button class="slider-btn-create-new" onclick="openSliderModal('create')">+ Create</button>
        </div>

        <div class="slider-grid">
            @foreach ($sliders as $slider)
                <div class="slider-card">
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" />
                    <div class="slider-card-body">
                        <div class="slider-card-actions">
                            <label class="slider-switch">
                                <input type="checkbox" {{ $slider->status ? 'checked' : '' }}
                                    onchange="toggleStatus({{ $slider->id }})">
                                <span class="slider-toggle"></span>
                            </label>
                            <div class="slider-button-group">
                                <button class="btn-edit"
                                    onclick="openSliderModal('edit', {{ $slider->id }}, '{{ asset('storage/' . $slider->image) }}')">
                                    Edit
                                </button>
                                <button class="btn-delete" onclick="openDeleteModal({{ $slider->id }})">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Create Modal --}}
    <div class="slider-popup-overlay" id="sliderCreateModal">
        <div class="slider-popup-box">
            <div class="slider-popup-header">Create Slider</div>
            <form action="{{ route('admin.manage_app.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" accept="image/*" onchange="previewCreateImage(event)" required />
                <img id="createImagePreview" style="display: none; margin-top: 10px; width: 100%;" />
                <div class="slider-popup-actions">
                    <button type="button" class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                    <button type="submit" class="slider-btn-submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="slider-popup-overlay" id="sliderEditModal">
        <div class="slider-popup-box">
            <div class="slider-popup-header">Edit Slider</div>
            <form id="sliderEditForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <img id="editImagePreview" src="" alt="Preview" style="width: 100%; margin-bottom: 10px;" />
                <input type="file" name="image" />
                <div class="slider-popup-actions">
                    <button type="button" class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                    <button type="submit" class="slider-btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal" id="sliderDeleteModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete this slider?</p>
            <form id="deleteSliderForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="cancel" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="confirm">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        function openSliderModal(type, id = null, image = null) {
            closeSliderModals();
            if (type === 'create') {
                document.getElementById('createImagePreview').style.display = 'none';
                document.getElementById('sliderCreateModal').classList.add('show');
            } else if (type === 'edit') {
                document.getElementById('sliderEditModal').classList.add('show');
                document.getElementById('sliderEditForm').action = `/admin/manage_app/sliders/${id}`;
                document.getElementById('editImagePreview').src = image;
            }
        }

        function closeSliderModals() {
            document.querySelectorAll('.slider-popup-overlay').forEach(modal => {
                modal.classList.remove('show');
            });
        }

        document.querySelectorAll('.slider-popup-overlay').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeSliderModals();
            });
        });

        function openDeleteModal(id) {
            document.getElementById('deleteSliderForm').action = `{{ url('admin/manage_app/sliders') }}/${id}`;
            document.getElementById('sliderDeleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('sliderDeleteModal').classList.remove('show');
        }

        function toggleStatus(id) {
            fetch(`/admin/manage_app/sliders/${id}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                .then(data => console.log('Status Updated:', data));
        }

        function previewCreateImage(event) {
            const preview = document.getElementById('createImagePreview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        }
    </script>
@endsection
