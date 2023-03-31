<?php 
  $section = get_query_var('section');

  $title = get_field($section . '_quote_name');
  $content = get_field($section . '_quote_content');
?>

<div class="quote_box section--main">
  <div class="bg_dots parallax"></div>
  <?php if($content) :?>
    <p class=""><?=$content?></p>
  <?php endif; ?>
  
  
  <?php if($title) :?>
    <span class="quote_name">- <?=$title?></span>
  <?php endif; ?>
</header>

  