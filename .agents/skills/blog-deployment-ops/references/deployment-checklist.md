# Deployment Checklist

## Minimum Production Questions

- what is `APP_URL`
- which database is used
- which cache, session, and queue drivers are intended
- is `storage:link` required
- are queues and scheduler needed
- are seeded demo credentials still mentioned anywhere unsafe

## Useful Files

- `.env.example`
- `config/*.php`
- `docs/launch-readiness-notes.md`
