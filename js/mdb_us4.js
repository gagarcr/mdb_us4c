/*
    Variables
*/
barbaEnabled = true;
isotopeEnabled = true;
infiniteScrollEnabled = true;
mdb_debug = true;

/**
 * --------------------------------------------------------------------------
 * Infinite-Scroll
 * --------------------------------------------------------------------------
 */
if (typeof InfiniteScroll === 'undefined') {
  throw new Error('MDB_US4 theme require Infinite-Scroll');
}

function infiniteScrollStart($) {  
  if (infiniteScrollEnabled) {
    // Infinite-Scroll
    grid = $('.row.grid');
    var iso = grid.data('isotope');
   
   console.log("[InfiniteScroll] Initialization start");

    if (grid){
      console.log("Grid found");
      
      // Required in case re-initialization.
      if (typeof grid.data('infiniteScroll') !== 'undefined'){
        grid.infiniteScroll('destroy');            
      }
      
      grid.infiniteScroll({
        // options
        history: false,
        hideNav: '.pagination',     
        status: '.pagination-load-infinite',
        path: '.page-item a.next',
        append: '.post',
        checkLastPage: true,
        outlayer: iso,
        debug: false,
        //onInit: function() {
        //  console.log("[InfiniteScroll] Initialization complete");
        //
        //  this.on( 'append', function() {
        //    console.log("[InfiniteScroll] Append")
        //  });
        //},
      }); // End infiniteScroll

      // Integrate google Analitics
      if (typeof ga !== 'undefined') {
        grid.on( 'history.infiniteScroll', function() {
          ga( 'set', 'page', location.pathname );
          ga( 'send', 'pageview' );
        });
      }          
    } // End if mainContainer
          
  }
}




/**
 * --------------------------------------------------------------------------
 * Isotope.js
 * --------------------------------------------------------------------------
 */

//Check for Isotope dependency
if (typeof Isotope === 'undefined') {
    throw new Error('MDB_US4 theme require Isotope.js');
}

// Check imagesLoaded dependecy
if (typeof imagesLoaded === 'undefined'){
    throw new Error('MDB_US4 theme require imagesLoaded');
}

// Every time we enter in home view, we should call this function so that the
// cards are properly arranged
function isotopeStart($) {  
  if (isotopeEnabled) {
    /* Start Isotope */
    grid = $('.row.grid');

    if (grid.length < 1) {
        throw new Error('[Isotope] Error finding grid!');
    }

    // Initialize isotope
    grid.isotope({
      // set itemSelector so .grid-sizer is not used in layout
      itemSelector: '.grid-item',
      percentPosition: true,
      filter : '*',
      transitionDuration: '.4s',
      getSortData: {
        order: '[order] parseInt' // Attribute [order]
      },
      sortBy : 'order',
      //layoutMode: 'packery'
      masonry: {
          // use element for option
          columnWidth: '.grid-sizer',
          gutter: 0,
      }
    }) // End grid.isotope
  
    // Each time a image is loaded, call layout
    grid.imagesLoaded().progress( function() {
      grid.isotope('layout');
      console.log("[Isotope] New image loaded .... layout");
    });

    // When all images are loaded, call layout
    grid.imagesLoaded(function(){
      console.log("[Isotope] All images loaded");
    });

    /* Link filter button with behavior */
    $('.filter-button-group').on( 'click', 'a', function() {   
      // Check if is already active
      if ($(this).hasClass("active")){
        $(this).removeClass("active");
        grid.isotope({ filter: "*" });
      }
      else {
        // Remove the "active" class of the other buttons
        $('.filter-button-group').find("a.active").each( function () {
            $(this).removeClass("active");
        });
        // Set to this button
        $(this).addClass("active");
        // Get the filter
        var filterValue = $(this).attr('data-filter');   
        console.log("[Isotope] Filter: " + filterValue);             
        grid.isotope({ filter: filterValue });
      }
    });

    console.log("[Isotope] Initialized OK");
  }
}

/**
 * --------------------------------------------------------------------------
 * Barba.js
 * --------------------------------------------------------------------------
 */

//Check for Barba dependency
if (typeof Barba === 'undefined') {
    throw new Error('Mdb_us4 theme require Barba.js (https://Barba.js.org)');
}

