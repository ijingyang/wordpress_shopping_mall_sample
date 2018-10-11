# WordPressメモ


## 有効化されているテーマのディレクトリ内style.cssを取得
```php
<?php bloginfo('stylesheet_url'); ?>
```


## index.phpがあるディレクトリのURLを取得
```php
<?php bloginfo('template_url'); ?>
```


## index.phpと同じ階層にあるheader.phpを取得
```php
<?php get_header(); ?>
```


## index.phpと同じ階層にあるheader.phpを取得
```php
<?php get_footer(); ?>
```


## index.phpと同じ階層にあるsidebar-top.phpを取得

(ハイフン以降の文字列を引数に充てる模様)
```php
<?php get_sidebar('top'); ?>
```


## 上記の関数たちは・・・
```php
<?php get_template_part('ファイル名'); ?>
```
で置き換えることも可能


## サイトのtitleを出力
```php
<title><?php bloginfo('name'); ?></title>
```


## General Settingsで設定するキャッチフレーズ(Tagline)を取得
```php
<h1><?php bloginfo('discription') ?></h1>
```


## WPのメタタグ、JSなどを読み込むために必要
ツールバーも現れる
```php
<?php wp_head(); ?>
<?php wp_footer(); ?>
```


## トップページへのリンクを取得
```php
<a href="<?php echo home_url('/'); ?>">
```


## カスタムヘッダーを管理画面に追加する

```php
functions.php

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
```


## カスタムヘッダーの画像とfunctions.phpの設定を取得
```php
header.php

<img src="<?php header_image(); ?>"
 width="<?php echo get_custom_header()->width; ?>"
 height="<?php echo get_custom_header()->height; ?>" alt="" />
```


## WPループにより、固定ページのタイトルと記事を表示

```php
page.php

<?php
  if(have_posts()): //記事があるか判定
    while(have_posts()):
      the_post();
?>
<article>
  <header class="page-header">
    <h1 class="page-title">
      <?php the_title(); ?> //ループ内で記事のタイトルを表示
    </h1>
  </header>
  <section class="entry-content">
    <?php the_content(); ?> //ループ内で記事のコンテンツを表示
  </section>
</article>
<?php
    endwhile;
  endif;
 ?>
```


## ページ識別、IDに応じたクラスを出力するテンプレートタグ

```php
header.php

<body <?php body_class(); ?>>
```


## トップページの場合のみ表示

```php
front-page.php

<?php
  if(is_front_page()) :
 ?>
<section id="branding">
  <img src="<?php header_image(); ?>"
   width="<?php echo get_custom_header()->width; ?>"
   height="<?php echo get_custom_header()->height; ?>" alt="" />
</section><!-- #branding end -->
<?php
  endif;
?>
```


## カスタムメニューを追加（Apperanceから確認可能）

```php
functions.php

// Custom menu
register_nav_menus(
  array(
    'place_global' => 'グローバル',
    'place_utility' => 'ユーティリティ',
  )
);
```


## カスタムメニューを表示

```php
header.php

<?php
  wp_nav_menu(arrary(
    'container' => 'nav', // 出力されるulをnavでラップ
    'container_id' => 'utility_nav', // ラップするnavのid属性
    'theme_location' => 'place_utility', //テーマの場所
  ));
 ?>
```


## Postのページはsingle.phpに該当
## Pageのページはpage.phpに該当
## 投稿一覧のページはarchive.phpに該当

## 現在のカテゴリー名を出力するテンプレートタグ

```php
<?php single_cat_title(); ?>
```


## content-archive.php

```php
<article <?php post_class(); ?>> // 投稿に関するクラスを出力
  <header class="entry-header">
    <time pubdate="pudate" datetime="<?php the_time('Y-m-d'); ?>" //記事が投稿ないし更新された時間を出力
      class="entry-date">
      <?php the_time(get_option('date-format')); ?> // 設定->一般の日付フォーマットを取得
    </time>
    <h1 class="entry-title">
      <a href="<?php the_permalink(); ?>"> // 該当記事のパーマリンクを出力
        <?php the_title(); ?>
      </a>
    </h1>
  </header>
  <section class="entry-content">
    <?php the_excerpt(); ?>
  </section>
</article>
```


