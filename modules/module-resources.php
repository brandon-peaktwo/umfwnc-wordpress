<?php
  $section = get_query_var('section');
?>

<div class="resources">
  <?php while(have_rows($section . '_resource_lists') ): the_row(); ?>
	 <?php if(have_rows('list_one')): ?>
		<div class="resources_list-images">
		  <?php $int = 0; while ( have_rows('list_one') ) : the_row(); ?>
			 <?php
				$background = get_sub_field('background');
				$link = get_sub_field('link');
			 ?>
			 <div class="resource" style="background-image: url(<?=$background;?>);" data-aos-delay="<?=$int?>" data-aos="fade-up" data-aos-anchor=".resources_list-images">
				<a href="<?=$link['url'];?>" class="cover-link" target="<?=$link['target'];?>"></a>
				<a href="<?=$link['url'];?>" class="resource_title" target="<?=$link['target'];?>"><?=$link['title'];?> ></a>
			 </div>
		  <?php $int = $int + 250; endwhile; ?>
		</div>
	 <?php endif; ?>

	 <?php if(have_rows('list_two')): ?>
		<?php
		  // $count2 = count(get_sub_field('list_two'));
		  // if($count2%2){
		  //   $layout2 = 'odd';
		  // }else{
		  //   $layout2 = 'even';
		  // }
		?>
		<!-- <div class="resources_list-text layout--<?=$count2;?>"> -->
		<div class="resources_list-text layout--odd>">
		  <?php $int = 0; while ( have_rows('list_two') ) : the_row(); ?>
			 <?php
				$title = get_sub_field('title');
				$link = get_sub_field('link');
				$content = get_sub_field('description');
			 ?>
			 <div class="resource" data-aos-delay="<?=$int?>" data-aos="fade-up" data-aos-anchor=".resources_list-images">
				<h3><?=$title;?></h3>
				<p><?=$content;?></p>
				<a href="<?=$link['url'];?>" class="resource_link link" target="<?=$link['target'];?>"><?=$link['title'];?> ></a>
			 </div>
		  <?php $int = $int + 250; endwhile; ?>
		</div>
	 <?php endif; ?>
  <?php endwhile; ?>
</div>
