<?php 
  $logo = get_field('hero_logo');
  $headline = get_field('hero_headline');
  $date = get_field('hero_date');
  $location = get_field('hero_location');
  $video = get_field('hero_video');
?>

<section id="hero" class="hero">
  <div class="hero_container">
    <img src="<?=$logo['url']?>" class="hero_logo" data-aos="fade-up"  data-aos-anchor=".hero"/>
    <h1 data-aos-delay="500" data-aos="fade-up"  data-aos-anchor=".hero"><?=$headline?></h1>
    <div data-aos-delay="700"  data-aos="fade-up"  data-aos-anchor=".hero" class="hero_details">
      <span class="hero_details-item details--date"><i class="icon icon-date-white"></i><?=$date?></span>
      <span class="hero_details-item details--location"><i class="icon icon-location-white"></i><?=$location?></span>
    </div>
    <img data-aos-delay="3000" data-aos-anchor=".hero" data-aos-anchor-placement="top-center" data-aos="fade-down" src="/wp-content/themes/thrivesummit/images/arrow-down.png" class="arrow-down hero_arrow"/>
  </div> 

  <div class="hero_video">
    <video playsinline autoplay muted poster="<?=$video['poster']?>" loop>
      <source src="<?=$video['webm']?>" type="video/webm">
      <source src="<?=$video['mp4']?>" type="video/mp4">
    </video>
  </div>

</section>
