<?php 
  /**
  * Template Name: About
  */
  
  get_header();
  get_template_part( 'modules/module', 'page-hero' )
?>

<section class="intro section--main">
  <div class="intro_container width--thin pad--top-half pad--bottom">
    <?php 
      set_query_var( 'section', 'intro' );
      get_template_part( 'modules/module', 'section-header' );
    ?>  
    <div class="margin--top-small">
      <?php the_field('intro_content'); ?> 
    </div>
  </div>
</section>

<section class="image-content image--first">
  <div class="section_container">
    
    <div class="section_background" style="background-image: url(<?php the_field('letter_background');?>);" data-aos="fade-right" data-aos-delay="0" data-aos-anchor=".image-content"></div>
    <div class="section_content" data-aos="fade-left" data-aos-delay="250" data-aos-anchor=".image-content">
      <div class="bg_dots parallax"></div>

      <div class="section_content-wrapper">
        <?php 
          set_query_var( 'section', 'letter' );
          get_template_part( 'modules/module', 'section-header' );
        ?>  
      </div>
    </div>
  </div>
</section>

<?php if(get_field('values')): ?>
  <section class="values bg--offwhite pad--top pad--bottom width--max">
    <div class="values_container container section--main">
      <?php while(have_rows('values') ): the_row(); ?>
        <?php 
          $content = get_sub_field('content');
          $title = get_sub_field('headline');
        ?>
        <div class="value">
          <i class="value_icon icon icon-T"></i>
          <h3 class="value_title"><?=$title;?></h3>
  
          <?php if($content): ?>
            <p><?=$content;?></p>
          <?php endif ;?>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
<?php endif; ?>

<?php if( get_field('resources_display') == 'yes' ): ?>
  <section class="resources pad--vertical width--max margin--bottom-half section--main">
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
    </div>
  </section>
<?php endif; ?>



<?php get_footer(); ?>