## アイキャッチ画像の利用とサイズ指定

```php
functions.php

// Activate featured image
add_theme_support('post-thumbnails');

// Set featured image size
set_post_thumbnail_size(90, 90, true);
```


## 画像のサイズ指定

```php
functions.php

// Set sidebar image size
add_image_size('small_thumbnail', 61, 61, true);
```


## サムネイル画像を投稿一覧に表示させる

```php
content-archive.php

<?php the_post_thumbnail('large_thumbnail', //アイキャッチ用のimageタグを出力
array(
  'alt' => the_title_attribute('echo=0'), // alt属性に該当記事のタイトルを付与
  'title' => the_title_attribute('echo=0') // title属性に該当記事のタイトルを付与
));
```


## トップページに特定の固定ページサムネイルを表示

```php
front-page.php

$mall_posts = new WP_Query('post_per_page=-1&post_type=page&orderby=menu_order&order=asc&post_parent=45');
if($mall_posts->have_posts()):
  $count = 1;
  while ($mall_posts->have_posts()):
    $mall_posts->the_post();
    if($count % 2 > 0 && $count != 1):
?>
</div><!-- .malls-group end -->
<div class="malls-group">
<?php
endif;
?>
<article>
<h1>
  <a href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
  </a>
</h1>
<a href="<?php the_permalink(); ?>">
  <?php the_post_thumbnail(
    'pickup_thumbnail',
    array(
      'alt' => the_title_attribute('echo=0'),
      'title' => the_title_attribute('echo=0')
    ));
  ?>
</a>
<?php the_excerpt(); ?>

<div class="continue-button">
  <a href="<?php the_permalink(); ?>">詳しく見る</a>
</div>
</article>
<?php
    $count++;
  endwhile;
endif;
wp_reset_postdata();
?>

```


## コラムカテゴリのパーマリンクを表示

```php
<?php echo get_term_link('column', 'category'); ?>
```


## サムネイル画像のサイズについて

```php
functions.php

set_post_thumbnail_size(90, 90, true);
```

functions.phpで設定した内容を使うには'post-thumbnail'を指定

```php
front-page.php

<?php the_post_thumbnail('post-thumbnail', // => $sizeを指定
array(
  'alt' => the_title_attribute('echo=0'),
  'title' => the_title_attribute('echo=0')
));
?>
```

参考
(set_post_thumbnail_sizeについて)[https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/set_post_thumbnail_size]


## カテゴリースラッグを引数にして、該当カテゴリの情報をオブジェクトとして取得

esc_htmlはHTMLブロックをエスケープする関数

```php
<?php echo esc_html(get_category_by_slug($sidebar_cat_name)); ?>
```

参考
https://elearn.jp/wpman/function/get_term_link.html


## 特定のプラグインにあてるCSSのディレクトリパスを差替え

```php
sidebar-top.php

// change URL path for CSS of Child Pages Shortcode
function change_child_pages_shortcode_css() {
  $url = get_template_directory_uri() . '/css/child-pages-shortcode/style.css';
  return $url;
}
add_filter('child-pages-shortcode-stylesheet', 'change_child_pages_shortcode_css');

```


## All in One Sub Navi Widgetの設定

```php
functions.php

register_sidebar(array(
  'name' => 'サイドバーウィジェットエリア（上）',
  'id' => 'primary-widget-area',
  'description' => 'サイドバー上部のウィジェットエリア',
  'before_widget' => '<aside id="%1$s" class="widget-container %2$s">', // %1$s => ウィジェットの名前、%2$s => ウィジェットのクラス名に置き換わる
  'after_widget' => '</aside>',
  'before_title' => '<h1 class="widget-title">',
  'after-title' => '</h1>',
));
```

```php
sidebar.php

<?php dynamic_sidebar('primary-widget-area') ?> // 上で指定したIDを引数に渡す
```

## パンくずリストをPrime Strategy Bread Crumbで実装

