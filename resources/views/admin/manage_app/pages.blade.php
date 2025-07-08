@extends('admin.layouts.admin')

@section('content')

    <div class="page-editor-wrapper">
        <div class="editor-tabs">
            <button class="editor-tab active" onclick="switchEditorTab('privacy')">Privacy Policy</button>
            <button class="editor-tab" onclick="switchEditorTab('terms')">Terms & Conditions</button>
        </div>

        <form action="#" method="POST">
            @csrf

            <!-- Privacy Policy -->
            <div class="editor-section active" id="privacy-editor-section">
                <textarea id="privacy_editor" name="privacy_policy">
                    <h2>Privacy Policy</h2>
                    <p>Welcome to our privacy policy editor.</p>
                </textarea>
            </div>

            <!-- Terms & Conditions -->
            <div class="editor-section" id="terms-editor-section">
                <textarea id="terms_editor" name="terms_conditions">
                    <h2>Terms and Conditions</h2>
                    <p>Welcome to our terms & conditions editor.</p>
                </textarea>
            </div>

            <button type="submit" class="submit-btn">Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Tab switching
        function switchEditorTab(tab) {
            document.querySelectorAll('.editor-tab').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.editor-section').forEach(el => el.classList.remove('active'));

            document.querySelector(`[onclick="switchEditorTab('${tab}')"]`).classList.add('active');
            document.getElementById(`${tab}-editor-section`).classList.add('active');
        }

        // Initialize CKEditor with height and logo removed
        ClassicEditor
            .create(document.querySelector('#privacy_editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.minHeight = '300px';
            })
            .catch(error => console.error(error));

        ClassicEditor
            .create(document.querySelector('#terms_editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.minHeight = '300px';
            })
            .catch(error => console.error(error));
    </script>
@endsection
