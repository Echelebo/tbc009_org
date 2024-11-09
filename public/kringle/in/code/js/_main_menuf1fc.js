$(document).ready(function () {
    $(document).scroll(setStickyBackground);
    //$("#up-arrow-link").click(scrollToTop);
    $(window).bind('mousewheel DOMMouseScroll', function (event) {
        setStickyBackground();
    });
});

/*
 * This piece of code checks to see if thare any chat
 * messages pending for this user. If so then update
 * the "chatnav_badge" on the navbar (navbar.php) with the number
 * of messages pending (unread)
 */
var chatter = {
    checkChat: function () {
        $.post("../code/ajax/_chat.php", {action: "checkTotalUnreadCount"}, function (data) {
            if (data.hasOwnProperty("valid")) { //Callback didn't just totally die (500)
                if (data.valid == 1) { //We got some valid data
                    var unread = data.pending_messages;
                    if (unread > 0) { //WE hae pending messages
                        $("#chatnav_badge").html(unread);
                        $("#chatnav_badge").show();
                    } else {
                        $("#chatnav_badge").hide();
                        $("#chatnav_badge").html('');
                    }
                } else { //valid is false
                    $("#chatnav_badge").hide();
                    console.log(data.message); //Try to see why
                }
            } else { //data is missing the valid property
                $("#chatnav_badge").hide();
                console.log('Error retrieve chat message count ' + data.message); //show what's wrong
            }
        }, "json")
    }

}
/* Runs one time when the page loads
 * TODO :: modify session handling so that
 *  we can periodically make calls back to
 * the chat engine without extending our
 * $_SESSION (see TokenTrack)
 */
//chatter.checkChat(); jtm out

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




        


