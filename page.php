<?php
/**
 * Default Page Template
 */

get_header(); 
get_template_part( 'modules/module', 'page-hero' )
?>

<?php $i = 0; while(have_rows('sections') ): the_row(); ?>

  <?php if( get_row_layout() == 'form' ): ?>
    <?php 
      $form = get_sub_field('form');
    ?> 
    
    <section class="contact-form width--thin margin--half">
      <div class="contact_form">
        <div class="form margin--bottom">
          <div class="bg_dots parallax"></div>
          <div class="form_wrapper">
            <?php gravity_form($form, false, true, false, '', true, 1);  ?>
          </div>
        </div>
      </div>
    </section>
  <?php elseif( get_row_layout() == 'calculator' ): ?>
    <section class="calculator pad--vertical bg--offwhite">
      <div class="container">
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
          </header>
        </div>
        
        <div class="width--thin margin--top-half">
          <?php if(get_sub_field('calculator') == 'debt'): ?>
            <div class="calculator debt">
              <div class="form-group">
                <label>Annual Debt Service (monthly payment x 12)</label>
                <input placeholder="Please enter only numbers" type="number" class="debt-annual number"/>
              </div>
              <div class="form-group">
                <label>Previous December 31 gross income</label>
                <input placeholder="Please enter only numbers" type="number" class="debt-gross number"/>
              </div>
              <div class="form-group text--center">
                <a class="debt-calculate calculate btn hollow">Calculate My Debt to Income Ratio</a>
              </div>
              <div class="form-group form-total text--center">
                <p class="debt-total"><span class="percentage">0</span>%</p>
              </div>
            </div>
            
          <?php elseif(get_sub_field('calculator') == 'loan'): ?>
            <div class="calculator loan">
              <div class="form-group">
                <label>Loan request amount</label>
                <input placeholder="Please enter only numbers" type="number" class="loan-request"/>
              </div>
              <div class="form-group">
                <label>County valuation of property</label>
                <input placeholder="Please enter only numbers" type="number" class="loan-value"/>
              </div>
              <div class="form-group text--center">
                <a class="loan-calculate calculate btn hollow">Calculate My Loan to Value Ratio</a>
              </div>
              <div class="form-group form-total text--center">
                <p class="loan-total"><span class="percentage">0</span>%</p>
              </div>
            </div>
          <?php endif; ?>
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
    
  <?php elseif( get_row_layout() == 'content' ): ?>
  
    <section class="content margin--vertical width--max">
      <div class="content_container">
        <div class="width--thin margin--bottom-small">
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
    
  <?php elseif( get_row_layout() == 'faqs' ): ?>  
    <section class="faqs margin--top">
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
              <p><?=$content;?></p>
            </div>
          <?php $int = $int + 250; endwhile; ?>
        </div>
      </div>
    </section>
    
  <?php elseif( get_row_layout() == 'three_columns'): ?>
  
    <section class="three-column resources margin--vertical pad--vertical bg--offwhite">
      <div class="resources_container container">
        <div class="width--thin margin--bottom-small">
          <?php 
            $label = get_sub_field('header_label');
            $title = get_sub_field('header_title');
            $content = get_sub_field('header_content');
            $columns = get_sub_field('header_columns');
            $link = get_sub_field('header_link');
          ?>
          
          <header class="content-section_header section-header">
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
        
        <div class="resources margin--top-half">
          <?php $section = 'resources' ?>
     
                        
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
                <div class="resource" data-aos-delay="<?=$int?>" data-aos="fade-up" data-aos-anchor=".content-section_header">
                  <i class="icon-T icon"></i>
                  <h3><?=$title;?></h3>
                  <p><?=$content;?></p>
                  <a href="<?=$link['url'];?>" class="resource_link link" target="<?=$link['target'];?>"><?=$link['title'];?> ></a>
                </div>
              <?php $int = $int + 250; endwhile; ?>
            </div>
          <?php endif; ?>
  
        </div>
      </div>
    </section>  
    
  <?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>