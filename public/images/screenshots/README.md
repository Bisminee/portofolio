# Screenshot slots

The portfolio currently uses **original illustrations**, clearly labelled “Illustration · not a screenshot”. Replace them with genuine application captures when available.

## Required files

Save real captures here with these exact names (WebP preferred, 4:3, 1600 × 1200 px, under 250 KB each):

| File | Project | Suggested content |
| --- | --- | --- |
| `pos-tahu-morojoyo-dashboard.webp` | POS Tahu Morojoyo | Owner dashboard / Filament admin |
| `pos-tahu-morojoyo-cashier.webp` | POS Tahu Morojoyo | Cashier POS after attendance check-in |
| `sera-z-home.webp` | Sera-Z | App home screen with wardrobe items |
| `sera-z-capture.webp` | Sera-Z | Camera / garment capture flow |
| `flutter-lab-before.webp` | Flutter Architecture Lab | Before-refactor structure or screen |
| `flutter-lab-after.webp` | Flutter Architecture Lab | After-refactor screen or test output |
| `ml-notebook.webp` | Machine Learning Practicals | Executed notebook with a chart |
| `java-lab-terminal.webp` | Java Data Structures Lab | Terminal output / queue simulation |

Optional:

- `hero-portrait.webp` — a real photograph or commissioned portrait, 900 × 1125 px. Do not use an AI-generated realistic likeness of the owner.
- `sera-z-logo.webp` — only if the team approves publishing the project mark.

## How to replace an illustration

1. Put the file in `public/images/screenshots/`.
2. Open `/studio` → **Case files** → select the project.
3. Set **Artwork path** to `images/screenshots/your-file.webp`.
4. Change **Artwork type** from `Illustration` to `Screenshot`.
5. Rewrite **Artwork alt text** to describe what the screenshot actually shows, for example: “Filament dashboard showing branch stock and daily sales for POS Tahu Morojoyo.”
6. Save and reload the home page.

The badge and caption change automatically based on the artwork type.

## Alt text rules

- Describe the content, not the filename.
- Do not start with “image of” or “screenshot of”.
- Mention the application and the specific state when useful.
- Keep it under ~160 characters.
- Never claim a feature is visible if it is not in the capture.

## Current asset inventory

| Asset | Path | Status |
| --- | --- | --- |
| Hero ink portrait | `public/images/hero-portrait.svg` | Original, included |
| POS illustration | `public/images/project-pos.svg` | Original, included |
| Sera-Z illustration | `public/images/project-sera-z.svg` | Original, included |
| Flutter lab illustration | `public/images/project-mobile-lab.svg` | Original, included |
| ML illustration | `public/images/project-ml.svg` | Original, included |
| Java lab illustration | `public/images/project-asd.svg` | Original, included |
| Generic fallback | `public/images/project-placeholder.svg` | Original, included |
| Social card source | `public/images/og-cover.svg` | Original, included |
| Social card | `public/images/og-cover.png` | 1200 × 630, included |
| Favicon | `public/favicon.svg` | Original, included |
| Fonts | `public/fonts/*.woff2` | Google Fonts, OFL |

## Licensing

- Illustrations: created specifically for this portfolio. No comic characters, film stills, traced artwork, or trademarked logos.
- Fonts: Anton, Cinzel, Lora, and JetBrains Mono via Google Fonts, SIL Open Font License.
- Screenshots you add: ensure they contain no customer names, emails, API keys, private repository data, or personal information from commit metadata. Blur or crop sensitive areas before uploading.

If you commission artwork, record the licence and attribution here.
