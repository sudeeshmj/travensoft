@extends('layouts.master')
@section('admincontent')
    <div class="container-fluid p-4">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div id="response_message"></div>
                <div class="card">
                    <div class="card-header">


                        <h5 class="card-title text-center">Edit Weekly Update Form</h5>

                    </div>
                    <div class="card-body">
                        <div class="container">

                            <form action="{{ route('weekly-update.update', $weeklyUpdate->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-4">
                                    <label for="content">Update Content</label>
                                    <div id="quill-editor" class="mb-3" style="height: 250px;">
                                    </div>
                                    <textarea rows="3" class="mb-3 d-none" name="content" id="quill-editor-area">{{ old('content', $weeklyUpdate->content) }}</textarea>

                                    {{-- <textarea id="content" name="content" class="form-control" rows="7" placeholder="Enter your weekly update...">{{ old('content', $weeklyUpdate->content) }}</textarea> --}}
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="file">Upload File</label>
                                    <input type="file" id="file" name="file" class="form-control-file"
                                        accept=".jpeg,.png,.jpg,.gif,.svg,.pdf,.doc,.docx">
                                    @if ($weeklyUpdate->file)
                                        <a href="{{ asset(config('app.file_paths.WEEKLY_UPDATES') . '/' . $weeklyUpdate->file) }}"
                                            download class="float-end">{{ $weeklyUpdate->file }}</a>
                                    @endif
                                    <input type="hidden" name="old_file" value="{{ $weeklyUpdate->file }}">
                                    <br>
                                    <small class="text-muted">Accept: jpeg, png, jpg, gif, svg, pdf, doc, docx | Max:
                                        5MB</small>
                                    <br>
                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <a href="{{ route('weekly-update.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm float-end">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <script>
            toastr.success("{{ session()->get('success') }}")
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}")
        </script>
    @endif
    <!-- Initialize Quill editor -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var quillEditorArea = document.getElementById('quill-editor-area');
            if (quillEditorArea) {
                var editor = new Quill('#quill-editor', {
                    theme: 'snow'
                });

                // Set the Quill editor content to match the textarea's value
                editor.root.innerHTML = quillEditorArea.value;

                // Sync textarea value with Quill editor on text change
                editor.on('text-change', function() {
                    quillEditorArea.value = editor.root.innerHTML;
                });

                // Sync Quill editor content with textarea on input change
                quillEditorArea.addEventListener('input', function() {
                    editor.root.innerHTML = quillEditorArea.value;
                });
            }
        });
    </script>
@endsection
