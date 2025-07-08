@extends('admin.layouts.admin')

@section('content')
  
    <div class="admin-popup-wrapper">
        <div class="admin-popup-title">Edit Popup Content</div>

        <form>
            <div class="popup-form-group">
                <label for="slider-title">Slider Title</label>
                <input type="text" id="slider-title" placeholder="Enter slider title">
            </div>
            <div class="popup-form-group">
                <label for="slider-content">Slider Content</label>
                <input type="text" id="slider-content" placeholder="Enter slider content">
            </div>



            <div class="popup-form-actions">
                <button type="submit" class="popup-btn popup-btn-save">Save</button>
            </div>
        </form>
    </div>
@endsection
