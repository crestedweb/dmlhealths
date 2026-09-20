# DMI Healths — Laravel workspace

This is the same page you had as a static HTML file, restructured as a real
Laravel app: `resources/views/home.blade.php` is the template,
`app/Http/Controllers/HomeController.php` serves it, `routes/web.php` wires
the route, and `public/css/app.css` holds the styles.

## 1. Install dependencies (do this on your own machine, not this sandbox)

```bash
composer install
cp .env.example .env
php artisan key:generate
```

## 2. Run it locally

```bash
php artisan serve
```

Visit http://localhost:8000.

## 3. Deploying to cPanel

cPanel shared hosting expects the **document root to point at `public/`**,
not the project root — that's the part people usually get wrong with Laravel
on cPanel. Two common ways to do it:

**Option A — subdomain/addon domain document root (easiest)**
1. Upload the whole project (everything except `vendor/`, then run
   `composer install` over SSH once it's on the server — most cPanel hosts
   support SSH + Composer under "Setup Node.js/PHP" or a terminal option).
2. In cPanel → Domains, set the document root for your domain/subdomain to
   the project's `public/` folder instead of the default `public_html`.

**Option B — no SSH/Composer access on the host**
1. Run `composer install --no-dev --optimize-autoloader` locally, which
   creates the `vendor/` folder.
2. Zip the whole project *including* `vendor/` and upload it.
3. Still point the domain's document root at `public/`.

Either way, Laravel needs PHP 8.2+ (this was built against 8.3) and the
`mbstring`, `openssl`, `pdo`, `fileinfo` extensions, which nearly every
current cPanel PHP selector has enabled by default.

## 4. What's different from the static file

- The markup and CSS are unchanged — just moved into Blade + `public/css/app.css`.
- Nothing dynamic has been added yet (no database, no contact-form backend).
  This is the MVC skeleton so you have somewhere to add that next —
  e.g. a `Contact` model + controller for the "Contact Us" form.
