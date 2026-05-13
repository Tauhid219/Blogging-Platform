---
name: laravel-adminlte-admin
description: Build or update the protected admin panel for this Laravel blogging platform using the AdminLTE visual system. Use when working on admin routes, admin Blade views, dashboard widgets, CRUD screens, sidebar/navigation, admin assets, or permission-aware management UI under `resources/views/admin`, `app/Http/Controllers/Admin`, and `/admin` routes.
---

# Laravel AdminLTE Admin

Keep the admin panel isolated from the public frontend.

## Follow This Structure

- Put controllers in `app/Http/Controllers/Admin`
- Put views in `resources/views/admin`
- Keep route names under `admin.*`
- Keep the route prefix under `/admin`
- Keep AdminLTE assets under `public/vendor/adminlte`

## Workflow

1. Read `routes/web.php` and confirm the target admin route names.
2. Read the related controller in `app/Http/Controllers/Admin`.
3. Read the related Blade files in `resources/views/admin`.
4. Preserve the shared shell in `resources/views/admin/layouts/app.blade.php`.
5. Reuse partials from `resources/views/admin/partials`.
6. Add permission-aware links or actions with Blade authorization checks.
7. Run a focused verification command after changes.

## Guardrails

- Do not mix Daiva frontend markup into admin views.
- Do not move admin assets into the public frontend layout.
- Prefer route-level middleware and policies over controller `$this->middleware()` calls.
- Keep admin forms and tables compatible with AdminLTE card and table patterns.

## Verify

- Use `php artisan route:list --name=admin`
- Use `php artisan test --filter=ExampleTest` for fast sanity checks
- Use `php artisan test` when the change touches multiple admin flows

## References

- Read `references/admin-architecture.md` before larger admin refactors.
