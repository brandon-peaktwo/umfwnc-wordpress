<?php 
  /**
  * Template Name: Learning Center
  */
  
  get_header();
  get_template_part( 'modules/module', 'page-hero' );
?>

<section class="resources margin--vertical width--max">
  <div class="resources_container pad--top">
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

<section class="newsletter pad--vertical width--max bg--offwhite section--main">
  <div class="newsletter_container width--thin">
    <div class="margin--bottom-small">
      <?php 
        set_query_var( 'section', 'newsletter' );
        get_template_part( 'modules/module', 'section-header' );
      ?> 
    </div>
    
   <div class="form width--thinner text--center">
      <?php gravity_form(2, false, false, false, '', true, 12); ?>
    </div> 
  </div>
</section>
    

<?php get_footer(); ?>