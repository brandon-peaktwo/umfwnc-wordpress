<?php 
  $section = get_query_var('section');
  $label = get_field($section . '_header_label');
  $title = get_field($section . '_header_title');
  $content = get_field($section . '_header_content');
  $columns = get_field($section . '_header_columns');
  $link = get_field($section . '_header_link');
  $modalContent= get_field($section . '_header_modal_content');
  
  if(get_field($section . '_header_modal_link') ) : 
   $modalLink = get_field($section . '_header_modal_link');
  else :
    $modalLink = "Learn More";
  endif;
?>

<header class="section-header">
  <?php if($label) :?>
    <i class="section-header_icon icon-T icon"></i>
    <label class="section-header_label"><?=$label;?></label>
  <?php endif; ?>
  
  <?php if($title) :?>
    <h2><?=$title?></h2>
  <?php endif; ?>
  
  <?php if($content) :?>
    <div class="sub-title"><?=$content?></div>
  <?php endif; ?>
  
  <?php if($columns) :?>
    <div class="section-header_columns">
      <?=$columns;?>
    </div>
  <?php endif;?>
  
  <?php if($link) :?>
    <a href="<?=$link['url'];?>" class="link" target="<?=$link['target'];?>"><?=$link['title'];?> ></a>
  <?php endif; ?>
  
  <?php if($modalContent) :?>
    <a href="#" class="modal-open link"><?=$modalLink;?> ></a>
  <?php endif; ?>
</header>

  