```php
header.php

<?php
  if(!is_front_page() && function_exists('bread_crumb')):
    bread_crumb('navi_element=nav&elm_id=bread-crumb');
  endif;
?>
```


## トップに戻るボタンを実装

```php
back_to_top.php

<aside id="back_to_top">
  <a href="#wrap" onclick="scrollup(); return false;">
    <img src="<?php bloginfo('template_url'); ?>/images/btn_back_to_top.png"
     alt="トップへ戻る" width="146" height="42">
  </a>
</aside>
```

```php
footer.php

<script src="<?php bloginfo('template_url'); ?>/js/scroll.js"></script>
```

```php
page.php, single.php, archive.php

<?php get_template_part('back_to_top'); ?>
```


## 作成者名の表示と作成者名別の一覧リンクを表示

```php
content-archive.php

<?php
  if(!is_search()):
 ?>
 <span class="author vcard">
   <?php the_author_posts_link(); ?>
 </span>
<?php endif; ?>
```


## タイトル表示の記述をする

```php
archive.php

<?php
  if(is_author()):
    echo esc_html(get_the_author_meta('display_name', get_query_var('author')));
  else:
    single_cat_title();
  endif;
?>
```


## Prime Strategy Page Naviを使ってページャーを設置

* ページャーとは、ページの下部にある1, 2, 3...のやつ

```php
if(function_exists('page_navi')):
  page_navi('elm_class=page-nav&edge_type=span');
endif;
```


## サイト内検索を動作させる

```php
header.php

<?php echo get_search_form(); ?>
```

```php
search.php

<?php get_header(); ?>
      <section id="contents">
        <header class="page-header">
          <h1 class="page-title">
            「<?php the_search_query(); ?>」の検索結果
          </h1>
        </header>
        <div class="posts">
          <?php
            if(have_posts() && get_search_query()):
              while(have_posts()):
                the_post();
                get_template_part('content-archive');
              endwhile;
              if(function_exists('page_navi')):
                page_navi('elm_class=page-nav&edge_type=span');
              endif;
            else:
          ?>
            <p>該当する記事が存在していません。</p>
          <?php
            endif;
           ?>
        </div>
        <?php get_template_part('back_to_top'); ?>
      </section><!-- #contents end -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
```


## 投稿ページ間のナビゲーションを実装

```php
content.php

<?php
  if(is_single()):
?>
<nav class="adjacent_post_links">
  <ul>
    <li class="previous">
      <?php previous_post_link('%link', '%title', true); ?>
    </li>
    <li class="next">
      <?php next_post_link('%link', '%title', true); ?>
    </li>
  </ul>
</nav>
<?php
  endif;
 ?>
```


## 抜粋分が自動的に生成される場合のデフォルト値などを変更

この機能は、WordPressの表示言語が日本語の場合のみ有効のため、
英語版などはべつのやり方を知っておく必要があるとおもわれる。

```php
functions.php

//抜粋分が自動的に生成される場合に最後に付与される文字列を変更
function cms_excerpt_more() {
  return ' ...';
}
add_filter('excerpt_more', 'cms_excerpt_more');


//抜粋分をが自動的に生成される場合にデフォルトの文字数を変更
function cms_excerpt_length() {
  return 120;
}
add_filter('excerpt_mblength', 'cms_excerpt_length');
```


## 抜粋分を固定ページの編集画面から入力できるようにする

```php
functions.php

add_post_type_support('page', 'excerpt');
```


## 30文字表示抜粋（自動生成時）表示テンプレートタグの定義

```php
functions.php

// 30文字表示抜粋（自動生成時）表示テンプレートタグの定義
function the_short_excerpt() {
  add_filter('excerpt_mblength', 'short_excerpt_length', 11);
  the_excerpt();
  remove_filter('excerpt_mblength', 'short_excerpt_length', 11);
}

function short_excerpt_length() {
  return 30;
}
```

```php
front-page.php, sidebar-top.php

<?php the_short_excerpt(); ?>
```


## 50文字表示抜粋（自動生成時）表示テンプレートタグの定義

