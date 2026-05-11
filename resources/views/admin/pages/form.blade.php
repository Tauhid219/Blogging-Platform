<div class="card">
    <div class="card-body">
        <div class="form-group"><label>Title</label><input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}"></div>
        <div class="form-group"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}"></div>
        <div class="form-group"><label>Excerpt</label><textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt', $page->excerpt) }}</textarea></div>
        <div class="form-group"><label>Body</label><textarea name="body" rows="12" class="form-control">{{ old('body', $page->body) }}</textarea></div>
        <div class="row">
            <div class="col-md-6 form-group"><label>Template</label><input type="text" name="template" class="form-control" value="{{ old('template', $page->template) }}"></div>
            <div class="col-md-6 form-group"><label>Status</label><select name="status" class="form-control">@foreach($statuses as $status)<option value="{{ $status }}" @selected(old('status', $page->status ?: 'draft') === $status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
        </div>
        <div class="form-group"><label>SEO title</label><input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $page->seo_title) }}"></div>
        <div class="form-group"><label>SEO description</label><textarea name="seo_description" rows="3" class="form-control">{{ old('seo_description', $page->seo_description) }}</textarea></div>
    </div>
    <div class="card-footer"><button class="btn btn-primary">{{ $submitLabel }}</button></div>
</div>
