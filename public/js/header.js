var setNav = function($name) {
    $(document).ready(setNavItem($name));
}

var setNavItem = function($name) {
    $('.large.pointing.menu a.active').removeClass('active');
    $('.large.pointing.menu a#' + $name).addClass('active');
}

$(document).ready(function() {
    $('.ui.checkbox').checkbox();
})