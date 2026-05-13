---
name: blog-deployment-ops
description: Prepare or refine deployment and operations behavior for this blogging platform. Use when working on environment variables, production setup, caches, storage links, queue or scheduler expectations, repo deployment notes, server readiness, or operational hardening for local-to-production rollout.
---

# Blog Deployment Ops

Make deployment behavior explicit and repeatable.

## Workflow

1. Read `docs/launch-readiness-notes.md`.
2. Read relevant config files such as `config/app.php`, `config/cache.php`, `config/queue.php`, `config/filesystems.php`, and `.env.example`.
3. Identify the operational change or deployment assumption.
4. Update code, config, or docs together when behavior changes.
5. Verify the lowest-risk commands that reflect the new deployment expectations.

## Focus Areas

- `.env` expectations
- app URL and mail settings
- cache, queue, and session drivers
- storage link requirements
- migration and seed commands
- scheduler and queue worker notes
- production-safe setup steps

## Guardrails

- Do not commit secrets.
- Do not assume local-only settings are acceptable in production docs.
- Keep launch notes aligned with real commands and required services.
- Call out any operation that still needs human server access.

## Verify

- Use `php artisan config:clear`
- Use `php artisan route:list`
- Use `php artisan migrate:status`
- Use `php artisan test` when operational changes affect runtime behavior

## References

- Read `references/deployment-checklist.md` before editing deployment notes.