```php
functions.php

// 50文字表示抜粋（自動生成時）表示テンプレートタグの定義
function the_pickup_excerpt() {
  add_filter('get_the_excerpt', 'get_pickup_excerpt', 0);
  add_filter('excerpt_mblength', 'pickup_excerpt_length', 11);
  the_excerpt();
  remove_filter('get_the_excerpt', 'get_pickup_excerpt', 0);
  remove_filter('excerpt_mblength', 'pickup_excerpt_length', 11);
}

// トップページのピックアップ（モール紹介）部分の抜粋文を切り詰める
function get_pickup_excerpt($excerpt){
  if($excerpt) {
    $excerpt = strip_tags($excerpt);
    $excerpt_len = mb_strlen($excerpt);
    if($excerpt_len > 50) {
      $excerpt = mb_substr($excerpt, 0, 50) . ' ...';
    }
  }
  return $excerpt;
}

function short_excerpt_length() {
  return 50;
}
```

```php
front-page.php

<?php the_pickup_excerpt(); ?>
```


## RSSのリンクを出力させる

```php
sidebar-top.php

<?php
  the_feed_link('<img src="' . get_template_directory_uri()
   . '/images/btn_rssfeed.png" width="250" height="28" alt="RSS" />');
 ?>
```

```php
sidebar.php

<?php
  if(is_category('column') || (is_single() && in_category('column'))) :
?>
<aside class="rss_link">
  <a href="<?php echo get_category_feed_link(get_category_by_slug('column')->term_id); ?>">
    <img src="<?php get_template_directory_uri(); ?>/images/btn_rss_feed.png" width="250" height="28" alt="RSS">
  </a>
</aside>
<?php endif; ?>
```


## サムネイル画像の使用判定および取得

```php
has_post_thumbnail() => サムネイル画像が使われているかを判定

$image = get_the_post_thumbnail(
          array_pop(get_post_ancestors($post)), 'category_image',
          array('id' => 'category_image'));　=> サムネイル画像のエレメントを取得
```

```php
functions.php

//カテゴリ画像の表示
// 1. アイキャッチ画像が設定されている場合は、アイキャッチ画像を使用
// 2. アイキャッチ画像が設定されていない固定ページで、
//　　 最上位の固定ページにアイキャッチ画像が設定されている場合は
//     そのアイキャッチ画像を使用
// 3. それ以外の場合は、デフォルトの画像を使用
function the_category_image() {
  global $post;
  $image = "";

  if(is_singular() && has_post_thumbnail()) {
    $image = get_the_post_thumbnail(null, 'category_image',
              array('id' => 'category_image'));
  } elseif (is_page() && has_post_thumbnail(array_pop(get_post_ancestors($post)))) {
    $image = get_the_post_thumbnail(
              array_pop(get_post_ancestors($post)), 'category_image',
              array('id' => 'category_image'));
  }

  if($image == "") {
    $src = get_template_directory_uri() . '/images/category/default.jpg';
    $image = '<img src="' . $src . '" class="attachment-category_image wp-post-image"
    alt="" id="category_image" />';
  }
  echo $image;
}
```

https://wpdocs.osdn.jp/%E3%83%86%E3%83%B3%E3%83%97%E3%83%AC%E3%83%BC%E3%83%88%E3%82%BF%E3%82%B0/get_the_post_thumbnail


## (SEO対策)タイトルを適切に表示させる

```php
header.php

<?php
  // $page -> 投稿や固定ページをマルチページ化したもの
  // $paged -> 一覧ページでのページ番号
  global $page, $paged;
  if(is_search()):
    wp_title('', true, 'left');
    echo ' | ';
  else:
    wp_title('|', true, 'right');
  endif;

  bloginfo('name');

  if(is_front_page()):
    echo ' | ';
    bloginfo('description');
  endif;

  if($paged >= 2 || $page >= 2):
    echo ' | ' . sprintf('%sページ', max($paged, $page));
  endif;

?>
```


## コラムにコメント欄を表示

```php
single.php

if (in_category('column')):
  comments_template('', true);
endif;
```


## コラムのみコメント可にする関数（要見直し）

なぜかコラムでもコメントできない・・・保留で

