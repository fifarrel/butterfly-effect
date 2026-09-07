# Butterfly Effect Theme — Treatment Pages (SEO)

## What changed

Each treatment on the Treatments menu now has its own page instead of linking
straight out to Versum. `page-treatments.php` shows a heading + a short
one-line description for every treatment; clicking the heading navigates to
that treatment's own page (full description, price, and a "Book Now" link
into Versum).

Category headers that just group several treatments together (e.g. *Skin
Therapies*, *Hair Removal*, *PMU & Tattoo Removal*, *Hands & Feet*, *Body
Treatments*) are **not** clickable pages themselves — they stay as section
headers, and each treatment listed underneath them links to its own page.

*Deposit*, *Special Offers* and *Price List* are not treatments, so they were
left as-is, linking straight out to Versum.

All new pages share one layout, defined once in
`template-parts/treatment.php`, so the look stays consistent — edit that file
to change the design of every treatment page at once. Each individual
`page-{slug}.php` file just supplies that treatment's title, description,
price and booking link.

SEO `<title>` and meta description for every page are set centrally in
`functions.php` inside `butterfly_seo_page_data()`, keyed by the page slug.

## Missing content

Nowhere on the current Treatments page is a price listed for any treatment,
so **every price below is a placeholder (`XXX`)** — these need real prices
before launch. A number of treatments also have no description at all on the
current site; those are marked `XXX` too. Search each `page-{slug}.php` file
and the matching entry in `functions.php` for `XXX` and fill in real copy —
whoever owns treatment pricing/content should do this by hand.

## Routing: no WordPress Pages needed

Normally a `page-{slug}.php` file only gets used once an actual WordPress
Page with that slug exists in the database (that's why the pre-existing
pages like `pmu`, `microblading`, `about-us`, etc. worked without any theme
changes — those Pages were already created beforehand).

These 29 treatment URLs are different: they're **virtual pages**, routed
entirely from code in `functions.php` (`butterfly_treatment_slugs()`,
`butterfly_treatment_add_rewrite_rules()` and `butterfly_treatment_template()`).
Each slug is mapped straight to its `page-{slug}.php` file via a rewrite
rule — no Page needs to be created in wp-admin at all. The rewrite rules
flush themselves automatically on the first page load after this code is
deployed (tracked via the `butterfly_treatment_rules_version` option), so
the URLs work immediately without any manual step.

If a URL still 404s after deploying (e.g. a caching layer served a stale
response before the flush ran), visiting **Settings → Permalinks** in
wp-admin and clicking **Save Changes** once will force it.

To add another treatment later: create `page-{new-slug}.php` in this theme
folder, add `'new-slug'` to the array in `butterfly_treatment_slugs()`, and
bump the version string in `butterfly_treatment_maybe_flush_rewrite_rules()`
(e.g. `'1'` → `'2'`) so the new rule gets flushed in on the next page load.

| Page title | URL slug | Template file |
|---|---|---|
| Korean Skincare | `/korean-skincare/` | `page-korean-skincare.php` |
| Image Skincare | `/image-skincare/` | `page-image-skincare.php` |
| Essencial Skincare | `/essencial-skincare/` | `page-essencial-skincare.php` |
| Aesthetic Medicine | `/aesthetic-medicine/` | `page-aesthetic-medicine.php` |
| Hair Treatments | `/hair-treatments/` | `page-hair-treatments.php` |
| Hydrating & Plumping | `/hydrating-plumping/` | `page-hydrating-plumping.php` |
| Supportive & Restorative Care | `/supportive-restorative-care/` | `page-supportive-restorative-care.php` |
| Rejuvenation & Anti-Ageing | `/rejuvenation-anti-ageing/` | `page-rejuvenation-anti-ageing.php` |
| Redness Relief | `/redness-relief/` | `page-redness-relief.php` |
| Anti Acne | `/anti-acne/` | `page-anti-acne.php` |
| Depigmentation | `/depigmentation/` | `page-depigmentation.php` |
| Male Skincare | `/male-skincare/` | `page-male-skincare.php` |
| SHR | `/shr/` | `page-shr.php` |
| Waxing | `/waxing/` | `page-waxing.php` |
| Laser PMU & Tattoo Removal | `/laser-pmu-tattoo-removal/` | `page-laser-pmu-tattoo-removal.php` |
| PMU Remover | `/pmu-remover/` | `page-pmu-remover.php` |
| EMS Chair | `/ems-chair/` | `page-ems-chair.php` |
| Eye Treatments | `/eye-treatments/` | `page-eye-treatments.php` |
| Hands | `/hands/` | `page-hands.php` |
| Feet | `/feet/` | `page-feet.php` |
| Massage | `/massage/` | `page-massage.php` |
| Body Scrub | `/body-scrub/` | `page-body-scrub.php` |
| Makeup | `/makeup/` | `page-makeup.php` |
| Laser | `/laser/` | `page-laser.php` |
| Mesotherapy | `/mesotherapy/` | `page-mesotherapy.php` |
| For Your Face | `/for-your-face/` | `page-for-your-face.php` |
| Tanning | `/tanning/` | `page-tanning.php` |
| For Your Smooth Skin | `/for-your-smooth-skin/` | `page-for-your-smooth-skin.php` |
| IPL Skin Rejuvenation | `/ipl-skin-rejuvenation/` | `page-ipl-skin-rejuvenation.php` |

### Already referenced, not part of this batch

`page-treatments.php` also links to `/permanent-makeup/` (item 08, Permanent
Make Up) — that link already existed before this change. Confirm a
`permanent-makeup` Page exists; if not, it needs to be created too, but no
`page-permanent-makeup.php` template was added here since it was already
wired up separately.
