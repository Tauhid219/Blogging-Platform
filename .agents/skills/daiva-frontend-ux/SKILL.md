---
name: daiva-frontend-ux
description: Build or refine the public-facing frontend of this Laravel blog with the Daiva design language. Use when working on homepage sections, blog index/detail pages, guest auth presentation, frontend partials, public routes, or reader-facing Blade templates under `resources/views/blog`, `resources/views/pages`, `resources/views/partials/frontend`, and `resources/views/layouts/frontend.blade.php`.
---

# Daiva Frontend UX

Preserve the reader-facing Daiva look while keeping it Laravel-friendly.

## Follow This Structure

- Use `resources/views/layouts/frontend.blade.php` for public pages
- Use `resources/views/layouts/guest.blade.php` for guest auth presentation
- Use `resources/views/partials/frontend` for shared sections
- Keep Daiva assets under `public/vendor/daiva`

## Workflow

1. Read the target public route in `routes/web.php`.
2. Read the related controller in `app/Http/Controllers/Frontend`.
3. Read the relevant view and shared partials.
4. Keep repeated page sections extracted into partials when possible.
5. Maintain the established typography, spacing, and section rhythm.
6. Ensure new content still works on smaller screens.
7. Re-test the homepage or target page after edits.

## Guardrails

- Do not replace the public layout with AdminLTE markup.
- Do not add generic starter-kit styling that fights the Daiva look.
- Avoid copy-pasting large static HTML blocks when a partial is better.
- Keep dynamic data slots easy to follow in Blade.

## Verify

- Use `php artisan route:list`
- Use `php artisan test --filter=ExampleTest`

## References

- Read `references/frontend-patterns.md` before larger public-facing changes.