/* Barba Js Views: we can use namespace="page" so that different pages behaves differnty.
*/
function barbaStart( $ ) {
  /* Main page fade */
  var IndexView = Barba.BaseView.extend({
      namespace: 'index',
      onEnter: function() {
        // The new Container is ready and attached to the DOM.
        console.log("[Barba] IndexView enter");
        
        try {
          isotopeStart($);
          console.log("[Barba] Isotope initialized.");
          
        }
        catch(err) {
            console.log("[Barba] Could not initilze isotope: " + err);
        }

        
        
      },
      onEnterCompleted: function() {
          // The Transition has just finished.
          console.log("onEnterCompleted");
          
          // Start infinite scroll. AFTER ISOTOPE AND AFTER DOM COMPLETED
          infiniteScrollStart( $ )
  
          // Scroll to index
          if (typeof ($scrollHomeValue) !== 'undefined')
          {
              console.log("[Barba] Scroll to previous index: " + $scrollHomeValue);
              window.scrollTo(0, $scrollHomeValue);
          }
      },
      onLeave: function() {
          // A new Transition toward a new page has just started.
          // Store the scroll index 
          $scrollHomeValue = window.scrollY;
          console.log("[Barba] Store new scroll index: " + $scrollHomeValue);
      },
      onLeaveCompleted: function() {
          // The Container has just been removed from the DOM.
      }
  });

  // Don't forget to init the view (index)!
  IndexView.init();

  // Create a fade transition
  var FadeTransition = Barba.BaseTransition.extend({
    start: function() {
      /**
       * This function is automatically called as soon the Transition starts
       * this.newContainerLoading is a Promise for the loading of the new container
       * (Barba.js also comes with an handy Promise polyfill!)
       */

      // As soon the loading is finished and the old page is faded out, 
      // let's fade the new page.
      // The .all method creates a new promise that gets resolved as soon as all
      // promises included as arguments are resolved.
      Promise
        //.all([this.newContainerLoading,  this.fadeOut(), this.scrollTop()])
        //.then(this.fadeIn.bind(this));
        .all([this.newContainerLoading, this.veilInTransition()])
        .then(this.scrollTop.bind(this))
        .then(this.veilOutTransition.bind(this))
        ;
    },

    scrollSmoothTop: function() {
      var deferred = Barba.Utils.deferred();
      var obj = { y: window.pageYOffset };

      TweenLite.to(obj, 0.4, {
        y: 0,
        onUpdate: function() {
          if (obj.y === 0) {
            deferred.resolve();
          }

          window.scroll(0, obj.y);
        },
        onComplete: function() {
          deferred.resolve();
        }
      });
      
      //deferred.resolve();
    return deferred.promise;
    },

    scrollTop: function() {
      window.scroll(0, 0);
    },


    
    veilInTransition: function() {
      var p = Barba.Utils.deferred();
      
      // Remove any posible modal backdrop
      $('.modal').modal('hide')

      // Loader fade in transition 
      var obj = $('#loader-spinner');
      obj.css({
        top: 0,
        opacity: 1,
      });   

      // Fallback in case transitionend is not suported 
      var fallbackTimeout = setTimeout(function (){
        obj.removeAttr('style');
        console.log("[Barba] Transitionend fallback");
        p.resolve();
      }, 2000);

      // Wait for css transition to finish 
      obj.one('transitionend', function (e) {
        clearTimeout(fallbackTimeout);            
        console.log("[Barba] Fade in complete");
        p.resolve();
      });

      // JQuery animation 
      /*
      $(this.oldContainer).animate({ opacity: 0 }, 1000, function (){
        console.log("Fade in complete");
        p.resolve();
        
      });*/
      
      return p.promise;
    },

    veilOutTransition: function() {
      var p = Barba.Utils.deferred();
      
      console.log("[Barba] Veil out");

      var _this = this;
      var $el = $(this.newContainer);
      var obj = $('#loader-spinner');
      
      // Destroy old container
      _this.done();

      // New container visible
      $el.css({
        visibility : 'visible',
      });   
      
      // Start loader fade transition
      obj.css({
        opacity: 0,
      });   

      // Fallback in case transitionend is not suported
      var fallbackTimeout = setTimeout(function (){
        obj.removeAttr('style');
        console.log("[Barba] Transitionend fallback");
        p.resolve();
      }, 2000);
        
      // Wait for css transition to finish
      obj.one('transitionend', function (e) {           
        obj.removeAttr('style');            
        clearTimeout(fallbackTimeout);
        console.log("[Barba] Fade out complete");
        p.resolve();
      });


      //setTimeout(function (){
        /* JQuery animation */
        //$el.animate({ opacity: 1 }, 1300, function() {
          /**
           * Do not forget to call .done() as soon your transition is finished!
           * .done() will automatically remove from the DOM the old Container
           */
    
        //  console.log("Veil out complete");
          // p.resolve();            
        //});
      //}, 8000);

      return p.promise;
    },
  }); /* Base transition extend */
  
  /**
   * Next step, you have to tell Barba to use the new Transition
   */

  Barba.Pjax.getTransition = function() {
    /**
     * Here you can use your own logic!
     * For example you can use different Transition based on the current page or link...
     */

    return FadeTransition;
  };
};

