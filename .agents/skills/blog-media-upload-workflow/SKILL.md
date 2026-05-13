---
name: blog-media-upload-workflow
description: Build or improve the media upload and attachment workflow for this blogging platform. Use when adding file uploads, storage handling, media validation, attachment relationships, image fields, admin media tools, or public rendering for uploaded assets tied to posts, pages, profiles, and the media library.
---

# Blog Media Upload Workflow

Treat uploads as an operational workflow, not just a file input.

## Workflow

1. Read the target controller, model, and view.
2. Read `config/filesystems.php` if storage behavior is involved.
3. Confirm how `App\Models\Media` is being used.
4. Decide whether the upload belongs to a central media library or an entity-specific field.
5. Validate file types, size, and storage disk explicitly.
6. Keep database metadata and physical storage paths in sync.
7. Verify local rendering and cleanup behavior.

## Focus Areas

- upload validation
- disk selection
- file naming
- path persistence
- media ownership
- alt text
- featured image mapping
- media listing and attachment

## Guardrails

- Do not trust raw user filenames as final storage names.
- Do not store upload logic only in Blade.
- Keep file metadata in the `media` table when the library is involved.
- Use `storage:link` or public asset strategy intentionally.

## Verify

- Use `php artisan test`
- Verify `php artisan storage:link` expectations when relevant
- Check the admin media listing route and any entity preview using the uploaded asset

## References

- Read `references/media-notes.md` before implementing uploads.
