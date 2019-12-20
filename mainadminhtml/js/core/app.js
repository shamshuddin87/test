/* ------------------------------------------------------------------------------
*
*  # Template JS core
*
*  Core JS file with default functionality configuration
*
*  Version: 1.1
*  Latest update: Oct 20, 2015
*
* ---------------------------------------------------------------------------- */

website(function() {


    // ========================================
    //
    // Layout
    //
    // ========================================


    // Calculate page container height
    // -------------------------

    // Window height - navbars heights
    function containerHeight() {
        var availableHeight = website(window).height() - website('body > .navbar').outerHeight() - website('body > .navbar-fixed-top:not(.navbar)').outerHeight() - website('body > .navbar-fixed-bottom:not(.navbar)').outerHeight() - website('body > .navbar + .navbar').outerHeight() - website('body > .navbar + .navbar-collapse').outerHeight();

        website('.page-container').attr('style', 'min-height:' + availableHeight + 'px');
    }




    // ========================================
    //
    // Heading elements
    //
    // ========================================


    // Heading elements toggler
    // -------------------------

    // Add control button toggler to page and panel headers if have heading elements
    website('.panel-heading, .page-header-content, .panel-body').has('> .heading-elements').append('<a class="heading-elements-toggle"><i class="icon-menu"></i></a>');


    // Toggle visible state of heading elements
    website('.heading-elements-toggle').on('click', function() {
        website(this).parent().children('.heading-elements').toggleClass('visible');
    });



    // Breadcrumb elements toggler
    // -------------------------

    // Add control button toggler to breadcrumbs if has elements
    website('.breadcrumb-line').has('.breadcrumb-elements').append('<a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>');


    // Toggle visible state of breadcrumb elements
    website('.breadcrumb-elements-toggle').on('click', function() {
        website(this).parent().children('.breadcrumb-elements').toggleClass('visible');
    });




    // ========================================
    //
    // Navbar
    //
    // ========================================


    // Navbar navigation
    // -------------------------

    // Prevent dropdown from closing on click
    website(document).on('click', '.dropdown-content', function (e) {
        e.stopPropagation();
    });

    // Disabled links
    website('.navbar-nav .disabled a').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Show tabs inside dropdowns
    website('.dropdown-content a[data-toggle="tab"]').on('click', function (e) {
        website(this).tab('show');
    });




    // ========================================
    //
    // Element controls
    //
    // ========================================


    // Reload elements
    // -------------------------

    // Panels
    website('.panel [data-action=reload]').click(function (e) {
        e.preventDefault();
        var block = website(this).parent().parent().parent().parent().parent();
        website(block).block({ 
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait',
                'box-shadow': '0 0 0 1px #ddd'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });

        // For demo purposes
        window.setTimeout(function () {
           website(block).unblock();
        }, 2000); 
    });


    // Sidebar categories
    website('.category-title [data-action=reload]').click(function (e) {
        e.preventDefault();
        var block = website(this).parent().parent().parent().parent();
        website(block).block({ 
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.5,
                cursor: 'wait',
                'box-shadow': '0 0 0 1px #000'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none',
                color: '#fff'
            }
        });

        // For demo purposes
        window.setTimeout(function () {
           website(block).unblock();
        }, 2000); 
    }); 


    // Light sidebar categories
    website('.sidebar-default .category-title [data-action=reload]').click(function (e) {
        e.preventDefault();
        var block = website(this).parent().parent().parent().parent();
        website(block).block({ 
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait',
                'box-shadow': '0 0 0 1px #ddd'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });

        // For demo purposes
        window.setTimeout(function () {
           website(block).unblock();
        }, 2000); 
    }); 



    // Collapse elements
    // -------------------------

    //
    // Sidebar categories
    //

    // Hide if collapsed by default
    website('.category-collapsed').children('.category-content').hide();


    // Rotate icon if collapsed by default
    website('.category-collapsed').find('[data-action=collapse]').addClass('rotate-180');


    // Collapse on click
    website('.category-title [data-action=collapse]').click(function (e) {
        e.preventDefault();
        var websitecategoryCollapse = website(this).parent().parent().parent().nextAll();
        website(this).parents('.category-title').toggleClass('category-collapsed');
        website(this).toggleClass('rotate-180');

        containerHeight(); // adjust page height

        websitecategoryCollapse.slideToggle(150);
    });


    //
    // Panels
    //

    // Hide if collapsed by default
    website('.panel-collapsed').children('.panel-heading').nextAll().hide();


    // Rotate icon if collapsed by default
    website('.panel-collapsed').find('[data-action=collapse]').children('i').addClass('rotate-180');


    // Collapse on click
    website('.panel [data-action=collapse]').click(function (e) {
        e.preventDefault();
        var websitepanelCollapse = website(this).parent().parent().parent().parent().nextAll();
        website(this).parents('.panel').toggleClass('panel-collapsed');
        website(this).toggleClass('rotate-180');

        containerHeight(); // recalculate page height

        websitepanelCollapse.slideToggle(150);
    });



    // Remove elements
    // -------------------------

    // Panels
    website('.panel [data-action=close]').click(function (e) {
        e.preventDefault();
        var websitepanelClose = website(this).parent().parent().parent().parent().parent();

        containerHeight(); // recalculate page height

        websitepanelClose.slideUp(150, function() {
            website(this).remove();
        });
    });


    // Sidebar categories
    website('.category-title [data-action=close]').click(function (e) {
        e.preventDefault();
        var websitecategoryClose = website(this).parent().parent().parent().parent();

        containerHeight(); // recalculate page height

        websitecategoryClose.slideUp(150, function() {
            website(this).remove();
        });
    });




    // ========================================
    //
    // Main navigation
    //
    // ========================================


    // Main navigation
    // -------------------------

    // Add 'active' class to parent list item in all levels
    website('.navigation').find('li.active').parents('li').addClass('active');

    // Hide all nested lists
    website('.navigation').find('li').not('.active, .category-title').has('ul').children('ul').addClass('hidden-ul');

    // Highlight children links
    website('.navigation').find('li').has('ul').children('a').addClass('has-ul');

    // Add active state to all dropdown parent levels
    website('.dropdown-menu:not(.dropdown-content), .dropdown-menu:not(.dropdown-content) .dropdown-submenu').has('li.active').addClass('active').parents('.navbar-nav .dropdown:not(.language-switch), .navbar-nav .dropup:not(.language-switch)').addClass('active');

    

    // Main navigation tooltips positioning
    // -------------------------

    // Left sidebar
    website('.navigation-main > .navigation-header > i').tooltip({
        placement: 'right',
        container: 'body'
    });



    // Collapsible functionality
    // -------------------------

    // Main navigation
    website('.navigation-main').find('li').has('ul').children('a').on('click', function (e) {
        e.preventDefault();

        // Collapsible
        website(this).parent('li').not('.disabled').not(website('.sidebar-xs').not('.sidebar-xs-indicator').find('.navigation-main').children('li')).toggleClass('active').children('ul').slideToggle(250);

        // Accordion
        if (website('.navigation-main').hasClass('navigation-accordion')) {
            website(this).parent('li').not('.disabled').not(website('.sidebar-xs').not('.sidebar-xs-indicator').find('.navigation-main').children('li')).siblings(':has(.has-ul)').removeClass('active').children('ul').slideUp(250);
        }
    });

        
    // Alternate navigation
    website('.navigation-alt').find('li').has('ul').children('a').on('click', function (e) {
        e.preventDefault();

        // Collapsible
        website(this).parent('li').not('.disabled').toggleClass('active').children('ul').slideToggle(200);

        // Accordion
        if (website('.navigation-alt').hasClass('navigation-accordion')) {
            website(this).parent('li').not('.disabled').siblings(':has(.has-ul)').removeClass('active').children('ul').slideUp(200);
        }
    }); 




    // ========================================
    //
    // Sidebars
    //
    // ========================================


    // Mini sidebar
    // -------------------------

    // Toggle mini sidebar
    website('.sidebar-main-toggle').on('click', function (e) {
        e.preventDefault();

        // Toggle min sidebar class
        website('body').toggleClass('sidebar-xs');
    });



    // Sidebar controls
    // -------------------------

    // Disable click in disabled navigation items
    website(document).on('click', '.navigation .disabled a', function (e) {
        e.preventDefault();
    });


    // Adjust page height on sidebar control button click
    website(document).on('click', '.sidebar-control', function (e) {
        containerHeight();
    });


    // Hide main sidebar in Dual Sidebar
    website(document).on('click', '.sidebar-main-hide', function (e) {
        e.preventDefault();
        website('body').toggleClass('sidebar-main-hidden');
    });


    // Toggle second sidebar in Dual Sidebar
    website(document).on('click', '.sidebar-secondary-hide', function (e) {
        e.preventDefault();
        website('body').toggleClass('sidebar-secondary-hidden');
    });


    // Hide detached sidebar
    website(document).on('click', '.sidebar-detached-hide', function (e) {
        e.preventDefault();
        website('body').toggleClass('sidebar-detached-hidden');
    });


    // Hide all sidebars
    website(document).on('click', '.sidebar-all-hide', function (e) {
        e.preventDefault();

        website('body').toggleClass('sidebar-all-hidden');
    });



    //
    // Opposite sidebar
    //

    // Collapse main sidebar if opposite sidebar is visible
    website(document).on('click', '.sidebar-opposite-toggle', function (e) {
        e.preventDefault();

        // Opposite sidebar visibility
        website('body').toggleClass('sidebar-opposite-visible');

        // If visible
        if (website('body').hasClass('sidebar-opposite-visible')) {

            // Make main sidebar mini
            website('body').addClass('sidebar-xs');

            // Hide children lists
            website('.navigation-main').children('li').children('ul').css('display', '');
        }
        else {

            // Make main sidebar default
            website('body').removeClass('sidebar-xs');
        }
    });


    // Hide main sidebar if opposite sidebar is shown
    website(document).on('click', '.sidebar-opposite-main-hide', function (e) {
        e.preventDefault();

        // Opposite sidebar visibility
        website('body').toggleClass('sidebar-opposite-visible');
        
        // If visible
        if (website('body').hasClass('sidebar-opposite-visible')) {

            // Hide main sidebar
            website('body').addClass('sidebar-main-hidden');
        }
        else {

            // Show main sidebar
            website('body').removeClass('sidebar-main-hidden');
        }
    });


    // Hide secondary sidebar if opposite sidebar is shown
    website(document).on('click', '.sidebar-opposite-secondary-hide', function (e) {
        e.preventDefault();

        // Opposite sidebar visibility
        website('body').toggleClass('sidebar-opposite-visible');

        // If visible
        if (website('body').hasClass('sidebar-opposite-visible')) {

            // Hide secondary
            website('body').addClass('sidebar-secondary-hidden');

        }
        else {

            // Show secondary
            website('body').removeClass('sidebar-secondary-hidden');
        }
    });


    // Hide all sidebars if opposite sidebar is shown
    website(document).on('click', '.sidebar-opposite-hide', function (e) {
        e.preventDefault();

        // Toggle sidebars visibility
        website('body').toggleClass('sidebar-all-hidden');

        // If hidden
        if (website('body').hasClass('sidebar-all-hidden')) {

            // Show opposite
            website('body').addClass('sidebar-opposite-visible');

            // Hide children lists
            website('.navigation-main').children('li').children('ul').css('display', '');
        }
        else {

            // Hide opposite
            website('body').removeClass('sidebar-opposite-visible');
        }
    });


    // Keep the width of the main sidebar if opposite sidebar is visible
    website(document).on('click', '.sidebar-opposite-fix', function (e) {
        e.preventDefault();

        // Toggle opposite sidebar visibility
        website('body').toggleClass('sidebar-opposite-visible');
    });



    // Mobile sidebar controls
    // -------------------------

    // Toggle main sidebar
    website('.sidebar-mobile-main-toggle').on('click', function (e) {
        e.preventDefault();
        website('body').toggleClass('sidebar-mobile-main').removeClass('sidebar-mobile-secondary sidebar-mobile-opposite sidebar-mobile-detached');
    });


    // Toggle secondary sidebar
    website('.sidebar-mobile-secondary-toggle').on('click', function (e) {
        e.preventDefault();
        website('body').toggleClass('sidebar-mobile-secondary').removeClass('sidebar-mobile-main sidebar-mobile-opposite sidebar-mobile-detached');
    });


    // Toggle opposite sidebar
    website('.sidebar-mobile-opposite-toggle').on('click', function (e) {
        e.preventDefault();
        website('body').toggleClass('sidebar-mobile-opposite').removeClass('sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-detached');
    });


    // Toggle detached sidebar
    website('.sidebar-mobile-detached-toggle').on('click', function (e) {
        e.preventDefault();
        website('body').toggleClass('sidebar-mobile-detached').removeClass('sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-opposite');
    });



    // Mobile sidebar setup
    // -------------------------

    website(window).on('resize', function() {
        setTimeout(function() {
            containerHeight();
            
            if(website(window).width() <= 768) {

                // Add mini sidebar indicator
                website('body').addClass('sidebar-xs-indicator');

                // Place right sidebar before content
                website('.sidebar-opposite').insertBefore('.content-wrapper');

                // Place detached sidebar before content
                website('.sidebar-detached').insertBefore('.content-wrapper');
            }
            else {

                // Remove mini sidebar indicator
                website('body').removeClass('sidebar-xs-indicator');

                // Revert back right sidebar
                website('.sidebar-opposite').insertAfter('.content-wrapper');

                // Remove all mobile sidebar classes
                website('body').removeClass('sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-detached sidebar-mobile-opposite');

                // Revert left detached position
                if(website('body').hasClass('has-detached-left')) {
                    website('.sidebar-detached').insertBefore('.container-detached');
                }

                // Revert right detached position
                else if(website('body').hasClass('has-detached-right')) {
                    website('.sidebar-detached').insertAfter('.container-detached');
                }
            }
        }, 100);
    }).resize();




    // ========================================
    //
    // Other code
    //
    // ========================================


    // Plugins
    // -------------------------

    // Popover
    website('[data-popup="popover"]').popover();


    // Tooltip
    website('[data-popup="tooltip"]').tooltip();

});
