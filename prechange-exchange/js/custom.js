  /* -------- preloader ------- */
  $(window).on("load", function () {
	"use strict";
	
	$('#preloader').delay(2000).fadeOut(500);
});
 

 /* ------------------ HEADER STICKY -----------------*/
  var last_known_scroll_position = 0;
  var navigation = document.querySelector("header");
  window.addEventListener('scroll', function (e) {
	  last_known_scroll_position = window.scrollY;
	  if (last_known_scroll_position > 50) {
		  navigation.classList.add("sticky");
	  } else {
		  navigation.classList.remove("sticky");
	  }
  });


/* ------------------ AOS animation -----------------*/

  AOS.init();

/* ------------------ Owl carosel -----------------*/  

$(document).ready(function() {
	$('.owl-carousel').owlCarousel({
	  loop: true,
	  margin: 10,
	  responsiveClass: true,
	  responsive: {
		0: {
		  items: 1,
		  nav: false,
		  dots:false,
		},
		600: {
		  items: 3,
		  nav: false,
		  dots:false,
		},
		1000: {
		  items: 4,
		  nav: false,
		  dots:false,
		  margin: 20,
		  loop: true,
		}
	  }
	})
  })


/* ------------------ FAQ -----------------*/  


  var $titleTab = $('.title_tab');
  $('.Accordion_item:eq(0)').find('.title_tab').addClass('active').next().stop().slideDown(300);
  $('.Accordion_item:eq(0)').find('.inner_content').find('p').addClass('show');
  $titleTab.on('click', function(e) {
  e.preventDefault();
	  if ( $(this).hasClass('active') ) {
		  $(this).removeClass('active');
		  $(this).next().stop().slideUp(500);
		  $(this).next().find('p').removeClass('show');
	  } else {
		  $(this).addClass('active');
		  $(this).next().stop().slideDown(500);
		  $(this).parent().siblings().children('.title_tab').removeClass('active');
		  $(this).parent().siblings().children('.inner_content').slideUp(500);
		  $(this).parent().siblings().children('.inner_content').find('p').removeClass('show');
		  $(this).next().find('p').addClass('show');
	  }
  });

/* ------------------ select -----------------*/  

  $(".my-select").chosen({
    width: "100%"
  });