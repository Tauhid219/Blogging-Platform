@extends('admin.layouts.app')

@php($title = 'Media library')

@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">Uploaded files</h3></div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead><tr><th>File</th><th>MIME</th><th>Size</th><th>Uploader</th></tr></thead>
                <tbody>
                @forelse ($mediaItems as $item)
                    <tr>
                        <td>{{ $item->original_name }}</td>
                        <td>{{ $item->mime_type }}</td>
                        <td>{{ number_format($item->size / 1024, 1) }} KB</td>
                        <td>{{ $item->user?->name }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">No media uploads yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $mediaItems->links() }}</div>
    </div>
@endsection
