# SEO Map

## Likely Sources

- `App\Models\Post`
- `App\Models\Page`
- `resources/views/layouts/frontend.blade.php`
- `resources/views/blog/show.blade.php`
- `resources/views/blog/index.blade.php`
- `resources/views/pages/show.blade.php`

## Existing Relevant Fields

- `slug`
- `seo_title`
- `seo_description`
- `published_at`
- `excerpt`

## Good Fallback Order

- title: `seo_title` -> entity title -> site name
- description: `seo_description` -> excerpt -> site description
