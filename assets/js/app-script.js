
$(function() {
    "use strict";
     
	 
//sidebar menu js
$.sidebarMenu($('.sidebar-menu'));

// === toggle-menu js
$(".toggle-menu").on("click", function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });	 
	   
// === sidebar menu activation js

$(function() {
        for (var i = window.location, o = $(".sidebar-menu a").filter(function() {
            return this.href == i;
        }).addClass("active").parent().addClass("active"); ;) {
            if (!o.is("li")) break;
            o = o.parent().addClass("in").parent().addClass("active");
        }
    }), 	   
	   

/* Top Header */

$(document).ready(function(){ 
    $(window).on("scroll", function(){ 
        if ($(this).scrollTop() > 60) { 
            $('.topbar-nav .navbar').addClass('bg-dark'); 
        } else { 
            $('.topbar-nav .navbar').removeClass('bg-dark'); 
        } 
    });

 });


/* Back To Top */

$(document).ready(function(){ 
    $(window).on("scroll", function(){ 
        if ($(this).scrollTop() > 300) { 
            $('.back-to-top').fadeIn(); 
        } else { 
            $('.back-to-top').fadeOut(); 
        } 
    }); 

    $('.back-to-top').on("click", function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
});	   
	    
   
$(function () {
  $('[data-toggle="popover"]').popover()
})


$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


	 // theme setting
	 $(".switcher-icon").on("click", function(e) {
        e.preventDefault();
        $(".right-sidebar").toggleClass("right-toggled");
    });
	
    $('#theme1').click(theme1);
    $('#theme2').click(theme2);
    $('#theme6').click(theme6);
    $('#theme7').click(theme7);
    $('#theme8').click(theme8);
    $('#theme9').click(theme9);

    function theme1() {
      $('body').attr('class', 'bg-theme bg-theme1');
    }

    function theme2() {
      $('body').attr('class', 'bg-theme bg-theme2');
    }

    function theme6() {
      $('body').attr('class', 'bg-theme bg-theme6');
    }

    function theme7() {
      $('body').attr('class', 'bg-theme bg-theme7');
    }

    function theme8() {
      $('body').attr('class', 'bg-theme bg-theme8');
    }
    function theme9() {
      $('body').attr('class', 'bg-theme bg-theme9');
    }


});

function sdbrItems(id){

  $('#'+id).slideToggle()
}