<?php
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('mytheme-style', get_stylesheet_uri(), [], '1.0.0');
});

// [show_items] → 顯示資料表資料
add_shortcode('show_items', function ($atts) {
    global $wpdb;

    // 假設你的資料表叫 my_items（若用 WP 建表，建議用 $wpdb->prefix . 'my_items'）
    $table = $wpdb->prefix . 'my_items';  // 例如 wp_my_items

    // 取回想顯示的欄位（請依你的表改欄位名稱）
    $rows = $wpdb->get_results("SELECT id, name FROM {$table} ORDER BY id DESC LIMIT 20");

    if (!$rows) {
        return '<p>目前沒有資料。</p>';
    }

    $html = '<ul>';
    foreach ($rows as $r) {
        $html .= '<li>' . esc_html($r->id) . ' — ' . esc_html($r->name) . '</li>';
    }
    $html .= '</ul>';

    return $html;
});