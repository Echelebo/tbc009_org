
$(document).ready(function () {
    $(document).scroll(setStickyBackground);
    //$("#up-arrow-link").click(scrollToTop);
    $(window).bind('mousewheel DOMMouseScroll', function (event) { setStickyBackground(); });

   
});

$(document).on('focus', '.datepicker', function () {
    if ($(this).hasClass('hasDatepicker') === false) {
        $(this).datepicker({
            dateFormat: 'mm-dd-yy'
        });
    }
});

// Scrolls page to top after refresh
$(window).on('beforeunload', function () {
    $(window).scrollTop(0);
});

// scroll top top of page - called after refresh
function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

// setStickyBackgroud
function setStickyBackground() {

    // Nav bar to green
    var dark = "bg-dark";
    var green = "nav-green";

    //var lowerNav = document.getElementById("LowerNav");
    //var rect = lowerNav.getBoundingClientRect();
    if ($(window).scrollTop() > 50) {
        $("#TopNav").addClass(green);
        $("#TopNav").removeClass(dark);
    } else {
        //remove the background property so it comes transparent again (defined in your css)
        $("#TopNav").removeClass(green);
        $("#TopNav").addClass(dark);
    }
   
}

$('.dropdown-submenu > a').on("click", function (e) {
    
    var submenu = $(this);
    $('.dropdown-submenu .dropdown-menu').removeClass('show');
    submenu.next('.dropdown-menu').addClass('show');
    e.stopPropagation();
});

$('.dropdown').on("hidden.bs.dropdown", function () {
    // hide any open menus when parent closes
    $('.dropdown-menu.show').removeClass('show');
});



        


