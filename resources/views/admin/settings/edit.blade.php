@extends('admin.layouts.app')

@php
    $title = 'Site settings';
@endphp

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group"><label>Site name</label><input type="text" name="site_name" class="form-control" value="{{ old('site_name', data_get($settings, 'site_name.value.site_name')) }}"></div>
                <div class="form-group"><label>Tagline</label><input type="text" name="site_tagline" class="form-control" value="{{ old('site_tagline', data_get($settings, 'site_tagline.value.site_tagline')) }}"></div>
                <div class="form-group"><label>Description</label><textarea name="site_description" rows="3" class="form-control">{{ old('site_description', data_get($settings, 'site_description.value.site_description')) }}</textarea></div>
                <div class="form-group"><label>Contact email</label><input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', data_get($settings, 'contact_email.value.contact_email')) }}"></div>
                <div class="form-group">
                    <label for="fallback_post_image_upload">Fallback post image</label>
                    <div class="custom-file">
                        <input type="file" name="fallback_post_image_upload" class="custom-file-input" id="fallback_post_image_upload" accept=".jpg,.jpeg,.png,.webp,.gif">
                        <label class="custom-file-label" for="fallback_post_image_upload">Choose fallback image</label>
                    </div>
                    <small class="form-text text-muted">Validation: JPG, JPEG, PNG, WEBP, or GIF only. Maximum file size: 5 MB. This image appears automatically when a post has no featured image.</small>
                    @error('fallback_post_image_upload')
                        <span class="text-danger small d-block mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-0">
                    <label>Current fallback image</label>
                    <div class="border rounded p-2 bg-light">
                        <img
                            src="{{ $siteSettings['fallback_post_image_url'] ?? asset('vendor/daiva/codye2.png') }}"
                            alt="Current fallback post image"
                            class="img-fluid rounded"
                            style="max-height: 220px; object-fit: cover;"
                        >
                    </div>
                </div>
            </div>
            <div class="card-footer"><button class="btn btn-primary">Save settings</button></div>
        </form>
    </div>
@endsection
