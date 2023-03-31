<?php 
  /**
  * Template Name: Leadership
  */
  
  get_header();
  get_template_part( 'modules/module', 'page-hero' )
?>

<section id="leadership" class="leadership margin--top width--max">
  <div class="team-members margin--bottom-half container">
    <?php $i = 0; while(have_rows('team_members') ): the_row(); ?>
      <?php 
        $content = get_sub_field('bio');
        $name = get_sub_field('name');
        $title = get_sub_field('title');
        $phone = get_sub_field('phone_number');
        $email = get_sub_field('email');
        $thumbnail = get_sub_field('headshot');
        $quote = get_sub_field('quote');
      ?>
          
      <div class="member text--center">
        <img src="<?=$thumbnail['url'];?>" class="member_thumbnail margin--bottom-small" />
        
        <h3><?=$name;?></h3>
        
        <?php if($title): ?>
          <p class="title"><?=$title;?></p>
        <?php endif ;?>
        
        <?php if($email || $phone): ?>
          <p class="details">
            <?php if($email): ?>
              <span><?=$email;?></span>
            <?php endif; ?>
             <?php if($phone): ?>
              <span><?=$phone;?></span>
            <?php endif; ?>
          </p>
        <?php endif ;?>
        
        <a data-slide="<?=$i?>"  data-id="team" class="link modal-open">Read Bio ></a>      
      </div>
    <?php $i++; endwhile; ?>
    
    <!--- Team Modal-->
    <div class="modal" data-id="team" id="team-modal">
      <div class="flex">
        <div class="container">
          <div class="scroll">
            <a class="modal-close" id="modalteam">close</a>
            
    
            <div class="team-carousel">
              <?php while(have_rows('team_members') ): the_row(); ?>
                <?php
                  $image = get_sub_field('headshot');
                  $name = get_sub_field('name');
                  $title = get_sub_field('title');
                  $phone = get_sub_field('phone_number');
                  $email = get_sub_field('email');
                  $quote = get_sub_field('quote');
                  $bio = get_sub_field('bio');
                ?>
                <div class="slide">
                  <header class="slide_header section-header margin--bottom-small">
                    <i class="section-header_icon icon-T icon"></i>
                    <h2 class=""><?=$name;?></h2>
                    <p class="slide_title title"><?=$title;?></p>
                  </header>
                    
                  <div class="slide_info member">
                    <img src="<?=$image['url'];?>" class="member_thumbnail margin--bottom-small" />
          
                    <h3><?=$name;?></h3>
                    
                    <?php if($title): ?>
                      <p class="title"><?=$title;?></p>
                    <?php endif ;?>
                    
                    <?php if($email || $phone): ?>
                      <p class="details">
                        <?php if($email): ?>
                          <span><?=$email;?></span>
                        <?php endif; ?>
                         <?php if($phone): ?>
                          <span><?=$phone;?></span>
                        <?php endif; ?>
                      </p>
                    <?php endif ;?>
                  </div>
                  
                  <div class="slide_content">
                    <?php if($quote): ?>
                      <p class="slide_quote alternate color--primary"><?=$quote;?></p>
                    <?php endif;?>
                    <?=$bio;?>
                  </div>  
                    
                </div>
              <?php endwhile; ?>             
            </div>
          </div>
          
          <nav class="team_controls controls">
            <i class="control prev-slide">Previous</i>
            <i class="control next-slide">Next</i>
          </nav>
        </div>
      </div>
    </div>
  </div>
  
  <div id="board" class="executives width--max">
    <header class="section-header margin--bottom-small pad--top-small">
      <i class="section-header_icon icon-T icon"></i>
      
      <?php if(get_field('executives_title')) :?>
        <h2><?php the_field('executives_title');?></h2>
      <?php endif; ?>  
    </header>
    
    <div class="executives_list margin--bottom-half">
      <?php while(have_rows('executives') ): the_row(); ?>
        <?php 
          $name = get_sub_field('name');
          $title = get_sub_field('title'); 
        ?>
        <div class="executive">
          <p><strong><?=$name;?>,</strong> <?=$title;?></p>
        </div>
      <?php endwhile; ?>
    </div>  
    
    <div class="officers">
      <?php while(have_rows('officers') ): the_row(); ?>
        <?php 
          $year = get_sub_field('year');
        ?>
        <div class="officers_year">
          <h3><?=$year;?></h3>
          <?php while(have_rows('members') ): the_row(); ?>
            <?php 
              $name = get_sub_field('name');
              $title = get_sub_field('area'); 
            ?>
          
              <p><strong><?=$name;?>,</strong> <?=$title;?></p>
           
          <?php endwhile; ?>
        </div>
      <?php endwhile; ?>
    </div>  
  </div>
</section>

<section id="letter" class="letter bg--offwhite width--max pad--vertical">
  <div class="letter_container container">
    <div class="width--thin margin--bottom-small">
      <?php 
        set_query_var( 'section', 'letter' );
        get_template_part( 'modules/module', 'section-header' );
      ?> 
    </div>
    
    <div class="letter_welcome margin--bottom-half">
      <?php 
        $headshot = get_field('letter_thumbnail');
      ?>
      <p class="alternate"><?php the_field('letter_welcome');?></p>
      <img class="letter_thumbnail" src="<?=$headshot['url'];?>"/> 
    </div>
    
    <div class="letter_content">
      <?php the_field('letter_content'); ?>
    </div>
  </div>
</section>
<?php if( get_field('links_display') == 'yes' ): ?>

  <section class="resources margin--vertical width--max pad--bottom">
    <div class="resources_container">
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
<?php endif; ?>

<?php get_footer(); ?>