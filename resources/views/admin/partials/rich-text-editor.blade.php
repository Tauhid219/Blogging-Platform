@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        .note-editor.note-frame {
            border: 1px solid #ced4da;
        }
        .note-editor.note-frame .note-editing-area .note-editable {
            min-height: 22rem;
            padding: 1rem 1.25rem;
        }
        .dark-mode .note-editor.note-frame {
            background-color: #343a40;
            border-color: #56606a;
        }
        .dark-mode .note-editor.note-frame .note-toolbar,
        .dark-mode .note-editor.note-frame .note-statusbar {
            background-color: #3f474e;
            border-color: #56606a;
        }
        .dark-mode .note-editor.note-frame .note-editing-area .note-editable {
            background-color: #2b3035;
            color: #f8f9fa;
        }
        .dark-mode .note-editor.note-frame .note-editing-area .note-editable a {
            color: #dee2e6;
        }
        .dark-mode .note-editor.note-frame .note-toolbar .note-btn,
        .dark-mode .note-editor.note-frame .note-toolbar .note-color .dropdown-toggle,
        .dark-mode .note-editor.note-frame .note-toolbar .note-para .dropdown-toggle {
            background-color: #495057;
            border-color: #5c6670;
            color: #f8f9fa;
        }
        .dark-mode .note-editor.note-frame .note-toolbar .note-btn:hover,
        .dark-mode .note-editor.note-frame .note-toolbar .note-btn:focus {
            background-color: #5c6670;
            color: #fff;
        }
        .dark-mode .note-editor.note-frame .dropdown-menu {
            background-color: #3f474e;
            border-color: #56606a;
        }
        .dark-mode .note-editor.note-frame .dropdown-item {
            color: rgba(255, 255, 255, .88);
        }
        .dark-mode .note-editor.note-frame .dropdown-item:hover,
        .dark-mode .note-editor.note-frame .dropdown-item:focus {
            background-color: rgba(255, 255, 255, .08);
            color: #fff;
        }
        .dark-mode .note-modal-content {
            background-color: #343a40;
            border-color: #56606a;
            color: #f8f9fa;
        }
        .dark-mode .note-modal-content .modal-header,
        .dark-mode .note-modal-content .modal-footer {
            border-color: #56606a;
        }
        .dark-mode .note-modal-content .close {
            color: #f8f9fa;
            text-shadow: none;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        (function () {
            var editors = Array.prototype.slice.call(document.querySelectorAll('.rich-text-editor'));

            if (!editors.length || typeof window.jQuery === 'undefined') {
                return;
            }

            var $ = window.jQuery;
            var uploadUrl = @json(route('admin.media.editor-upload'));
            var csrfToken = @json(csrf_token());

            function insertEditorImage(file, editor) {
                var formData = new window.FormData();
                formData.append('_token', csrfToken);
                formData.append('image', file);

                $.ajax({
                    url: uploadUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (!response || !response.url) {
                            return;
                        }

                        $(editor).summernote('insertImage', response.url, function ($image) {
                            if (response.alt_text) {
                                $image.attr('alt', response.alt_text);
                            }
                        });
                    },
                    error: function () {
                        window.alert('Image upload failed. Please try again.');
                    }
                });
            }

            editors.forEach(function (editor) {
                $(editor).summernote({
                    height: 380,
                    placeholder: 'Write polished content here...',
                    dialogsInBody: true,
                    disableDragAndDrop: false,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'table', 'hr']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    callbacks: {
                        onImageUpload: function (files) {
                            Array.prototype.forEach.call(files, function (file) {
                                insertEditorImage(file, editor);
                            });
                        }
                    }
                });
            });
        }());
    </script>
@endpush
