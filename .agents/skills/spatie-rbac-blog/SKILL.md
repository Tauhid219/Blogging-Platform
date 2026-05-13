---
name: spatie-rbac-blog
description: Maintain or extend role-based access control for this Laravel blogging platform with Spatie Permission. Use when adding roles, permissions, route protection, permission-aware Blade UI, role seeders, or authorization rules for admin modules and editorial workflows.
---

# Spatie RBAC Blog

Keep authorization explicit, repeatable, and easy to audit.

## Workflow

1. Read `routes/web.php` for the protected route surface.
2. Read the relevant admin controller and view.
3. Read `database/seeders/PermissionSeeder.php` and `database/seeders/RoleSeeder.php`.
4. Add or update permission names using the existing `<module>.<action>` pattern.
5. Keep route-level middleware aligned with seeded permissions.
6. Add Blade authorization checks where actions or navigation should hide.
7. Re-seed or test authorization after changes.

## Current Role Set

- `super_admin`
- `admin`
- `editor`
- `author`
- `moderator`

## Current Permission Pattern

- `dashboard.view`
- `posts.*`
- `categories.*`
- `tags.*`
- `comments.*`
- `media.*`
- `pages.*`
- `users.*`
- `roles.*`
- `settings.*`

## Guardrails

- Do not invent a different permission naming style mid-project.
- Do not rely only on hidden buttons; keep server-side protection in place.
- Prefer policies for own-vs-any rules when author workflows get deeper.

## Verify

- Use `php artisan db:seed --force`
- Use `php artisan route:list`
- Use `php artisan test`

## References

- Read `references/rbac-matrix.md` before changing permission groups.
