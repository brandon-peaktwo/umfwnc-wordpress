<nav class="overlay">
  <div class="container">
    <a href="#" id="menu-close">
      <span></span>
      <span></span>
    </a>
    
    <div class="right">
      <a id="logo" href="/">
        <?php 
          $logo = get_field('logo', 'options');
          echo '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />';
        ?>
      </a>
      
      <?php wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => false, 'depth' => 2 ) ); ?>
    </div>
  </div>
</nav>