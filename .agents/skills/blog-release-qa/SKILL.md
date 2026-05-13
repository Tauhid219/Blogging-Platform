---
name: blog-release-qa
description: Prepare, verify, and harden this blogging platform for release-quality changes. Use when validating migrations, seeders, tests, launch notes, repo hygiene, regression checks, deployment prep, or production-minded quality gates before merge or push.
---

# Blog Release QA

Use this skill to finish work cleanly and safely.

## Workflow

1. Inspect changed files and identify affected workflows.
2. Run the narrowest useful verification first.
3. Escalate to full test coverage or migration checks when the change touches multiple layers.
4. Update project docs if the operational behavior changed.
5. Summarize what passed, what was not run, and remaining risk.

## Default Verification Ladder

1. `php artisan route:list`
2. `php artisan migrate:status`
3. `php artisan test --filter=ExampleTest`
4. `php artisan test`

## Operational Notes

- Keep `docs/launch-readiness-notes.md` aligned with real setup steps.
- Keep seeded admin credentials documented only as local bootstrap defaults.
- Prefer additive migrations and explicit verification over destructive resets.

## Guardrails

- Do not claim a flow is verified if it was not run.
- Do not use destructive git commands unless explicitly asked.
- Call out storage, cache, or permission issues separately from app bugs.

## References

- Read `references/release-checklist.md` before final verification passes.
