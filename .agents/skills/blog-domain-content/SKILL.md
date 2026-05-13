---
name: blog-domain-content
description: Work on the core content domain of this blogging platform, including schema, models, editorial workflows, taxonomy, pages, comments, and publishing logic. Use when modifying blog entities, Eloquent relations, seed data, migrations, or content rendering behavior tied to posts, categories, tags, pages, comments, media, and settings.
---

# Blog Domain Content

Treat content architecture as a product surface, not just tables.

## Workflow

1. Read the target model and any connected models.
2. Read the relevant migration and seeder files.
3. Confirm route and controller expectations before changing schema behavior.
4. Preserve slug-based routing and publishing-state rules.
5. Update seeders when a domain change affects baseline demo content.
6. Run migrations and focused verification commands after changes.

## Core Entities

- users
- user_profiles
- posts
- post_revisions
- categories
- tags
- post_tag
- comments
- media
- pages
- settings

## Publishing Rules

- Public post visibility should depend on `published` status and `published_at`.
- Public page visibility should depend on `published` status and `published_at`.
- Draft or archived content must not leak to reader-facing routes.

## Guardrails

- Do not break slug uniqueness.
- Do not remove status fields without replacing the workflow.
- Keep seeded content valid after schema changes.
- Keep relationships explicit and readable.

## Verify

- Use `php artisan migrate:status`
- Use `php artisan migrate --force`
- Use `php artisan db:seed --force`
- Use `php artisan test`

## References

- Read `references/domain-map.md` before altering core content entities.
