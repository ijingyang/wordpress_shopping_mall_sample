<?php get_header(); ?>
      <section id="contents">
        <section id="malls-pickup">
          <div class="malls-group">
            <?php
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
              <?php the_pickup_excerpt(); ?>

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
          </div><!-- .malls-group end -->
        </section><!-- #malls-pickup end -->
        <section id="latest-columns">
          <h1 id="latest-columns-title">新着コラム</h1>
          <span class="link-text archive-link">
            <a href="<?php echo get_term_link('column', 'category'); ?>">コラム一覧</a></span>
          <div class="column-group head">
            <?php
              $column_posts = new WP_Query('posts_per_page=4&category_name=column');
              if($column_posts->have_posts()):
                $count = 1;
                while($column_posts->have_posts()):
                  $column_posts->the_post();
                  if($count % 2 > 0 && $count != 1):
             ?>
           </div><!-- .column-group end -->
           <div class="column-group head">
             <?php
                endif;
              ?>
              <article class="column-article">
                <h1 class="update-title">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h1>
                <time class="entry-date" datetime="<?php the_time('Y-m-d'); ?>">
                  <?php the_time(get_option('date-format')); ?>
                </time>
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('post-thumbnail',
                  array(
                    'alt' => the_title_attribute('echo=0'),
                    'title' => the_title_attribute('echo=0')
                  ));
                  ?>
                </a>
                <?php the_short_excerpt(); ?>
                <span class="link-text">
                  <a href="<?php the_permalink(); ?>">続きを読む</a>
                </span>
              </article>
              <?php
                    $count++;
                  endwhile;
                endif;
                wp_reset_postdata();
               ?>
           </div><!-- .column-group end -->
          </div><!-- .column-group end -->
        </section><!-- #latest-columns end -->
      </section><!-- #contents end -->
      <?php get_sidebar('top'); ?>
      <?php get_footer(); ?>
