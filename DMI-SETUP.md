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

## Stripe checkout for CPR online courses

The CPR training page offers Stripe-hosted checkout for the fixed-price online course options. In-person and hybrid courses remain training requests; the server determines the price from `config/training_courses.php` and does not trust a submitted price.

1. In the Stripe Dashboard, use **test mode** and copy the **Secret key** (`sk_test_...`).
2. Put the key in the project's local `.env` file:

   ```dotenv
   STRIPE_SECRET=sk_test_your_test_secret_key
   STRIPE_WEBHOOK_SECRET=
   ```

3. Run the database migration and start the app:

   ```bat
   php artisan migrate
   php artisan serve
   ```

4. To receive payment confirmations locally, install and sign in to the [Stripe CLI](https://docs.stripe.com/stripe-cli), then forward the webhook events used by the app:

   ```bat
   stripe listen --events checkout.session.completed,checkout.session.async_payment_succeeded --forward-to http://127.0.0.1:8000/stripe/webhook
   ```

   Copy the CLI's `whsec_...` signing secret into `STRIPE_WEBHOOK_SECRET` in `.env`. Restart the app after changing environment values.
5. On `/cpr-training`, select an online course option, enter the Stripe test payment details, and complete checkout. Stripe test cards and their details are listed in [Stripe's testing documentation](https://docs.stripe.com/testing). The order is marked paid only after a valid signed webhook confirms the amount and currency.
6. Before accepting real payments, switch out of test mode, set the live `sk_live_...` key on the server, and register `https://your-domain/stripe/webhook` as a Stripe webhook endpoint for the same two events. Set that endpoint's `whsec_...` as `STRIPE_WEBHOOK_SECRET`; use HTTPS and never commit either secret. Configure production mail so payment confirmations reach the customer and training team.

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
