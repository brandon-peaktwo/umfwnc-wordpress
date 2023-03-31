<?php 
  /**
  * Template Name: Audience
  */
  
  get_header();
  get_template_part( 'modules/module', 'page-hero' )
?>

<?php $i = 0; while(have_rows('sections') ): the_row(); ?>

  <?php if( get_row_layout() == 'intro' ): ?>

    <section class="image-content">
      <div class="section_container">
        <div class="section_background" style="background-image: url(<?php the_sub_field('intro_background_');?>);"  data-aos="fade-left" data-aos-delay="0" data-aos-anchor=".image-content"></div>
        <div class="section_content" data-aos="fade-right" data-aos-delay="250" data-aos-anchor=".image-content">
          <div class="bg_dots parallax"></div>
          <div class="section_content-wrapper">
            <?php 
              $label = get_sub_field('header_label');
              $title = get_sub_field('header_title');
              $content = get_sub_field('header_content');
              $columns = get_sub_field('header_columns');
              $link = get_sub_field('header_link');
              $modalContent= get_sub_field('header_modal_content');
  
              if(get_sub_field('header_modal_link') ) : 
               $modalLink = get_sub_field('header_modal_link');
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
              
              <?php if($modalContent) :?>
                <a href="#" class="modal-open link" data-id="<?=$i;?>"><?=$modalLink;?> ></a>  
              <?php endif; ?>
            </header>

          </div>
        </div>
      </div>
      <?php if($modalContent) :?>
        <!--- Section Modal-->
        <div class="modal content-modal" data-id="<?=$i;?>">
          <div class="flex">
            <div class="container">
                              <a class="modal-close" id="modal<?=$i;?>">close</a>
              <div class="scroll">

                
                <?=$modalContent;?>
              </div>
            
            </div>
          </div>
        </div>
      <?php endif; ?>
    </section>
  <?php elseif( get_row_layout() == 'stats' ): ?>
    <section class="stats margin--vertical">
      <div class="numbers_container section--main container">
        <div class="width--thin margin--bottom-small">
          <?php 
            set_query_var( 'section', 'stats' );
            get_template_part( 'modules/module', 'section-header' );
          ?> 
        </div>
        
        <div class="numbers">
          <div class="numbers_content">
            <?php the_sub_field('stats_content');?>
          </div>
          <div class="numbers_list">
            <div class="numbers_items">
              <?php while(have_rows('numbers') ): the_row(); ?>
                <?php
    
                ?>
                <div class="numbers_item">
  <!--                 <i class="icon-T icon"></i> -->
                  <span class="numbers_stat"><?php the_sub_field('number');?>%</span>
                  <span class="numbers_title"><?php the_sub_field('title');?></span>
                  <div class="points">
                    <?php while(have_rows('points') ): the_row(); ?>
                      <span class="point"><?php the_sub_field('point');?></span>
                    <?php endwhile; ?>
                  </div>
  <!--                 <i class="icon-T icon"></i> -->
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
  
      </div>
    </section>
  <?php elseif( get_row_layout() == 'resources' ): ?>
    <section class="resources margin--vertical width--max">
      <div class="resources_container">
        <div class="width--thin margin--bottom-small">
          <?php 
            $label = get_sub_field('header_label');
            $title = get_sub_field('header_title');
            $content = get_sub_field('header_content');
            $columns = get_sub_field('header_columns');
            $link = get_sub_field('header_link');
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
          </header>

        </div>
        
        <div class="resources">
          <?php $section = 'resources' ?>
          <?php while(have_rows('resource_lists') ): the_row(); ?>
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
                $count2 = count(get_sub_field('list_two'));
                if($count2%2){
                  $layout2 = 'odd';
                }else{
                  $layout2 = 'even';
                }
              ?>
              <div class="resources_list-text layout--<?=$count2;?>">
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
      </div>
    </section>
  <?php elseif( get_row_layout() == 'faqs' ): ?>  
    <section class="faqs pad--top pad--bottom-small bg--offwhite width--max">
      <div class="faqs_container">  
        <div class="width--thin margin--bottom-half">
          <?php             
            $title = get_sub_field('section_headline');
          ?>
          
          <header class="faq_header section-header">
            <?php if($title) :?>
              <i class="section-header_icon icon-T icon"></i>
              <h2><?=$title?></h2>
            <?php endif; ?>
          </header>
        </div>
        
        <div class="questions">
          <?php $int = 0; while ( have_rows('faqs') ) : the_row(); ?>
            <?php
              $title = get_sub_field('question');
              $content = get_sub_field('answer');
            ?>
            <div class="question" data-aos-delay="<?=$int?>" data-aos="fade-up" data-aos-anchor=".faq_header">
              <p><strong><?=$title;?></strong></p>
              <?=$content;?>
            </div>
          <?php $int = $int + 250; endwhile; ?>
        </div>
      </div>
    </section>
  <?php elseif(get_row_layout() == 'rep_contact'): ?>
    <?php 
      $background = get_sub_field('rep_background');
      $label = get_sub_field('rep_label');
      $content = get_sub_field('rep_content');
    ?>
    
    <section class="rep-contact margin--vertical">
      <div class="rep_container">
        <div class="rep_background" style="background-image: url(<?=$background;?>);" data-aos="fade-right" data-aos-delay="0" data-aos-anchor=".rep-contact"></div>
        <div class="rep_content" data-aos="fade-left" data-aos-delay="250" data-aos-anchor=".rep-contact">
          <div class="rep_content-wrapper">
            <?php if($label) :?>
              <label class="rep_label section_label"><?=$label;?></label>
            <?php endif; ?>
            
            
            <?php if($content) :?>
              <?=$content?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  <?php elseif(get_row_layout() == 'quote'): ?>
    <section class="quote width--max margin--vertical">
      <?php         
        $title = get_sub_field('quote_name');
        $content = get_sub_field('quote_content');
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

    </section>
  <?php endif; ?>
<?php $i++; endwhile; ?>








<?php get_footer(); ?>