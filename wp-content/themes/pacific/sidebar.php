      <section id="sidebar">
        <?php
          if(is_category('column') || (is_single() && in_category('column'))) :
        ?>
        <aside class="rss_link">
          <a href="<?php echo get_category_feed_link(get_category_by_slug('column')->term_id); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/btn_rss_feed.png" width="250" height="28" alt="RSS">
          </a>
        </aside>
        <?php endif; ?>

        <div id="primary" class="widget-area">
          <?php dynamic_sidebar('primary-widget-area') ?>
        </div><!-- #primary end -->
        <div id="secondary" class="widget-area">
          facebook like box
        </div><!-- #secondary end -->
      </section><!-- #sidebar end -->
