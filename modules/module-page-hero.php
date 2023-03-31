<?php 
  
  $style = 'standard';
  $cta_bg = get_field('hero_background');
  $link = get_field('hero_link');
  if($cta_bg ): 
    $style = 'image'; 
  endif; 
?>
  
<section class="page_hero page_hero--<?=$style;?> width--max pad--zero" style="background-image:url(<?=$cta_bg?>);">
  <div class="hero_container">
    <div class="bg_dots parallax"></div> 
    <div class="hero_content"> 
      <h1><?php the_field('hero_title');?></h1>
      <p><?php the_field('hero_content');?></p>
      <?php if($link) :?>
        <a href="<?-$link['url'];?>" class="link margin--top-small" target="<?=$link['target'];?>"><?=$link['title'];?> ></a>
      <?php endif; ?>
    </div>
  </div>
</section>
