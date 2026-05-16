<?php
/* Template Name: Каталог сортов картофеля */
get_header();

$page_id = get_the_ID();
$page_url = get_permalink($page_id);
$category_slug = 'sorta-kartofelya';
$selected = (array) ($_GET['variety_tag'] ?? []);
$paged = max(1, (int) ($_GET['pagenum'] ?? 1));

// Счётчик просмотров – только если нет фильтров и не пагинация
if (empty($_GET['variety_tag']) && empty($_GET['pagenum'])) {
    $views = (int) get_post_meta($page_id, 'td_post_views_count', true);
    update_post_meta($page_id, 'td_post_views_count', $views + 1);
}
$current_views = number_format(get_post_meta($page_id, 'td_post_views_count', true) ?: 0);

$category = get_term_by('slug', $category_slug, 'category');
if (!$category) { echo '<p>Категория не найдена.</p>'; get_footer(); return; }

$args = [
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged,
    'cat' => $category->term_id,
];
if ($selected) {
    $args['tax_query'] = [['taxonomy' => 'variety_tags', 'field' => 'slug', 'terms' => $selected, 'operator' => 'AND']];
}
$query = new WP_Query($args);
$total = $query->max_num_pages;

function tag_url($url, $selected, $add = null, $remove = null) {
    $new = $selected;
    if ($add && !in_array($add, $new)) $new[] = $add;
    if ($remove) $new = array_diff($new, [$remove]);
    return add_query_arg(array_filter(['variety_tag' => $new, 'pagenum' => 1]), $url);
}
?>

<div class="catalog">
    <div class="views-count">👁️ <?= $current_views ?></div>
    
    <div class="tags">
        <a href="<?= esc_url(remove_query_arg(['variety_tag','pagenum'], $page_url)) ?>" class="tag-btn <?= empty($selected) ? 'active' : '' ?>">Все сорта</a>
        <?php foreach (get_terms('variety_tags', ['hide_empty'=>false]) as $tag) :
            $active = in_array($tag->slug, $selected);
            $url = $active ? tag_url($page_url, $selected, null, $tag->slug) : tag_url($page_url, $selected, $tag->slug);
        ?>
            <a href="<?= esc_url($url) ?>" class="tag-btn <?= $active ? 'active' : '' ?>" data-text="<?= esc_attr($tag->name) ?>"><?= esc_html($tag->name) ?></a>
        <?php endforeach; ?>
        <?php if ($selected) : ?>
            <a href="<?= esc_url(remove_query_arg(['variety_tag','pagenum'], $page_url)) ?>" class="tag-btn reset-btn">Сбросить 🥔</a>
        <?php endif; ?>
    </div>

    <div class="grid">
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <a href="<?= get_permalink() ?>" class="card">
                <?= has_post_thumbnail() ? get_the_post_thumbnail(null, 'medium') : '' ?>
                <h3><?= get_the_title() ?></h3>
            </a>
        <?php endwhile; else : ?>
            <p>Сортов не найдено.</p>
        <?php endif; ?>
    </div>

    <?php if ($query->have_posts() && $total > 1) : ?>
        <div class="pagination">
            <?php if ($paged > 1) : ?>
                <a href="<?= esc_url(add_query_arg(['variety_tag'=>$selected, 'pagenum'=>$paged-1], $page_url)) ?>" class="prev">« Назад</a>
            <?php endif; ?>
            <?php for ($i=1; $i<=$total; $i++) : ?>
                <?php if ($i == $paged) : ?>
                    <span class="current"><?= $i ?></span>
                <?php else : ?>
                    <a href="<?= esc_url(add_query_arg(['variety_tag'=>$selected, 'pagenum'=>$i], $page_url)) ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($paged < $total) : ?>
                <a href="<?= esc_url(add_query_arg(['variety_tag'=>$selected, 'pagenum'=>$paged+1], $page_url)) ?>" class="next">Вперед »</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>

<!-- Реклама -->
<div class="ad-block">
    <div id="yandex_rtb_R-A-1429219-16"></div>
    <script>window.yaContextCb.push(() => Ya.Context.AdvManager.render({blockId:"R-A-1429219-16",renderTo:"yandex_rtb_R-A-1429219-16"}))</script>
</div>

