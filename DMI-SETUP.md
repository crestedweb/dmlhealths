# DMI Healths website setup

## Local setup (Windows Command Prompt)

```bat
copy /Y .env.example .env
php artisan key:generate
type nul > database\database.sqlite
php artisan migrate
php artisan serve
```

For PostgreSQL/Supabase, set `DB_CONNECTION=pgsql`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`, then run `php artisan migrate`. Keep all credentials out of source control.

## Create the first administrator

Run `php artisan tinker`, then create an approved DMI user:

```php
App\Models\User::create(['name' => 'DMI Administrator', 'email' => 'replace-with-approved-email@example.org', 'password' => 'choose-a-strong-password', 'is_admin' => true]);
```

Sign in at `/admin/login`. Never use the example email or password in production.

## Content and images

The database migration creates tables for services, articles, gallery items, FAQs, team members, enquiries, requests, donations, newsletter subscribers, settings, and social links. Development image URLs live in `config/site.php`. Replace them with approved DMI photos before launch and ensure consent is documented for any identifiable resident image.

## Deployment

Set `APP_ENV=production`, `APP_DEBUG=false`, a strong `APP_KEY`, PostgreSQL connection details, trusted `APP_URL`, and mail configuration. Point Nginx to `public/`, enable HTTPS, run `php artisan migrate --force`, and give the web process access only to required storage directories. Configure regular database backups at the PostgreSQL/Supabase provider.
