# Potato Variety Catalog – WordPress Page Template

A responsive WordPress page template that allows users to filter potato varieties by multiple tags (AND logic), with pagination, view counter, comments, and integrated Yandex ads.

## Features

- **Multi‑tag filtering** – users can combine several criteria (e.g., skin color + maturity group).
- **AND logic** – only varieties matching **all** selected tags are shown.
- **Clean URL parameters** – `?variety_tag[]=red&variety_tag[]=early`.
- **Server‑side pagination** with round buttons.
- **View counter** – increments only on the main catalog page (ignores filters/pagination).
- **Responsive grid** – 5 cards per row on desktop, 2 cards on mobile.
- **Yandex ad block** (optional, feed format).
- **Culinary types** – displayed as adaptive cards instead of a table.
- **Active tag colors** – red, purple, yellow, creamy, light pink.
- **Reset button** with a potato emoji.
- **Comment section** – centered below the catalog.

## Requirements

- WordPress 5.0+
- PHP 7.4+
- Any active theme (works best with Newspaper, but compatible with all)
- Yandex.RTB account (optional, remove ad block if not needed)

## Installation

### 1. Upload the template file
Copy `page-potato-catalog.php` to your WordPress theme folder:  
`/wp-content/themes/your-theme/`

### 2. Add required functions to your theme
Open your theme's `functions.php` file and **append** the entire content of `functions-additions.php` to the end.  
Do **not** replace your existing `functions.php` – just add the new code at the bottom.

### 3. Create a page with the template
- Go to **Pages → Add New** in WordPress admin.
- Set the title (e.g., "Potato Catalog").
- In the **Page Attributes** box, select **Potato Varieties Catalog** as the template.
- Publish the page.

### 4. Prepare content
- Create a category with slug `sorta-kartofelya` (or change the `$category_slug` variable in the template).
- Add posts (potato varieties) to that category.
- Assign tags from the **Variety Tags** taxonomy to each post (you can create them on the fly).

### 5. Optional: enable comments
Edit the catalog page, check **Allow Comments** under Discussion settings.

### 6. Clear cache
If you use a caching plugin, flush its cache.

## Customization

- **Change cards per page** – edit `'posts_per_page' => 5` in `$args` inside `page-potato-catalog.php`.
- **Modify colors** – adjust the `getColor()` function in JavaScript and the CSS rules.
- **Replace ad block** – change the Yandex block ID or remove the `<div class="ad-block">` section.
- **Change category slug** – update `$category_slug = 'sorta-kartofelya'` to your own.

## Folder Structure for GitHub
