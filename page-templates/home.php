<?php 
  /**
  * Template Name: Home
  */
  
  get_header();
?>

<section class="home-hero width--max margin--bottom-double" style="background-image: url(<?php the_field('hero_background');?>);" data-aos="fade-up" data-aos-delay="250">
  <div class="hero_container parallax">
    
    <div class="hero_content color--white" data-aos="fade-right" data-aos-delay="500">
      <div class="bg_dots parallax"></div>
      
      <?php 
        set_query_var( 'section', 'hero' );
        get_template_part( 'modules/module', 'section-header' );
      ?>
      
    </div>
  </div>
</section>

<section class="image-content image--first width--max margin--vertical section--main welcome">
  <div class="section_container">
    <div class="section_background" style="background-image: url(<?php the_field('welcome_background');?>);"></div>
    <div class="section_content parallax">
      <?php $thumbnail = get_field('welcome_headshot'); ?>
      
      <div class="welcome_thumbnail" style="background-image: url(<?=$thumbnail;?>)"></div>
      <div class="section_content-wrapper">
        <?php 
          set_query_var( 'section', 'welcome' );
          get_template_part( 'modules/module', 'section-header' );
        ?>  
      </div>
    </div>
  </div>
</section>

<section class="resources margin--vertical width--max section--main">
  <div class="resources_container">
    <div class="width--max margin--bottom-half">
      <?php 
        set_query_var( 'section', 'resources' );
        get_template_part( 'modules/module', 'section-header' );
      ?> 
    </div>
    
    <?php 
      get_template_part( 'modules/module', 'resources' );
    ?> 
    
    <div class="text--center margin--top-half container">
      <a href="/learning-center" class="link">visit our learning center for resources and videos ></a>
    </div>
  </div>
</section>

<section class="numbers width--max margin--vertical section--main">
  <div class="container">
    <div class="margin--bottom-small">
      <?php 
        set_query_var( 'section', 'numbers' );
        get_template_part( 'modules/module', 'section-header' );
      ?>
    </div>
    
    <div class="numbers_list tab_wrapper">
      <nav class="numbers_nav tab_nav margin--bottom-small">
        <?php $i = 0; while(have_rows('number_tabs') ): the_row(); ?>
          <?php
            $title = get_sub_field('title');
          ?>
          <div class="nav_item tab_nav-item <?php echo $i === 0 ? 'current' : ''; ?>" data-tab="tab_<?=$i++;?>">
            <span class="nav_title"><?=$title?></span>
          </div>
        <?php endwhile; ?>
      </nav>
      
      <?php $t = 0; while(have_rows('number_tabs') ): the_row(); ?>
        <div class="numbers_tab tab_content tab_<?=$t;?> <?php echo $t === 0 ? 'current' : ''; ?>" id="tab_<?=$t++;?>">
          <div class="numbers_items">
            <?php while(have_rows('numbers') ): the_row(); ?>
              <?php

              ?>
              <div class="numbers_item">
                <i class="icon-T icon"></i>
                <span class="numbers_stat"><?php the_sub_field('number');?>%</span>
                <span class="numbers_title"><?php the_sub_field('title');?></span>
                <div class="points">
                  <?php while(have_rows('points') ): the_row(); ?>
                    <span class="point"><?php the_sub_field('point');?></span>
                  <?php endwhile; ?>
                </div>
                <i class="icon-T icon"></i>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>


<?php get_footer(); ?>