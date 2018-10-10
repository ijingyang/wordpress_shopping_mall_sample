      <section id="sidebar">
        <aside class="rss_link">
          <?php
            the_feed_link('<img src="' . get_template_directory_uri()
             . '/images/btn_rss_feed.png" width="250" height="28" alt="RSS" />');
           ?>
        </aside>
        <div id="primary" class="widget-area">
          <?php
            $sidebar_cat_list = array(
              'event' => 2,
              'malls' => 2,
              'information' => 2,
            );

            foreach ($sidebar_cat_list as $sidebar_cat_name => $sidebar_cat_num):
              $sidebar_posts = new WP_Query('posts_per_page=' . $sidebar_cat_num
               . '&category_name=' . $sidebar_cat_name);
           ?>

          <aside id="<?php echo $sidebar_cat_name; ?>" class="news-list">
            <h1><?php echo esc_html(get_category_by_slug($sidebar_cat_name)->name); ?></h1>
            <div class="info-wrap">
              <ul>
                <?php
                  if($sidebar_posts->have_posts()):
                    while($sidebar_posts->have_posts()):
                      $sidebar_posts->the_post();
                ?>
                <li>
                  <time class="entry-date" datetime="<?php the_time('Y-m-d'); ?>">
                    <?php the_time(get_option('date_format')); ?>
                  </time>
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('small_thumbnail',
                    array(
                      'alt' => the_title_attribute('echo=0'),
                      'title' => the_title_attribute('echo=0'),
                    ));
                    ?>
                  </a>
                  <?php the_short_excerpt(); ?>
                </li>
                <?php
                    endwhile;
                  endif;
                 ?>
              </ul>
              <span class="link-text">
                <a href="<?php echo get_term_link($sidebar_cat_name, 'category'); ?>">
                  <?php echo esc_html(get_category_by_slug($sidebar_cat_name)->name); ?>一覧
                </a>
              </span>
            </div>
          </aside>
          <?php
              wp_reset_postdata();
            endforeach;
          ?>
        </div><!-- #primary end -->
      </section><!-- #sidebar end -->
