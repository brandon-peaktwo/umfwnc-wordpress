<?php 
  get_header();
?>

<?php 
  $link = get_field('hero_link');
?>
  
<section class="page_hero page_hero--standard width--max pad--zero margin--vertical" data-aos="fade-up" data-aos-delay="250">
  <div class="hero_container parallax">
    <div class="bg_dots parallax"></div> 
    <div class="hero_content" data-aos="fade-right" data-aos-delay="500"> 
      <h1>404 - Page Not Found</h1>
      <p>It seems you’re looking for a page that doesn’t exist.</p>

        <a href="/" class="link margin--top-small">Visit Home ></a>

    </div>
  </div>
</section>


<?php get_footer(); ?>