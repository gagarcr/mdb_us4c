
/*
    Variables
*/
barbaEnabled = false;
isotopeEnabled = true;

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
        grid = $('.grid');

        if (grid.length < 1) {
            throw new Error('Error finding grid!');
        }

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
                console.log("Filter: " + filterValue);             
                grid.isotope({ filter: filterValue });
            }
        });


        // Initialize isotope
        grid.isotope({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.grid-item',
            percentPosition: true,
            filter : '*',
            transitionDuration: '.4s',
            masonry: {
                // use element for option
                columnWidth: '.grid-sizer',
                gutter: 0,
            }
        }) // End grid.isotope

        // When all images are loaded, call layout
        grid.imagesLoaded(function(){
            grid.isotope('layout');
        });
            
        console.log("Grid arranged");
    }
}


function isotopeLayout($){
    if (isotopeEnabled) {
        grid = $('.grid');
        // Each time a new image is loaded, we layout the grid (progress call)
        // grid.imagesLoaded()
        //      .progress(grid.isotope('layout')); // End grid.imagesLoaded()
        
        // When all images are loaded (OK, or ERROR), we layout the grid
        grid.isotope('layout');

        console.log("Grid layout");
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
// TODO: move to top on changes
/*finish: function() {
    document.body.scrollTop = 0;
    this.done();
  }
  */
function barbaStart( $ ) {
//jQuery(document).ready(function( $ ) {
//document.addEventListener("DOMContentLoaded", function(event) {
    /* Main page fade */
    var IndexView = Barba.BaseView.extend({
        namespace: 'index',
        onEnter: function() {
            // The new Container is ready and attached to the DOM.
            console.log("Index enter");
            isotopeStart($);
        },
        onEnterCompleted: function() {
            // The Transition has just finished.
            // We call layout each time a new image is loaded
            isotopeLayout($);
        },
        onLeave: function() {
            // A new Transition toward a new page has just started.
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

            // As soon the loading is finished and the old page is faded out, let's fade the new page
            Promise
            .all([this.newContainerLoading, this.fadeOut()])
            .then(this.fadeIn.bind(this));
        },
    
        fadeOut: function() {
            /**
             * this.oldContainer is the HTMLElement of the old Container
             */
            console.log("Fade Out");
            return $(this.oldContainer).animate({ opacity: 0 }).promise();
        },
    
        fadeIn: function() {
            /**
             * this.newContainer is the HTMLElement of the new Container
             * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
             * Please note, newContainer is available just after newContainerLoading is resolved!
             */
            console.log("Fade In");

            var _this = this;
            var $el = $(this.newContainer);

            $(this.oldContainer).hide();

            $el.css({
                visibility : 'visible',
                opacity : 0
            });

            $el.animate({ opacity: 1 }, 400, function() {
                /**
                 * Do not forget to call .done() as soon your transition is finished!
                 * .done() will automatically remove from the DOM the old Container
                 */
        
                _this.done();
            });
        }
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
//}); /* JQuery ready */
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
        barbaStart($);
            
        console.log("Barba prefetch init");

        Barba.Pjax.start();
        Barba.Prefetch.init();
        console.log("Barba start");
    }
    else {
        isotopeStart($); // isotopeEnable check inside function
    }
}); // End jQuery
    

/**
 * --------------------------------------------------------------------------
 * DEBUG
 * --------------------------------------------------------------------------
 */

// Each time a new page is loaded by PJAX, show a log
Barba.Dispatcher.on('newPageReady', function(currentStatus, oldStatus, container) {    
    console.log("New page ready!");           
});