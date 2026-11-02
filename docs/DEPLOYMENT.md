# Deployment guide — GitHub Pages (free)

The public portfolio is deployed as a **static snapshot** to GitHub Pages. Laravel 12 and Filament 4 remain the authoring environment on your computer: the studio manages the case files, and `php artisan portfolio:export` writes the public HTML into `site/`.

This keeps hosting genuinely free and avoids PHP server costs. The trade-off is that the Filament studio is **not available online**; it runs locally only.

## What is already done

- Laravel + Filament application and studio.
- `php artisan portfolio:export` renders `site/index.html`, `site/404.html`, CSS, JS, images, and fonts.
- `site/` is a complete static snapshot, committed to the repository.
- `.github/workflows/pages.yml` uploads `site/` to GitHub Pages on every push to `main`.
- `.github/workflows/tests.yml` runs Pint and PHPUnit on every push.
- Repository pushed to `https://github.com/Bisminee/portofolio`.
- A 404 page and `.nojekyll` are included in the export.

## What requires your account or approval

- Enabling GitHub Pages for the repository (one-time): **Settings → Pages → Source: GitHub Actions**.
- Approving the first workflow run if GitHub asks.
- Optional: connecting a custom domain (normally paid).

## URLs

The free project URL is:

```text
https://bisminee.github.io/portofolio/
```

A custom domain such as `bisminee.dev` requires a registrar payment and is not included. HTTPS on `github.io` is provided by GitHub.

---

## 1. Publish the current static site

The current snapshot has already been exported with the correct base URL:

```bash
php artisan portfolio:export --base-url=https://bisminee.github.io/portofolio/
```

Then:

```bash
git add site
git commit -m "Publish static portfolio"
git push
```

The Pages workflow deploys `site/` automatically.

## 2. Enable GitHub Pages once

1. Open <https://github.com/Bisminee/portofolio/settings/pages>.
2. Under **Build and deployment**, set **Source** to **GitHub Actions**.
3. Open the **Actions** tab and run **Deploy static portfolio to GitHub Pages** if it did not start automatically.
4. Wait for the `deploy` job to finish.
5. Visit <https://bisminee.github.io/portofolio/>.

No build command, output directory, or base-path setting is needed in the Pages UI — the workflow supplies the `site/` artifact.

## 3. Editing content later

Because Pages only serves static files, content changes are a three-step loop:

```bash
# 1. Edit content in the local studio
php artisan serve
# open http://127.0.0.1:8000/studio

# 2. Rebuild the static snapshot
php artisan portfolio:export --base-url=https://bisminee.github.io/portofolio/

# 3. Publish it
git add site
git commit -m "Update case files"
git push
```

**Important:** if you edit a case file or add a Beyond Code entry in the studio but forget to re-export, the live site will not change. `site/` is the deployed copy; `database/database.sqlite` is local only and is never committed.

To preview the exported static files locally, run:

```bash
php artisan serve
```

That previews the Laravel version. To preview the actual static folder, use any local static server pointed at `site/`, for example:

```bash
php -S 127.0.0.1:8081 -t site
```

## 4. How the export works

```bash
php artisan portfolio:export \
  --base-url=https://bisminee.github.io/portofolio/ \
  --output=site
```

It renders:

- `site/index.html` — the full single-page portfolio.
- `site/404.html` — the custom not-found page.
- `site/css/`, `site/js/`, `site/images/`, `site/fonts/` — public assets.
- `site/favicon.svg`, `site/robots.txt`, `site/.nojekyll`.

All asset and canonical URLs use the supplied base URL. If you rename the repository or move to another host, re-export with the new URL. Leaving the old base URL is the most common cause of a site with no CSS.

## 5. Updating after a repository rename

If `portofolio` is renamed to `portfolio`:

```bash
git remote set-url origin https://github.com/Bisminee/portfolio.git
php artisan portfolio:export --base-url=https://bisminee.github.io/portfolio/
git add site
git commit -m "Update base URL after repository rename"
git push
```

Then re-check **Settings → Pages**. GitHub normally keeps the old URL redirecting, but the generated HTML must use the new base URL.

## 6. Troubleshooting

| Symptom | Cause | Fix |
| --- | --- | --- |
| Page has no CSS or fonts | Wrong `--base-url` during export | Re-export with the exact Pages URL including `/portofolio/` |
| 404 on every page except `/` | Pages source is not “GitHub Actions” | Settings → Pages → Source → GitHub Actions |
| Workflow fails at upload | `site/index.html` missing | Run the export locally, commit `site/`, push |
| Workflow permission error | Pages not enabled, or token permissions | Enable Pages; keep `pages: write` and `id-token: write` in the workflow |
| Old content still live | Forgot to re-export | Run `portfolio:export`, commit `site/`, push |
| Beyond Code still empty | No visible entry saved in studio | Add one, export, commit, push |
| Links use `http://127.0.0.1:8000` | Exported without `--base-url` | Re-export with the production URL |
| Custom 404 not used | `site/404.html` missing or Pages not deployed | Check the file and the workflow run |
| Studio URL 404 online | Expected — the static site has no PHP | Use the studio locally |

Check the workflow log under **Actions → Deploy static portfolio to GitHub Pages**.

## 7. Alternatives

### Netlify — free static hosting

Netlify’s free tier can host the same `site/` folder:

1. Run the export with your Netlify URL, for example:
   `php artisan portfolio:export --base-url=https://YOUR-SITE.netlify.app/`
2. Go to <https://app.netlify.com/drop> and drag the `site` folder onto the page.
3. Or connect the repository and set **Publish directory** to `site`, with no build command.

Free subdomain: `YOUR-SITE.netlify.app`. A custom domain is optional and normally paid.

### Cloudflare Pages — free static hosting

Use the same exported `site/` directory. Cloudflare Pages supports direct upload or Git integration, with a free `*.pages.dev` subdomain. Re-export with the final base URL.

### Vercel — free static hosting

Create a project and upload/deploy the `site/` folder as a static site. Free `*.vercel.app` subdomain. Re-export with the final base URL.

### Render — no longer a free web-service option

Render’s free web-service tier is not available as a reliable free target. The included `Dockerfile` can still be used on a paid Docker host or for self-hosting, but it is no longer the recommended deployment path. No Render Blueprint is included.

### If you need the Filament studio online

That requires a PHP host with persistent storage (and usually a database). This project does not configure a free PHP host because free PHP tiers are restrictive, often ad-supported, and not guaranteed to support Laravel 12 + Filament 4. A small paid PHP host or VPS is the honest option. The static GitHub Pages deployment is the free path.

## 8. Rollback

GitHub Pages deployments are recorded under **Actions**. Re-run an older successful deployment, or revert the `site/` change:

```bash
git revert <commit>
git push
```

If only content changed, revert the `site/` commit and re-deploy.
