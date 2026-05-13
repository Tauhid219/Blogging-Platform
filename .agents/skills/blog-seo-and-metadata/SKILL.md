---
name: blog-seo-and-metadata
description: Improve SEO, metadata, and search-facing content quality for this blogging platform. Use when working on page titles, meta descriptions, canonical URLs, Open Graph or social metadata, slug hygiene, structured content metadata, sitemap-related logic, or SEO-aware rendering across posts, pages, and frontend layouts.
---

# Blog SEO And Metadata

Keep search-facing behavior intentional and consistent.

## Workflow

1. Read the target frontend route and controller.
2. Read the relevant Blade layout or page template.
3. Check whether the data already exists in the model or schema.
4. Reuse `seo_title`, `seo_description`, slug, and publish metadata where possible.
5. Prefer a shared metadata pattern in layouts over per-page duplication.
6. Verify that draft or unpublished content is not exposed through metadata.

## Focus Areas

- document title
- meta description
- canonical URL
- Open Graph title and description
- article publish metadata
- consistent slug usage
- archive and page metadata

## Guardrails

- Do not hardcode one-off metadata when model fields already exist.
- Do not expose draft titles or unpublished slugs on public pages.
- Keep metadata fallbacks readable and deterministic.
- Prefer shared layout variables over repeated literal strings.

## Verify

- Use `php artisan test --filter=ExampleTest`
- Check relevant frontend Blade files and route outputs

## References

- Read `references/seo-map.md` before larger metadata changes.
