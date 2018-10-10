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
