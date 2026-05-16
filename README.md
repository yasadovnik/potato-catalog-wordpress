<img width="1369" height="627" alt="Potato Variety Catalog" src="https://github.com/user-attachments/assets/0958f1ea-95c8-4bde-9c9d-e7e8fd990824" />
A responsive WordPress page template that allows users to filter potato varieties by multiple tags (AND logic), with pagination, view counter, comments, and integrated Yandex ads.

## Files included

- `page-potato-catalog.php` – the main template file.
- `functions-additions.php` – code to be added to your theme's `functions.php`.

## Features

- Multi‑tag filtering (AND) via GET parameters.
- Pagination with round buttons.
- View counter (only for main catalog page, ignoring filters).
- Centered comment section.
- Yandex.RTB ad block (feed format).
- Adaptive culinary type cards instead of a table.
- Color highlighting for active tags (red, purple, yellow, light pink, creamy).
- "Reset" button with a potato emoji.

## Requirements

- WordPress 5.0+
- PHP 7.4+
- Any active theme (works with Newspaper and most others)
- Yandex.RTB account (optional)

## Installation

### 1. Upload the template file
Copy `page-potato-catalog.php` to your WordPress theme folder:  
`/wp-content/themes/your-theme/`

### 2. Add functions support
Open your theme's `functions.php` file. At the very end, paste the entire content of `functions-additions.php`.  
If your theme already has a closing `?>`, place the code before it.

### 3. Create a page
- In WordPress admin, go to **Pages → Add New**.
- Give it a title (e.g., "Potato Catalog").
- In the **Page Attributes** sidebar, select the template **Potato Varieties Catalog**.
- Publish the page.

### 4. Prepare content
- Create a category with slug `sorta-kartofelya` (or change the `$category_slug` variable inside `page-potato-catalog.php`).
- Add posts (potato varieties) to that category.
- Assign tags from the `Variety Tags` taxonomy to each post (you can create tags on the fly when editing a post).

### 5. (Optional) Enable comments
Edit the catalog page, find the **Discussion** box, and check **Allow Comments**. If you don't see it, enable it via "Screen Options" at the top right.

### 6. Clear cache
If you use a caching plugin, flush its cache.

## Customization

- **Number of cards per page** – edit `'posts_per_page' => 5` in `page-potato-catalog.php`.
- **Colors of active tags** – modify the `getColor()` JavaScript function or the CSS.
- **Remove Yandex ads** – delete the `<div class="ad-block">` section from the template.
- **Change category slug** – update `$category_slug = 'sorta-kartofelya'` to your own.

## License

MIT
