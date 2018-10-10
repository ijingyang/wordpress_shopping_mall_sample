<!-- 固定ページ用テンプレート -->
<?php get_header(); ?>
      <section id="contents">
        <header class="page-header">
          <h1 class="page-title">
            <?php single_cat_title(); ?>
          </h1>
        </header>
        <div class="posts">
          <?php
            if(have_posts()):
              while(have_posts()):
                the_post();
                get_template_part('content-archive');
              endwhile;
            endif;
           ?>
        </div>
      </section><!-- #contents end -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
