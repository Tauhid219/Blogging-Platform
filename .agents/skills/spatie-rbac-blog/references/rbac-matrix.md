# RBAC Matrix

## Roles

- `super_admin`: all permissions
- `admin`: all operational modules
- `editor`: content, taxonomy, comments, pages, media
- `author`: own content creation and media basics
- `moderator`: comment moderation

## Where To Update

- `database/seeders/PermissionSeeder.php`
- `database/seeders/RoleSeeder.php`
- `routes/web.php`
- admin Blade navigation and action buttons

## Recommended Next Step

Introduce policies for own-vs-any post and page actions if author workflows expand.