```php
functions.php

// コラムカテゴリーのみコメントできるようにする
// function comments_allow_only_column($post_id) {
//   $open = true;
//   if(!in_category('column')) {
//     $open = false;
//   }
//   return $open;
// }
// add_filter('comments_open', 'comments_allow_only_column', 10);
```


## コメントテンプレートの作成

```php
comments.php

<?php
  if(post_password_required()):
    return;
  endif;
 ?>

 <section id="comments">
  <?php
    if(have_comments()):
  ?>

  <h1 id="comments-title">
    <?php echo '「<em>' . get_the_title() . '</em> 」に'
     . get_comments_number() . '件のコメント'; ?>
  </h1>
  <ol class="commentlist">
    <?php wp_list_comments('avatar_size=40'); ?> // 実際のコメントを出力、アバターサイズは40px
  </ol>

  <?php
    if(get_comment_pages_count() > 1 && get_option('page_comments')): //コメントページがまたがる場合は、ページャーで分割
   ?>
   <nav class="navigation">
     <ul>
       <li class="nav-previous">
         <?php previous_comments_link('古いコメント'); ?> //古いコメントへのリンクを表示
       </li>
       <li class="nav-next">
         <?php next_comments_link('新しいコメント') ?> //新しいコメントへのリンクを表示
       </li>
     </ul>
   </nav>
   <?php
      endif;
    endif;
    ?>
    <?php comment_form(); ?> //コメントフォームを表示
 </section>
```


## はてなブックマークボタンを追加

```php
social-button.php

<ul class="social-buttons">
  <li>
    <a href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" class="hatena-bookmark-button"
    data-hatena-bookmark-layout="vertical-normal" data-hatena-bookmark-lang="ja"
    title="このエントリーをはてなブックマークに追加">
      <img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png"
      alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" />
    </a>
    <script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js"
    charset="utf-8" async="async"></script>
  </li>
</ul>

```

```php
content.php

<?php
  if(is_single() && in_category('column')) :
    get_template_part('social-button');
  endif;
?>
```

## Twitterボタンを設置

ここからコードをこぴぺ
https://publish.twitter.com/?buttonType=TweetButton&widget=Button


## facebookボタンの設置

こちらを参照
https://gaiax-socialmedialab.jp/qa/facebook-website-like/


## Open Graph Protocol(OGP)を追加

### OGPとは？

FacebookやGoogle+で使われている、プログラムにページの意味を理解させやすくするための追加情報
要はSEO対策のひとつ

https://cont-hub.com/knowledge/glossary/ogp/

```php
header_ogp.php

<meta property="fb:admins" content="155536861149885" />
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:locale" content="ja_JP" />
<?php
  if(has_post_thumbnail()):
?>
<meta property="og:image" content="<?php echo get_thumbnail_image_url(); ?>" />
<?php
  else:
?>
<meta property="og:image" content="<?php echo bloginfo('template_url'); ?>/images/fb_default_img.png" />
<?php
  endif;
?>
<meta property="og:description" content="<?php echo get_ogp_excerpted_content($post->post_content); ?>" />

```

```php
functions.php

// OGPのための各種設定
// アイキャッチ画像のURL取得
function get_thumbnail_image_url() {
  $image_id = get_post_thumbnail_id();
  $image_url = wp_get_attachment_image_src($img_id, 'large', true);
  return $img_url[0];
}

// OGP用Description取得
function get_ogp_excerpted_content($content) {
  $content = strip_tags($content);
  $content = mb_substr($content, 0, 120, 'UTF-8');
  $content = preg_replace('/\s\s+/', '', $content);
  $content = preg_replace('/[\r\n]/', '', $content);
  $content = esc_attr($content) . ' ...';
  return $content;
}
```

```php
header.php

<?php
  if(is_single() && in_category('column')):
    get_template_part('header_ogp');
  endif;
?>
```

FacebookのObject Debbugerで確認
https://developers.facebook.com/tools/debug/


## Facebookのページプラグインの設置

本格ビジネスサイトを作りながら学ぶWordPressの教科書 205P参照

