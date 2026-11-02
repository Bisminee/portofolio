# Deployment guide — Render (free)

This project is a dynamic Laravel 12 + Filament 4 application. It cannot be hosted on GitHub Pages, which only serves static files. The included Dockerfile targets **Render's free web service**, which provides a free `*.onrender.com` URL.

## What is already done

- `Dockerfile` with PHP 8.3, Apache, SQLite, Composer dependencies, and production caches.
- `docker/entrypoint.sh` runs migrations, the idempotent seeders, and `php artisan optimize` on boot.
- `render.yaml` Blueprint with the free plan, health check at `/up`, and required environment variables.
- `.github/workflows/tests.yml` runs Pint and the test suite on every push.
- `.dockerignore` and `.gitignore` keep secrets, the SQLite database, and local files out of the image and repository.
- The site was built and tested locally, including production caches (`php artisan optimize`).

## What requires your account or approval

- Creating the GitHub repository and pushing the code.
- Creating a Render account and authorising Render to read the repository.
- Generating and entering production secrets (`APP_KEY`, `ADMIN_PASSWORD`, `APP_URL`).
- Approving the Blueprint / first deploy.
- Optional: buying a custom domain (not free and not required).

No deployment has been performed on your behalf because those steps require your login.

---

## 1. Push the project to GitHub

From `D:\Kuliah\portfolio`:

```bash
git init
git add .
git commit -m "Build Laravel portfolio with Filament studio"
git branch -M main
```

Create an empty repository on GitHub (for example `portfolio`), then:

```bash
git remote add origin https://github.com/Bisminee/portfolio.git
git push -u origin main
```

Before committing, confirm that `git status` does **not** list `.env` or `database/database.sqlite`. Both are ignored. If `.env` was ever committed elsewhere, rotate the credentials.

## 2. Generate the production application key

Run locally:

```bash
php artisan key:generate --show
```

Copy the output (`base64:...`). You will paste it into Render as `APP_KEY`. Do not commit it.

## 3. Deploy on Render

1. Sign in at <https://render.com> with GitHub.
2. Choose **New → Blueprint**.
3. Select the repository you just pushed. Render reads `render.yaml`.
4. Apply the Blueprint. The service name will be `bisma-portfolio` unless you change it.
5. When prompted, fill the secret variables:
   - `APP_URL` — the final URL Render shows, for example `https://bisma-portfolio.onrender.com` (include `https://`, no trailing slash).
   - `APP_KEY` — the `base64:...` value from step 2.
   - `ADMIN_EMAIL` — the email you want for the studio login.
   - `ADMIN_PASSWORD` — a long, unique password (16+ characters).
6. Wait for the Docker build and the health check at `/up` to pass.

`PORT=80` is already set in `render.yaml`; the Dockerfile exposes port 80. Do not change the service to a static site.

### Build and output settings

Render's Docker runtime does not use separate “build command” and “publish directory” fields. The Dockerfile is the build definition:

- Build: `docker build` using `Dockerfile`
- Serve: Apache with `DocumentRoot /var/www/html/public`
- Health check: `/up`

If you create the service manually instead of using the Blueprint, choose **Web Service → Docker**, point it at the repository, set the same environment variables, and set the health check path to `/up`.

## 4. Verify the deployment

Visit:

- `https://YOUR-SERVICE.onrender.com/` — portfolio loads.
- `https://YOUR-SERVICE.onrender.com/up` — returns HTTP 200.
- `https://YOUR-SERVICE.onrender.com/studio` — Filament login.
- `https://YOUR-SERVICE.onrender.com/studio/projects` — case-file list after login.

Sign in with `ADMIN_EMAIL` and `ADMIN_PASSWORD`, open **Beyond Code**, and confirm the table is empty. Do not add sample entries unless they are real.

Then test:
- Mobile navigation and the “Beyond Code” anchor.
- At least one project link and the Sera-Z APK link.
- The browser console and the 404 page (`/does-not-exist`).

## 5. Updating the site

Render auto-deploys every push to `main`:

```bash
git add .
git commit -m "Update case file"
git push
```

The entrypoint re-runs migrations and seeding. The project seeder skips existing rows, so studio edits persist **within the life of the instance**.

### Important free-tier limitation: ephemeral SQLite

Render's free tier does not include a persistent disk. The SQLite file lives inside the container and is reset on every redeploy or restart. Consequences:

- Seeded case files return automatically.
- Edits made in the Filament studio, including Beyond Code entries, are lost on redeploy/restart.
- The studio session is cleared.

Options:

1. Edit content and accept that it resets (fine for a demo).
2. Put the canonical content in `database/seeders/ProjectSeeder.php` or `config/site.php` and redeploy.
3. Add a paid persistent disk or an external database (not configured here; this is not a free guarantee).

Do not assume the free instance keeps data forever.

### Cold starts

Free Render services spin down after inactivity and take roughly 30–60 seconds to wake. This is normal. The first visitor may see a delay; the page is not broken.

## 6. Troubleshooting

| Symptom | Cause | Fix |
| --- | --- | --- |
| `500` on every page | Missing/invalid `APP_KEY` | Set a valid `base64:` key and redeploy |
| Links or assets point to `http://` | `APP_URL` wrong | Set the exact `https://...onrender.com` URL |
| `403` at `/studio` | Not signed in, or user missing | Check `ADMIN_EMAIL`, redeploy, then seed/login |
| `404` on `/studio/projects` | Stale route cache in the image | Redeploy; the entrypoint runs `php artisan optimize` |
| CSS or images 404 | Apache document root or rewrite problem | Confirm the Dockerfile and `docker/apache-vhost.conf` are used |
| Build fails at Composer | `composer.lock` out of sync | Run `composer update --lock` locally, commit, push |
| Build fails on extensions | Dockerfile edited | Keep `pdo_sqlite`, `sqlite3`, `intl`, and `zip` |
| Login works, then logs out | Free instance restarted | Expected; sign in again |
| Blank page, no logs | PHP fatal | Check Render logs; set `APP_DEBUG=true` temporarily, then remove it |

View logs in Render → your service → **Logs**. Run `php artisan about` locally to compare configuration.

After changing environment variables, trigger **Manual Deploy → Clear build cache & deploy** if the old values persist.

## 7. Alternatives considered

### GitHub Pages — not viable for this build

GitHub Pages serves static files only. Laravel routes, the Filament studio, SQLite, and server-side sessions require PHP. A static export would remove the studio entirely. If a static-only portfolio is required later, a separate Vite/React build could be published to Pages, but it would not be this application.

### Vercel — possible only with a community PHP runtime

Vercel has no first-class PHP runtime. Community runtimes can serve Laravel, but the filesystem is read-only except `/tmp`, Filament sessions and SQLite are awkward, and every cold start can lose data. Not selected.

### Netlify — static/functions first

Netlify can host static output or serverless functions, not a conventional Laravel/Apache process. Porting Filament and SQLite would add fragility without improving the result. Not selected.

### Render — selected

Free web service, Docker support, managed HTTPS on a free `onrender.com` subdomain, health checks, and Git-based deploys. The trade-offs are cold starts and an ephemeral filesystem, documented above.

### Custom domain

A custom domain is optional and normally requires payment to a registrar. This project uses the free Render subdomain and does not promise a free custom domain. HTTPS on `onrender.com` is provided by Render.

## 8. Rollback

Render keeps previous deploys. Open the service → **Deploys**, select the last healthy deploy, and choose **Rollback**. For code-level rollback:

```bash
git revert <commit>
git push
```

Rolling back also resets the ephemeral database to the seed state.
