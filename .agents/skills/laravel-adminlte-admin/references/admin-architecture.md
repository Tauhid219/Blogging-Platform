# Admin Architecture

## Primary Paths

- Controllers: `app/Http/Controllers/Admin`
- Layout: `resources/views/admin/layouts/app.blade.php`
- Partials: `resources/views/admin/partials`
- Pages: `resources/views/admin/*`
- Assets: `public/vendor/adminlte`

## Shared Conventions

- Use `admin.*` route names.
- Keep admin UI Bootstrap/AdminLTE based.
- Keep sidebar visibility permission-aware.
- Use cards, tables, badges, and content headers consistently.

## Modules Present

- dashboard
- posts
- categories
- tags
- comments
- pages
- media
- users
- roles
- settings

## Common Risks

- Reintroducing unsupported controller middleware calls
- Mixing Tailwind-heavy frontend sections into AdminLTE pages
- Breaking sidebar active-state route checks
