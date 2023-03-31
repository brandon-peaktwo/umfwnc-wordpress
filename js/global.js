/* ==========================================================================
 Document Ready
 ========================================================================== */
jQuery(document).ready(function($){

  /**** Global Elements ****/
  
  /* Global Variables */
  var $window       = $(window);
  var body          = $('body');
  var globalHeader  = $('header.global');
  var globalFooter  = $('footer.global');
  
  /* Navigation */
  
  /* Main Menu */
  var menu = jQuery('nav.overlay');
  var menuTopLevel = jQuery('nav.overlay .right .menu > li');
  var menuParent = jQuery('nav.overlay .right .menu-item-has-children');
  var menuParentTrigger = jQuery('nav.overlay .right .menu-item-has-children > a');
  var subMenu = jQuery('nav.overlay .right .sub-menu');
  var subMenuCloseHTML = '<a href="#" class="sub-menu-close">‹ Back</a>';
  var desktopMenu = jQuery('nav.primary .menu > .menu-item-has-children');
  var desktopMenuTopLevel = jQuery('nav.primary .menu > .menu-item-has-children > a');
  
  // Open Menu
  jQuery('#mobile-nav-toggle').click(function(event){
    event.preventDefault();
    
    event.stopPropagation();
    
    body.addClass('noscroll');
		
		menu.fadeIn();
		
		menu.click(function(event){
      event.stopPropagation();
    });
	});
	
	// Close Menu
	jQuery('#menu-close').click(function(event){
    event.preventDefault();
		
		menu.fadeOut();
		
    body.removeClass('noscroll');
	});
  
  var toggle = jQuery('#menu-close'),
	 		isVisible = toggle.is(':visible');	 
	
  // Open Sub-menu on mobile
  menuParentTrigger.click(function(event) {
    var parent = jQuery(this).parent();
    var nextSubMenu = jQuery(this).next('.sub-menu');
    
    event.preventDefault();
    
    if (! parent.hasClass('active')) {
      menuParent.removeClass('active');
      //subMenu.slideUp();
      //subMenu.animate({opacity: '0'});
    }
    
    parent.toggleClass('active');
    
    if( body.outerWidth() > 1039 ) {
      nextSubMenu.slideToggle();
    } else {
      nextSubMenu.children('li:first-child').prepend(subMenuCloseHTML);
      menuTopLevel.animate({margin: '0 314 10px -314px'});
      //nextSubMenu.animate({width:'toggle'});
      nextSubMenu.toggleClass('visible');
      //subMenu.animate({opacity: '1'});
    }
  });
  
  // Close sub-menu
  subMenu.on( "click", ".sub-menu-close", function(event) { 
    var subMenu = jQuery(this).parents('.sub-menu');
    
    event.preventDefault();
    
    menuParent.removeClass('active');
    menuTopLevel.animate({margin: '0 0 10px 0'});
    //subMenu.animate({width:'toggle'});
    subMenu.toggleClass('visible');
    
    setTimeout(function(){
      jQuery('.sub-menu-close').remove();
    }, 400);
  });  
  
  // Open Sub-menu on desktop.
/*
  desktopMenu.hover(
    function(event) {
      var hoverMenu = jQuery(this).find('> .sub-menu'),
          hoverMenuWidth = hoverMenu.outerWidth() / 2
            
      hoverMenu.stop(false).delay(3000).css({
//           'marginLeft' : -Math.abs(hoverMenuWidth),
          'maxHeight' : '900px'
      });
      jQuery(this).find('> .sub-menu').stop(true).addClass('hovered');
      
    },
    function(event) {
      jQuery(this).find('> .sub-menu').stop(false).delay(3000).css({
        'maxHeight': '0px'
      });
      jQuery(this).find('> .sub-menu').stop(true).removeClass('hovered');
    }
  );
*/
  
  // Set click behavior for menu parents
  desktopMenuTopLevel.click(function(e){
    e.preventDefault();
    
    if( $(this).hasClass('active') )
    {
      desktopMenuTopLevel.removeClass('active');
    
      desktopMenuTopLevel.next('.sub-menu').removeClass('hovered');
    } else {
      desktopMenuTopLevel.removeClass('active');
    
      desktopMenuTopLevel.next('.sub-menu').removeClass('hovered');
      $(this).addClass('active');
      $(this).next('.sub-menu').addClass('hovered');
    }
  });
  
  // Kill submenus with any click outside of the nav
  $(document).mouseup(function(e) 
  {
    var nav = $('nav.primary');

    if (! nav.is(e.target) && nav.has(e.target).length === 0) 
    {
      desktopMenuTopLevel.removeClass('active');
    
      desktopMenuTopLevel.next('.sub-menu').removeClass('hovered');
    }
  });
  
  // Append Large Menu Items to Primary Nav Submenus
  $window.on('load', function(){
  	var subMenuItems = $('.submenu-items');
  	
  	subMenuItems.each(function(){
    	var menuTarget = $(this).attr('data-menu');
    	var menu = $('nav.primary').find('.' + menuTarget);
    	var subMenu = menu.find('> .sub-menu');
    	var subMenuImage = $(this).find('.submenu-image');
    	var menuItems = subMenu.find('> .menu-item');
    	
//     	subMenu.wrapAll("<div class='menu-wrapper' />");
    	menuItems.wrapAll("<div class='menu-items' />");
      subMenuImage.prependTo(subMenu);
  	});
  });

  
  // Kill clicks on submenu parents on desktop
  $('.menu-primary-menu .menu-item-has-children a').on( "click", function(event) { 
    event.preventDefault();
  }); 
  
  // Intialize Scroll Intent 
  $window.scrollIntent();
  
  
  // Back To Top Button
  $(document).on('click', '#back_top', function (event) {
    event.preventDefault();

    $('html, body').animate({
      scrollTop: 0
    }, 500);
  });
  
  // Smooth scroll to anchor point
  $(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
      scrollTop: $($.attr(this, 'href')).offset().top - 80
    }, 500);
  });
  
  // Add class to header on scroll 
  $window.scroll(function(){
    if( $window.scrollTop() >= 350 ) {
      globalHeader.addClass('scrolled');
    } else {
      globalHeader.removeClass('scrolled');
    }
  });
  
  // Kill clicks on footer menu parent items
  var columnHeader = $('nav.footer .column > a');
  
  columnHeader.click(function(e) {
    e.preventDefault();
  });
  
  /* Modals */
  var openModal   = $('.modal-open');
  var closeModal  = $('.modal-close');
  
  openModal.click(function(e){
    var id    = $(this).attr('data-id');
    var modal = $('.modal[data-id="'+id+'"]');
    
    e.preventDefault();
    
    body.addClass('noscroll');
    
    modal.addClass('open');
    
    var slideno = $(this).data('slide');
    
    $('.team-carousel').slick('slickGoTo', slideno);
  });
  
  closeModal.click(function(e){
    var modal   = $(this).parents('.modal');
    var iframe  = modal.contents().find('iframe');
    
    e.preventDefault();
    
    modal.removeClass('open');
    
    body.removeClass('noscroll');
    
    if( iframe.length )
    {
      $(iframe).attr("src", $(iframe).attr("src")); // strip and replace the src of the iframe when modal is closed
    }
  });
  
  $window.on('load resize', function (event) {
    if ($window.width() > 992) {
      /* Initialize Rellax */
      // Handling Parallaxy Animations
      var rellax = new Rellax('.parallax', {
        center: true,
        speed: -.5,
      });
      
      // Handling Parallaxy Animations
      var rellax = new Rellax('.parellax', {
        center: true,
        speed: .5,
      });
    };
  });
  
  
  /* Initialize AOS */
  AOS.init({
    offset: 0,
    duration: 300,
    easing: 'ease-in-sine',
    delay: 0,
    disable: 'mobile',
    once: true,
  });
  
  
  /* Fade In Main Sections */
  var mainSection = $('.section--main');
  
  mainSection.each(function() {
    var $this = $(this);
    $window.scroll(function(){
      if( topIsInViewport( $this ) ) {
        $this.addClass('animated');
      }
    });
  });
  
  
  /* Calculator Formatting */
  $('input.fumber').keyup(function(event) {

    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;
  
    // format number
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });
  
  
  /* Debt to Income Calculator */
  var debtCalc = $('.calculator.debt');
  
  debtCalc.each(function() {
    var $this = $(this);
    var calculate = $this.find('.calculate'); 
    var debtRatio = $this.find('.debt-total .percentage');
    
    calculate.on("click", function(e) {
      e.preventDefault();
      var debtService = parseInt($this.find('.debt-annual').val());
      var grossIncome = parseInt($this.find('.debt-gross').val());
      var calculation = debtService / grossIncome;
      
      debtRatio.text(calculation);
      console.log(debtService);
    });
  });
  


  /* Loan to Value Calculator */
  var loanCalc = $('.calculator.loan');
  
  loanCalc.each(function() {
    var $this = $(this);
    var calculate = $this.find('.calculate'); 
    var loanRatio = $this.find('.loan-total .percentage');
    
    calculate.on("click", function(e) {
      e.preventDefault();
      var loanRequest = parseInt($this.find('.loan-request').val());
      var loanValue = parseInt($this.find('.loan-value').val());
      var calculation = loanRequest / loanValue;
      
      loanRatio.text(calculation);
    });
  });

  
  /* Speakers Carousel */
  var carouselContainer = $('.team-members');
  var carouselSlides = carouselContainer.find('.team-carousel');
  var carouselPrev = carouselContainer.find('.prev-slide');
  var carouselNext = carouselContainer.find('.next-slide');
  
  if (carouselContainer.length) {
    var bioNavItem = $('.team-members .controls .control');
    var deadItem   = $('.no-modal');
    var scrollBox  = carouselSlides.parent('.scroll');
    
    deadItem.click(function(e) {
      e.preventDefault();  
    });
    
    $(carouselSlides).slick({
      prevArrow: carouselPrev,
      nextArrow: carouselNext,    
      dots: false,
      controls: false,
      arrow: true,
      adaptiveHeight: true,
      infinite: true,
      speed: 300,
      zIndex: -1,
      fade: true,
      slidesToShow:1,
      slidesToScroll: 1
    });
    
    bioNavItem.click(function() {
      scrollBox.scrollTop(0);
    });
  };

  
  /* Accordion */
  var accordion = $('.accordion');
  
  accordion.each(function() {
    var $this = $(this);
    var toggle = $(this).find('.accordion_toggle');
    var content = $(this).find('.accordion_content');
    
    toggle.on("click", function() {
   	 $this.toggleClass("active");
   	 content.slideToggle();
    });
  });
  
  
  /* Tabs */
  var tabs = $('.tab_wrapper');
  
  tabs.each(function() {
    var $this = $(this);
    var navItem = $('.tab_nav-item');
    var tab = $('.tab_content');
    
    navItem.on("click", function() {
      var tab_id = $(this).attr('data-tab');
      //$this.toggleClass("active");

  		navItem.removeClass('current');
  		tab.removeClass('current');
  
  		$(this).addClass('current');
  		$("#"+tab_id).addClass('current');
    });
  });
});