参考
https://www.cloud9works.net/sns/facebook/setting-for-facebook-page-plugin/

## Facebookコメントを設置

本格ビジネスサイトを作りながら学ぶWordPressの教科書 207P参照

参考

https://lblevery.com/sfn/attract/facebook-page/facebook-comments/


## 他に使用したプラグイン

本格ビジネスサイトを作りながら学ぶWordPressの教科書

Akismet P209参照
google analyticator P217参照
Wordpress https P225参照


## Custom Post Type UI

本格ビジネスサイトを作りながら学ぶWordPressの教科書
P231~


## Custom Post Type UIで設定した店舗情報の表示

```php
functions.php

// モール開発実績各ページのshortcode
function posts_shortcode($args) {
  $template = dirname(__FILE__) . '/posts.php';
  if (!file_exists($template)) {
    return;
  }

  $def = array(
    'post_type' => 'shops',
    'taxonomy' => 'mall',
    'term' => '',
    'orderby' => 'asc',
    'posts_per_page' => -1,
  );
  $args = shortcode_atts($def, $args); //$defを結合した属性リストを返す
  $posts = get_posts($args);
  ob_start();
  foreach ($posts as $post) {
    $post_custom = get_post_custom($post->ID); //ポストIDから、カスタムフィールドを取得
    include($template);
  }
  $output = ob_get_clean();
  return $output;
}

add_shortcode('posts', 'posts_shortcode');

```

関数リファレンス/shortcode atts
http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/shortcode_atts

関数リファレンス/get post custom
https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/get_post_custom


```php
post.php

<section class="shops">
  <?php echo get_the_post_thumbnail($post->ID, 'large_thumbnail',
  array(
    'class' => 'alignleft shop_thumbnail',
    'title' => $post->post_title,
    'alt' => $post->post_title
  ));
  ?>

  <h3><?php echo esc_html($post->post_title); ?></h3>
  <table class="shop_spec">
    <?php
      $info_list = array('フロア情報', '営業時間', 'キャンペーン情報');
      foreach ($info_list as $info) :
        if(isset($post_custom[$info]) && $post_custom[$info]):
     ?>
     <tr>
       <th><?php echo $info; ?></th>
       <th><?php echo nl2br(esc_html($post_custom[$info][0])); ?></th>
     </tr>
     <?php
        endif;
      endforeach;
     ?>
  </table>
  <h4 class="shop_content_title">
    <img src="<?php bloginfo('template_url'); ?>/images/h4_shop_comment.png" alt="COMMENT" width="97" height="35" />
  </h4>
  <section class="shop_content">
    <?php echo $post->post_content; ?>
  </section>
</section>

```

```html 各モールの固定ページに追加
<h2>Shop Info</h2>
[posts term={mall_taxonomy}]
```

## パフォーマンスの注意事項

### Case1：パーマリンク切れによるパフォーマンス低下

パーマリンクのリンク先がリンク切れになっていた場合、WordPressが多重起動して遅くなる！！
  - パーマリンクはWebサーバのリライト機能を使っているため、リンクが存在しないときはWPの負担になる

対応策： .htaccessに以下の一文を追記する

```.htaccess
RewriteCond %{REQUEST_URI} !\.(gif|css|js|swf|jpeg|jpg|jpe|png|ico|swd|pdf)$
```

### Case2：日本語の翻訳ファイル読込みによるパフォーマンス低下

対応策： 001 Prime Strategy Translate Acceleratorを使う

* 001 Prime Strategy Translate Acceleratorのcacheディレクトリのパーミッション確認・変更を忘れないように

### Case3：さらなる高速化のために・・・

対応策：WP Super cacheを使う
 もし使えば、10～100倍の高速化が見込めるらしい
 細かい設定方法は P267を参照


## 本番サーバーへの移行方法は P273以降を参照

 - サーバーへのWPインストール方法
 - 仮想環境のWP設定をXMLでエクスポート（WordPress Importerプラグインを使う）
 - XMLを本番環境へインポート（WordPress Importerプラグインを使う）


## その他

 - XAMPPの設定方法 P286～299
 - 使用したプラグイン一覧 P301~305
