<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Content</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}">
                </div>
                <div class="form-group">
                    <label>Excerpt</label>
                    <textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea name="body" rows="14" class="form-control" required>{{ old('body', $post->body) }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Publishing</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected(old('status', $post->status ?: 'draft') === $status)>{{ ucwords(str_replace('_', ' ', $status)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Uncategorized</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((int) old('category_id', $post->category_id) === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tags</label>
                    <select name="tag_ids[]" class="form-control" multiple size="8">
                        @php($selectedTags = collect(old('tag_ids', $post->tags->pluck('id')->all())))
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @selected($selectedTags->contains($tag->id))>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Featured image URL</label>
                    <input type="text" name="featured_image_path" class="form-control" value="{{ old('featured_image_path', $post->featured_image_path) }}">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" name="is_featured" id="is_featured" @checked(old('is_featured', $post->is_featured))>
                    <label class="form-check-label" for="is_featured">Feature this post</label>
                </div>
                <div class="form-group">
                    <label>SEO title</label>
                    <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $post->seo_title) }}">
                </div>
                <div class="form-group">
                    <label>SEO description</label>
                    <textarea name="seo_description" rows="3" class="form-control">{{ old('seo_description', $post->seo_description) }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            </div>
        </div>
    </div>
</div>