/* ==========================================================================
   Functions
  ========================================================================== */
 
/* Equalize Element Heights */
function equalizeHeight(element){
  var maxHeight = 0;

  jQuery(element).each(function(){
     if (jQuery(this).height() > maxHeight) { maxHeight = jQuery(this).height(); }
  });
  
  jQuery(element).height(maxHeight);
}

/* Check if an element has scrolled into view */
function isInViewport(element)
{
  var viewportTop = jQuery(window).scrollTop();
  var viewportBottom = viewportTop + jQuery(window).height();

  var elementTop = jQuery(element).offset().top;
  var elementBottom = elementTop + (jQuery(element).outerHeight());

  return ((elementBottom <= viewportBottom) && (elementTop >= viewportTop));
}

/* Check if an the top of an element has scrolled into view */
function topIsInViewport(element)
{
  var viewportTop = jQuery(window).scrollTop();
  var viewportBottom = viewportTop + jQuery(window).height();

  var elementTop = jQuery(element).offset().top;

  return ((elementTop <= viewportBottom));
}

function isVisible(element) 
{
  var $this = element;
  
  if($this.css('display') == 'none' ) {
    //return true;
  } else {
    //return false;
  }
  
  var window      = jQuery(window),
      windowWidth = document.documentElement.clientWidth;;
  if(windowWidth <= 1080) {
    return false;
  } else {
    return true;
  }
}


function isNotPhone() 
{  
  var window      = jQuery(window),
      windowWidth = document.documentElement.clientWidth;;
  if(windowWidth <= 760) {
    return false;
  } else {
    return true;
  }
}

function autoScroll(targetElement, speed) {
  var scrollWidth = jQuery(targetElement).get(0).scrollWidth;
  var clientWidth = jQuery(targetElement).get(0).clientWidth;
  jQuery(targetElement).animate({ scrollLeft: scrollWidth - clientWidth },
  {
    duration: speed,
    complete: function () {
      targetElement.animate({ scrollLeft: 0 },
      {
        duration: speed,
        complete: function () {
            autoScroll(targetElement, speed);
        }
      });
    }
  });
};

function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  var results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};