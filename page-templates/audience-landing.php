<?php 
  /**
  * Template Name: Audience Landing
  */
  
  get_header();
  get_template_part( 'modules/module', 'page-hero' )
?>

<section class="intro section--main width--max">
  <div class="intro_container width--thin pad--top-half pad--bottom">
    <?php 
      set_query_var( 'section', 'intro' );
      get_template_part( 'modules/module', 'section-header' );
    ?>  
  </div>
</section>

<section class="audience-links">
  <div class="audience-links width--max pad--vertical bg--offwhite section--main">
    <?php 
      set_query_var( 'section', 'content' );
      get_template_part( 'modules/module', 'section-header' );
    ?> 
    
    <div class="items three-col margin--top-small">
      <?php while(have_rows('items') ): the_row(); ?>
        <?php 
          $content = get_sub_field('teaser');
          $link = get_sub_field('link');
          $title = get_sub_field('title');
        ?>
            
        <div class="item text">
          <div class="item_wrapper">
            <i class="item_icon icon-T icon"></i>
            
            <h3 class="item_title"><?=$title;?></h3>
            
            <?php if($content): ?>
              <p><?=$content;?></p>
            <?php endif ;?>
            
            <?php if($link) :?>
              <a href="<?php echo $link['url'];?>" target="<?=$link['target'];?>" class="link"><?=$link['title'];?> ></a>
            <?php endif; ?>
          </div>
        </div>

      <?php endwhile; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>