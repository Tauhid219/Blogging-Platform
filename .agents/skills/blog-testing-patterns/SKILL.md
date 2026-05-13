---
name: blog-testing-patterns
description: Add or refine tests for this blogging platform in a way that matches its current Laravel architecture. Use when creating feature tests, auth and RBAC verification, content visibility checks, admin workflow tests, regression coverage, or selecting the right verification depth after changes.
---

# Blog Testing Patterns

Use tests to protect real workflows, not just code paths.

## Workflow

1. Inspect the changed route, controller, model, and view.
2. Decide whether the risk belongs in unit or feature coverage.
3. Prefer feature tests for auth, RBAC, admin workflows, publishing visibility, and route behavior.
4. Seed or factory-create only the minimum domain objects needed for the scenario.
5. Keep assertions user-visible when possible.
6. Run the narrowest useful test first, then widen if needed.

## High-Value Test Areas

- login and guest auth rendering
- admin access and restricted modules
- published vs draft content visibility
- taxonomy archive behavior
- settings-driven rendering
- CRUD workflow regressions

## Guardrails

- Do not add brittle tests tied to incidental HTML noise.
- Prefer route and behavior assertions over snapshot-heavy checks.
- Keep test data readable and domain-oriented.
- Call out when a flow is only manually verified.

## Verify

- Use `php artisan test --filter=ExampleTest` for quick public-route checks
- Use `php artisan test --filter=ProfileTest` or auth-specific suites for account changes
- Use full `php artisan test` for cross-cutting changes

## References

- Read `references/testing-notes.md` before adding broader coverage.
