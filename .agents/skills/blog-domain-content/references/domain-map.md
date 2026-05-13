# Domain Map

## Models

- `App\Models\Post`
- `App\Models\Category`
- `App\Models\Tag`
- `App\Models\Comment`
- `App\Models\Page`
- `App\Models\Media`
- `App\Models\Setting`
- `App\Models\UserProfile`

## Seeders

- `Database\Seeders\BlogSeeder`
- `Database\Seeders\PermissionSeeder`
- `Database\Seeders\RoleSeeder`

## Important Behaviors

- published content queries rely on scopes
- slug model binding is used on blog and page routes
- admin dashboard and frontend pages expect seeded baseline data
