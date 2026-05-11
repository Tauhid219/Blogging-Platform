@extends('admin.layouts.app')

@php($title = 'Site settings')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group"><label>Site name</label><input type="text" name="site_name" class="form-control" value="{{ old('site_name', data_get($settings, 'site_name.value.site_name')) }}"></div>
                <div class="form-group"><label>Tagline</label><input type="text" name="site_tagline" class="form-control" value="{{ old('site_tagline', data_get($settings, 'site_tagline.value.site_tagline')) }}"></div>
                <div class="form-group"><label>Description</label><textarea name="site_description" rows="3" class="form-control">{{ old('site_description', data_get($settings, 'site_description.value.site_description')) }}</textarea></div>
                <div class="form-group"><label>Contact email</label><input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', data_get($settings, 'contact_email.value.contact_email')) }}"></div>
            </div>
            <div class="card-footer"><button class="btn btn-primary">Save settings</button></div>
        </form>
    </div>
@endsection
