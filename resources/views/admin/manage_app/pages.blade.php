@extends('admin.layouts.admin')

@section('content')
    <style>
        body {
            background-color: #f9f9f9;
        }

        .page-wrapper {
            max-width: 1200px;
            margin: auto;
            padding: 40px 20px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .card-box {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
            transition: 0.3s ease;
        }

        .card-box:hover {
            transform: translateY(-2px);
        }

        .gradient-btn {
            background: linear-gradient(to right, #0045dd, #082062);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            width: 100%;
        }

        .gradient-btn:hover {
            background: linear-gradient(to right, #0045dd, #082f9b);
            transform: scale(1.02);
        }

        label {
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
            color: #444;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>

    <div class="page-wrapper">
        <h2 class="section-title">📝 Manage Pages</h2>

        @if (session('success'))
            <div class="alert alert-success text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Privacy Policy -->
        <div class="card-box">
            <form action="{{ route('admin.manage_app.pages.update') }}" method="POST">
                @csrf
                <input type="hidden" name="page_type" value="privacy_policy">
                <div class="form-group">
                    <label>Privacy Policy</label>
                    <textarea name="content" id="privacy-editor">{{ old('content', $privacyPolicy->content ?? '') }}</textarea>
                </div>
                <button type="submit" class="gradient-btn">Save Privacy Policy</button>
            </form>
        </div>

        <!-- Terms & Conditions -->
        <div class="card-box">
            <form action="{{ route('admin.manage_app.pages.update') }}" method="POST">
                @csrf
                <input type="hidden" name="page_type" value="terms_conditions">
                <div class="form-group">
                    <label>Terms & Conditions</label>
                    <textarea name="content" id="terms-editor">{{ old('content', $termsConditions->content ?? '') }}</textarea>
                </div>
                <button type="submit" class="gradient-btn">Save Terms & Conditions</button>
            </form>
        </div>
    </div>
    {{-- Load CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#privacy-editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                    'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#terms-editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                    'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
