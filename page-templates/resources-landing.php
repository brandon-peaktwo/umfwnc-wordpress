<?php 
  /**
  * Template Name: Resources Landing
  */
  
  get_header();
  get_template_part( 'modules/module', 'page-hero' )
?>

<section class="resource-links section--main">
  <div class="width--max margin--bottom margin--top-half">
    <div class="items three-col">
      <?php while(have_rows('items') ): the_row(); ?>
        <?php 
          $content = get_sub_field('teaser');
          $link = get_sub_field('link');
          $title = get_sub_field('title');
          $category = get_sub_field('label');
        ?>
            
        <div class="item text">
          <div class="item_wrapper">
            <i class="item_icon icon-T icon"></i>
            
            <?php if($category): ?>
              <p class="section_label"><?=$category;?></p>
            <?php endif ;?>
            
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


<?php if(get_field('links_show') == 'yes'): ?>
  <section class="resources pad--vertical bg--offwhite width--max section--main">
    <div class="resources_container">
      <div class="width--thin margin--bottom-small">
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