/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
  
    //Update header parallax in real time
    wp.customize( 'setting_header_parallax_id', function( value ) {
      value.bind( function( newval ) {
        if (newval)
        {
          $('.home-page .parallax .parallax-fixed').css('position', 'fixed' );
        }
        else {
          $('.home-page .parallax .parallax-fixed').css('position', 'absolute' );        
        }
      } ); // End bind
      
    } ); // End wp.customize


    // Header height
    wp.customize( 'setting_header_height_id', function( value ) {
      value.bind( function( newval ) {
        $('.home-page .parallax, .home-page .parallax .parallax-fixed').css('height', newval + 'vh');
      } ); // End bind
    } ); // End wp.customize


    // Max height 
    var max_height = 600;
    var max_height_enable = true;
    
    // Bind enable
    function updateMaxheight () {
      var selector = '.home-page .parallax, .home-page .parallax .parallax-fixed';
      
      if (max_height_enable)
      {
        $(selector).css('max-height', max_height + 'px' );
      }
      else {
        $(selector).css('max-height', 'none' );
      }
    }

    wp.customize( 'setting_max_height_enable_id', function( value ) {
      value.bind( function( newval ) {
        max_height_enable = newval;
        updateMaxheight();
      } ); // End bind
    } ); // End wp.customize
    
    // Bind max-height
    wp.customize( 'setting_max_height_id', function( value ) {
      value.bind( function( newval ) {
        max_height = newval;
        updateMaxheight();
      } ); // End bind
    } ); // End wp.customize


    // Max width
    var max_width = 1440;
    var max_width_enable = true;
    
    // Bind enable
    function updateMaxWidth () {
      var selector = '.home-page .parallax .parallax-fixed, #wrapper-index .navbar-mobile, .home-page > .container-fluid';
      
      if (max_width_enable)
      {
        $(selector).css('max-width', max_width + 'px' );
      }
      else {
        $(selector).css('max-width', 'none' );
      }
    }

    wp.customize( 'setting_max_width_enable_id', function( value ) {
      value.bind( function( newval ) {
        max_width_enable = newval;
        updateMaxWidth();
      } ); // End bind
    } ); // End wp.customize
    
    // Bind max-width
    wp.customize( 'setting_max_width_id', function( value ) {
      value.bind( function( newval ) {
        max_width = newval;
        updateMaxWidth();
      } ); // End bind
    } ); // End wp.customize
    

    // Grid background color
    wp.customize( 'setting_grid_background_color_id', function( value ) {
      value.bind( function( newval ) {
        $('.home-page .custom-logo-link, .home-page .grid-item, .home-page > .container-fluid').css('background-color', newval);
      } ); // End bind
    } ); // End wp.customize
    
     // Navigation bar text color
     wp.customize( 'setting_navbar_text_color_id', function( value ) {
      value.bind( function( newval ) {
        $('.home-page .nav-pills .nav-link').css('color', newval);
      } ); // End bind
    } ); // End wp.customize
  
  } )( jQuery );
  