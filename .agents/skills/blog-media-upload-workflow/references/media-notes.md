# Media Notes

## Current State

- `App\Models\Media` exists
- admin media listing exists
- full upload workflow is still a next-step enhancement

## Common Touchpoints

- `app/Models/Media.php`
- `app/Http/Controllers/Admin/MediaController.php`
- post and page forms
- `config/filesystems.php`

## Recommended Concerns

- validate MIME and size
- use generated filenames
- store disk and path metadata
- connect ownership to the uploading user
