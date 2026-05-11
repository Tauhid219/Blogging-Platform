# Blogging Platform Implementation Architecture

Generated: 2026-05-11

## Execution Status

- `[x]` Phase 0 completed
- `[-]` Phase 1 in progress during document creation

## Phase 0 Result

- Local git repository initialized in `C:\xampp\htdocs\My Works\Blogging-Platform`
- Local branch aligned to `main`
- Remote origin connected to `https://github.com/Tauhid219/Blogging-Platform.git`
- Previous remote project preserved on branch `backup/pre-blogging-platform-2026-05-11`
- GitHub `main` replaced with this Laravel blogging platform baseline

## High-Level Application Zones

The product will be separated into three UI zones:

1. Public frontend
2. Guest authentication frontend
3. Protected admin panel

This keeps AdminLTE isolated from the public Daiva frontend and avoids CSS and JS collisions between Bootstrap-based admin assets and Tailwind-based public assets.

## Route Architecture

### Public Routes

- `/`
- `/blog`
- `/blog/{post:slug}`
- `/category/{category:slug}`
- `/tag/{tag:slug}`
- `/page/{page:slug}`
- `/about`
- `/author/{user}`
- optional search route

### Guest Auth Routes

Existing Breeze auth routes stay active, but their visual presentation will be restyled with a dedicated guest-facing Daiva auth layout.

### Admin Routes

Admin routes will live under:

- prefix: `/admin`
- route name prefix: `admin.`
- middleware base: `auth`

Then specific modules will be protected with Spatie role/permission middleware and Laravel policies where needed.

Examples:

- `admin.dashboard`
- `admin.posts.index`
- `admin.categories.index`
- `admin.tags.index`
- `admin.comments.index`
- `admin.pages.index`
- `admin.media.index`
- `admin.users.index`
- `admin.roles.index`
- `admin.settings.edit`

## View Architecture

### Admin Views

Target structure:

- `resources/views/admin/layouts/app.blade.php`
- `resources/views/admin/partials/head.blade.php`
- `resources/views/admin/partials/navbar.blade.php`
- `resources/views/admin/partials/sidebar.blade.php`
- `resources/views/admin/partials/footer.blade.php`
- `resources/views/admin/partials/breadcrumbs.blade.php`
- `resources/views/admin/partials/alerts.blade.php`
- `resources/views/admin/partials/scripts.blade.php`
- `resources/views/admin/pages/dashboard.blade.php`
- `resources/views/admin/posts/*.blade.php`
- `resources/views/admin/categories/*.blade.php`
- `resources/views/admin/tags/*.blade.php`
- `resources/views/admin/comments/*.blade.php`
- `resources/views/admin/pages/*.blade.php`
- `resources/views/admin/users/*.blade.php`
- `resources/views/admin/roles/*.blade.php`
- `resources/views/admin/settings/*.blade.php`

### Frontend Views

Target structure:

- `resources/views/layouts/frontend.blade.php`
- `resources/views/layouts/frontend-auth.blade.php`
- `resources/views/partials/frontend/head.blade.php`
- `resources/views/partials/frontend/header.blade.php`
- `resources/views/partials/frontend/footer.blade.php`
- `resources/views/partials/frontend/sidebar.blade.php`
- `resources/views/partials/frontend/post-card.blade.php`
- `resources/views/home.blade.php`
- `resources/views/blog/index.blade.php`
- `resources/views/blog/show.blade.php`
- `resources/views/pages/about.blade.php`
- `resources/views/pages/show.blade.php`

## Template Mapping

### AdminLTE

Primary sources:

- `starter.html` for master shell
- `pages/examples/blank.html` for generic module pages
- `pages/forms/general.html` for form screens
- `pages/tables/simple.html` or `pages/tables/data.html` for listing screens

Admin asset strategy:

- import AdminLTE assets into `public/vendor/adminlte`
- keep admin CSS and JS separate from the Vite public bundle
- use Blade stacks for module-specific plugins

### Daiva

Primary sources:

- `index.html`
- `blog.html`
- `article.html`
- `about.html`
- `signin.html`

Frontend asset strategy:

- import static assets into `public/vendor/daiva`
- normalize encoding issues during import
- convert repeated static sections into Blade partials
- preserve Breeze route behavior but restyle guest auth screens with Daiva shell

## Domain Model Direction

### Core Entities

- `users`
- `user_profiles`
- `posts`
- `post_revisions`
- `categories`
- `tags`
- `post_tag`
- `comments`
- `media`
- `pages`
- `settings`

### Post Lifecycle

Planned statuses:

- `draft`
- `in_review`
- `scheduled`
- `published`
- `archived`

### Comment Lifecycle

Planned statuses:

- `pending`
- `approved`
- `rejected`
- `spam`

### User Lifecycle

Planned statuses:

- `active`
- `pending`
- `suspended`
- `banned`

## RBAC Direction

### Planned Roles

- `super_admin`
- `admin`
- `editor`
- `author`
- `moderator`

### Permission Groups

- `dashboard.*`
- `posts.*`
- `categories.*`
- `tags.*`
- `comments.*`
- `media.*`
- `pages.*`
- `users.*`
- `roles.*`
- `permissions.*`
- `settings.*`

### Authorization Strategy

- Spatie middleware for route/module gatekeeping
- Laravel policies for record-level decisions such as own-vs-any post editing
- Blade permission checks for navigation and action visibility

## Important Technical Notes

- Current `User` model does not implement `MustVerifyEmail`, while `/dashboard` uses `verified` middleware, so email verification must be completed or route middleware adjusted.
- Admin and frontend layouts should remain isolated because AdminLTE is Bootstrap/jQuery based and the public site uses Tailwind-driven styling.
- The remote repository takeover is complete, so all further implementation can proceed directly in this workspace and be pushed incrementally.
