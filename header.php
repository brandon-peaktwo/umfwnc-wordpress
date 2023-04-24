<?php
/**
 * The Header for our theme.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, maximum-scale=1.0" />

  <title><?php wp_title( '|', true, 'right' ); ?></title>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-KH62M6W');</script>
  <!-- End Google Tag Manager -->

  <script>
		var siteURL = "<?php echo get_home_url(); ?>";
  </script>

  <?php wp_head(); ?>
  <style>
		@media (min-width: 768px) {
		  .page-template-resources-archive .image-content .section_background {
			  width: 50%;
		  }
		}

		.page-template-resources-archive .background-changer {
			display: block;
			position: absolute;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			opacity: 0;
			pointer-events: none;
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			transition: opacity .1s linear;
		}

		.page-template-resources-archive .background-changer.active {
			 opacity: 1;
		}
  </style>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KH62M6W"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<header class="global" data-aos="fade-down">
  <div class="header_container">
	 <a id="header_logo" href="/">
		<?php
		  $logo = get_field('logo', 'options');
		  echo '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />';
		?>
	 </a>
	 <nav class="primary">
		<?php
		  wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'depth' => 3 ) );
		?>


	 </nav>
	 <nav class="utility">
		<a href="https://login2.fisglobal.com/idp/0832A/?ClientID=PALUI" target="_blank">Client Login</a>
		<a href="<?php echo get_home_url(); ?>/contact/">Contact Us</a>
		<a href="<?php echo get_home_url(); ?>/organizations/hospitality/">Reserve Meeting Space</a>

	 </nav>
	 <div class="large-menu-items">
		<li class="churches-menu-items submenu-items" data-menu="churches">
		  <div class="submenu-image">
			 <?php
				$menu_image = get_field('churches_menu_image', 'options');
			 ?>
			 <img src="<?=$menu_image['url'];?>"/>
		  </div>

		  <div class="submenu-links">
			 <?php while(have_rows('churches_menu_links', 'options') ): the_row(); ?>
				<?php
				  $menu_link = get_sub_field('link');
				?>
				<a href="<?=$menu_link['url'];?>" class="btn button" target="<?=$menu_link['target'];?>"><?=$menu_link['title'];?></a>
			 <?php endwhile; ?>
		  </div>
		</li>

		<li class="about-menu-items submenu-items" data-menu="about">
		  <div class="submenu-image">
			 <?php
				$menu_image = get_field('about_menu_image', 'options');
			 ?>
			 <img src="<?=$menu_image['url'];?>"/>
		  </div>

		  <div class="submenu-links">
			 <?php while(have_rows('about_menu_links', 'options') ): the_row(); ?>
				<?php
				  $menu_link = get_sub_field('link');
				?>
				<a href="<?=$menu_link['url'];?>" class="btn button" target="<?=$menu_link['target'];?>"><?=$menu_link['title'];?></a>
			 <?php endwhile; ?>
		  </div>
		</li>

		<li class="individuals-menu-items submenu-items" data-menu="individuals">
		  <div class="submenu-image">
			 <?php
				$menu_image = get_field('individuals_menu_image', 'options');
			 ?>
			 <img src="<?=$menu_image['url'];?>"/>
		  </div>

		  <div class="submenu-links">
			 <?php while(have_rows('individuals_menu_links', 'options') ): the_row(); ?>
				<?php
				  $menu_link = get_sub_field('link');
				?>
				<a href="<?=$menu_link['url'];?>" class="btn button" target="<?=$menu_link['target'];?>"><?=$menu_link['title'];?></a>
			 <?php endwhile; ?>
		  </div>
		</li>

		<li class="organizations-menu-items submenu-items" data-menu="organizations">
		  <div class="submenu-image">
			 <?php
				$menu_image = get_field('organizations_menu_image', 'options');
			 ?>
			 <img src="<?=$menu_image['url'];?>"/>
		  </div>

		  <div class="submenu-links">
			 <?php while(have_rows('organizations_menu_links', 'options') ): the_row(); ?>
				<?php
				  $menu_link = get_sub_field('link');
				?>
				<a href="<?=$menu_link['url'];?>" class="btn button" target="<?=$menu_link['target'];?>"><?=$menu_link['title'];?></a>
			 <?php endwhile; ?>
		  </div>
		</li>

		<li class="lc-menu-items submenu-items" data-menu="lc">
		  <div class="submenu-image">
			 <?php
				$menu_image = get_field('learning_center_menu_image', 'options');
			 ?>
			 <img src="<?=$menu_image['url'];?>"/>
		  </div>

		  <div class="submenu-links">
			 <?php while(have_rows('learning_center_menu_links', 'options') ): the_row(); ?>
				<?php
				  $menu_link = get_sub_field('link');
				?>
				<a href="<?=$menu_link['url'];?>" class="btn button" target="<?=$menu_link['target'];?>"><?=$menu_link['title'];?></a>
			 <?php endwhile; ?>
		  </div>
		</li>

		<li class="give-menu-items submenu-items" data-menu="give">
		  <div class="submenu-image">
			 <?php
				$menu_image = get_field('give_menu_image', 'options');
			 ?>
			 <img src="<?=$menu_image['url'];?>"/>
		  </div>

		  <div class="submenu-links">
			 <?php while(have_rows('give_menu_links', 'options') ): the_row(); ?>
				<?php
				  $menu_link = get_sub_field('link');
				?>
				<a href="<?=$menu_link['url'];?>" class="btn button" target="<?=$menu_link['target'];?>"><?=$menu_link['title'];?></a>
			 <?php endwhile; ?>
		  </div>
		</li>
	</div>
	 <nav class="mobile">
		<a href="#" id="mobile-nav-toggle">
		  <span></span>
		  <span></span>
		  <span></span>
		  <span></span>
		  <span></span>
		  <span></span>
		</a>
	 </nav>
  </div>
  <?php require(get_stylesheet_directory() . '/modules/announcement-bar.php'); ?>
</header>

<div class="page-background">
  <div class="bg_dots-wrapper">
	 <div class="bg_dots-1 parellax"></div>
  </div>
</div>

<?php get_template_part( 'modules/module', 'mobile-nav' );?>

<a href="#" id="back_top" data-aos-delay="3000" data-aos="fade-up"><span class="arrow"></span></a>
