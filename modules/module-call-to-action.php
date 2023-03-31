<?php if(get_field('show_cta') == 'yes') : ?>
  <section id="cta">
    <div class="cta_container">
      <div class="cta_content">
        <h2><?php the_field('cta_headline');?></h2>
        <p><?php the_field('cta_content');?></p>
        <?php 
          if( get_field('cta_link') ): 
          
          $link = get_field('cta_link'); 
          $link_url = $link['url'];
          $link_title = $link['title'];
          $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        
          <a class="btn primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
            <?php echo esc_html($link_title); ?>
            <i class="icon icon-caret-right caret-white"></i>
          </a>
        
        <?php endif;  ?>
      </div>
    </div>
  </section>
<?php endif;?>