/**
 * --------------------------------------------------------------------------
 * MAIN
 * --------------------------------------------------------------------------
 */


/* On document ready, start isotope and then initialize barba.js */
jQuery(document).ready(function( $ ) {
    /* Start barba.js */
    if (barbaEnabled) { 
        //It's suggested to .init() the Views before calling Pjax.start()
        // In this way Pjax.start() will emit onEnter() and onEnterCompleted() for the current view.
        try {
            barbaStart($);

            Barba.Pjax.start();

            // Start prefecth 
            console.log("[Barba] Prefetch init");
            Barba.Prefetch.init();
         
        }
        catch(err) {
            console.log("[Barba] Could not be initialized: " + err);
            // Go into fallback functions
            mdb_us4_fallback( $ );
        }
    }
    else {
        // Go into fallback functions
        mdb_us4_fallback( $ );
       
    }



}); // End jQuery
    

// Each time a new page is loaded by PJAX, show a log
Barba.Dispatcher.on('newPageReady', function(currentStatus, oldStatus, container) {    
  console.log("[Barba] New page ready");
    var $ = jQuery;
    
    if (mdb_debug) {
      // Gulp does not convert ajax links correctly
      if ((window.location.href.includes("localhost")) || (window.location.origin.includes("192.168.")) ){   
        $('body a[href*="vccw.dev"]').each(function() {
          $(this).attr('href', $(this).attr('href').replace('vccw.dev', window.location.origin.replace("http://", "")));        
        });
      }
    }

    mdb_us4_initFunctions( $ );            
});


/**
 * --------------------------------------------------------------------------
 * Common funcions
 * --------------------------------------------------------------------------
 */

// Common JS initialization functions.
// Each time a new page is loaded, this should be called
function mdb_us4_initFunctions( $ ){
  console.log("Start common functions");

  // Start smooth scroll button (ex: single post arrow)
  mdb_us4_scrollSmooth( $ );
   
  // Start tooltips
  $('[data-toggle="tooltip"]').tooltip(); 

  // Start infinite scroll
  infiniteScrollStart( $ );

};

// Fallback function that loads everithing done by Barba.js.
function mdb_us4_fallback ( $ ) {
  console.log("Start fallback");

  // Start isotope 
  try {
      isotopeStart($); // isotopeEnable check inside function
      console.log("Isotope initialized");
  }     
  catch(err) {
      console.log("Could not initialize isotope: " + err);
  }

  mdb_us4_initFunctions($);
}; 

// Initialize the scroll down arrow behavior
function mdb_us4_scrollSmooth( $ ) {
    console.log("ScrollSmooth load");

    $('.scroll-arrow').click(function( event) {
        console.log("Scroll smooth");
        var sectionTo = $(this).attr('href');
        //sectionTo.animatedScroll({easing: "easeOutExpo"});
        $('html, body').animate({
            scrollTop: $(sectionTo).offset().top
         }, 1000);
         event.preventDefault();
    });
};



/**
 * --------------------------------------------------------------------------
 * DEBUG
 * --------------------------------------------------------------------------
 */