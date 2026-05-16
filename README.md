# Potato Variety Catalog for WordPress

A responsive catalog with multi-tag selection, pagination, view counter, comments, and ads. Built as a page template for the Newspaper theme, but easily adaptable to any WordPress theme.

## Features
- Multi-tag selection (AND filtering) via GET parameters.
- Pagination with round buttons.
- View counter – only increments on the main catalog page (filters are ignored).
- Centered comment section.
- Yandex.RTB ad block (feed format).
- Adaptive culinary type cards instead of a table.
- Color highlighting for active tags (red, purple, yellow, light pink, creamy).
- "Reset" button with a potato emoji.

## Installation
1. Copy the `page-potato-catalog.php` file into your WordPress theme folder.
2. Add the following to `functions.php`:
   - Register the `variety_tags` taxonomy (variety tags);
   - The Yandex.RTB loader script in `<head>`.
3. Create a new page and assign it the template "Potato Variety Catalog".
4. Make sure a category with the slug `sorta-kartofelya` exists and contains posts with tags.

## Requirements
- WordPress 5.0+
- PHP 7.4+
- Active theme (Newspaper recommended, but works with any)
- Yandex.RTB (ad block – optional)

## Author
Your name / GitHub account

## License
MIT