<!-- Текст (только на 1й странице) с правильными карточками кулинарных типов -->
<?php if ($paged == 1) : ?>
    <div class="content-text">
        <?php while (have_posts()) : the_post();
            $adaptive_html = '
            <div class="adaptive-table">
                <h4>Кулинарные типы картофеля</h4>
                <div class="cards-container">
                    <div class="type-card"><div class="type-title">Тип A</div><div class="type-desc">Салатный картофель</div><ul><li><strong>Разваримость:</strong> не разваривается</li><li><strong>Консистенция:</strong> плотная</li><li><strong>Мучнистость:</strong> отсутствует</li><li><strong>Водянистость:</strong> водянистая</li></ul></div>
                    <div class="type-card"><div class="type-title">Тип B</div><div class="type-desc">Отваренный, супы, поджаривания</div><ul><li><strong>Разваримость:</strong> слабо разваривается</li><li><strong>Консистенция:</strong> умеренно плотная</li><li><strong>Мучнистость:</strong> слабомучнистый</li><li><strong>Водянистость:</strong> умеренно водянистая</li></ul></div>
                    <div class="type-card"><div class="type-title">Тип C</div><div class="type-desc">Отваренный, пюре</div><ul><li><strong>Разваримость:</strong> сильно разваривается</li><li><strong>Консистенция:</strong> мягкая</li><li><strong>Мучнистость:</strong> умеренно мучнистый</li><li><strong>Водянистость:</strong> слабо водянистая</li></ul></div>
                    <div class="type-card"><div class="type-title">Тип D</div><div class="type-desc">Отваренный, пюре, для запекания</div><ul><li><strong>Разваримость:</strong> очень сильно разваривается</li><li><strong>Консистенция:</strong> мягкая</li><li><strong>Мучнистость:</strong> очень мучнистый</li><li><strong>Водянистость:</strong> не водянистая</li></ul></div>
                </div>
            </div>';
            echo preg_replace('/<table[^>]*>.*?<\/table>/s', $adaptive_html, apply_filters('the_content', get_the_content()));
        endwhile; ?>
    </div>
<?php endif; ?>

<!-- Комментарии по центру -->
<div class="comments-wrapper">
    <?php if (comments_open() || get_comments_number()) comments_template(); ?>
</div>

<style>
.catalog{max-width:1200px;margin:0 auto 40px}
.views-count{text-align:center;font-size:14px;color:#666;margin-bottom:10px;font-weight:500}
.tags{display:flex;gap:10px;margin:0 0 30px;flex-wrap:wrap;justify-content:center}
.tag-btn{background:#f0f0f0;border:none;padding:6px 14px;border-radius:30px;font-size:13px;text-decoration:none;color:#333;transition:.2s}
.tag-btn:hover{background:#e0e0e0}
.tag-btn.active{background:#d2b48c;color:#fff}
.reset-btn{background:#ffe6a3;color:#5c3a00;font-weight:bold}
.reset-btn:hover{background:#ffd966}

/* Уменьшенные карточки (минус 20%) и выравнивание */
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:15px;margin-bottom:30px}
@media(max-width:600px){.grid{grid-template-columns:repeat(2,1fr);gap:10px}}
.card{
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    border:1px solid #ddd;
    border-radius:8px;
    padding:6px;
    text-align:center;
    background:#fff;
    text-decoration:none;
    color:inherit;
    transition:.2s;
    height:100%;
}
.card:hover{transform:translateY(-3px);box-shadow:0 4px 10px rgba(0,0,0,0.1)}
.card img{max-width:100%;height:auto;border-radius:5px}
.card h3{
    margin:8px 0 4px;
    font-size:13px;
    font-weight:500;
    line-height:1.3;
    min-height:2.6em;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
}

.pagination{text-align:center;margin:20px 0}
.pagination a,.pagination span{display:inline-block;min-width:34px;height:34px;line-height:34px;margin:0 4px;border-radius:50%;border:1px solid #ddd;background:#fff;text-decoration:none;color:#333;font-size:14px;padding:0}
.pagination .current{background:#2c7a3e;color:#fff;border-color:#2c7a3e}
.pagination a.prev,.pagination a.next{border-radius:30px;padding:0 12px;min-width:auto}
.ad-block{max-width:1200px;margin:20px auto;text-align:center}
.content-text{max-width:1200px;margin:20px auto;padding:20px;background:#f9f9f9;border-radius:8px}
.adaptive-table h4{text-align:center;margin-bottom:20px}
.cards-container{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px}
.type-card{background:#fff;border:1px solid #ddd;border-radius:12px;padding:16px;box-shadow:0 2px 6px rgba(0,0,0,0.05);transition:.2s}
.type-card:hover{transform:translateY(-4px);box-shadow:0 6px 12px rgba(0,0,0,0.1)}
.type-title{font-size:1.4rem;font-weight:bold;color:#2c7a3e;border-bottom:2px solid #2c7a3e;display:inline-block;margin-bottom:8px}
.type-desc{font-size:0.9rem;color:#555;margin-bottom:12px;font-style:italic}
.type-card ul{margin:0;padding-left:20px}
.type-card li{margin-bottom:8px;font-size:0.9rem}
@media(max-width:600px){.type-card{padding:12px}.type-title{font-size:1.2rem}.type-desc,.type-card li{font-size:0.85rem}}
.comments-wrapper{max-width:800px;margin:40px auto;padding:20px;background:#fff;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.1)}
</style>

<script>
if(window.history.replaceState) window.history.replaceState(null,null,location.href);
function getColor(t){
    let s=t.toLowerCase();
    if(s.includes('мякоть светло-жёлтая')) return '#ffe0a3';
    if(s.includes('кожура светло-розовая')) return '#f5c6cb';
    if(s.includes('красная')) return '#e74c3c';
    if(s.includes('кромовая')) return '#c9a87c';
    if(s.includes('фиолетов')) return '#9b59b6';
    if(s.includes('жёлт')||s.includes('желт')) return '#f1c40f';
    return '#d2b48c';
}
document.querySelectorAll('.tag-btn.active').forEach(btn => btn.style.backgroundColor = getColor(btn.dataset.text||''));
</script>

<?php get_footer(); ?>