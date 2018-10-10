<?php

// Custom header
add_theme_support(
  'custom-header',
  array(
    'width' => 950,
    'height' => 295,
    'header-text' => false,
    'default-image' => '%s/images/top/main_image.png',
  )
);

// Custom menu
register_nav_menus(
  array(
    'place_global' => 'グローバル',
    'place_utility' => 'ユーティリティ',
  )
);

// Activate featured image
add_theme_support('post-thumbnails');

// Set featured image size
set_post_thumbnail_size(90, 90, true);

// Set sidebar image size
add_image_size('small_thumbnail', 61, 61, true);

// Set archive image size
add_image_size('large_thumbnail', 120, 120, true);

// Set sub-page header image size
add_image_size('category_image', 658, 113, true);

// Set sub-page header image size
add_image_size('pickup_thumbnail', 302, 123, true);

 ?>
