var fluentelements = '.ui.button, a.ui.label'

$(document).on('mouseenter', fluentelements,function() {
    $(this).css({
        filter: !$(this).hasClass('basic') ? "drop-shadow(0px 0px 10px " + $(this).css("background-color") + ")" : "drop-shadow(0px 0px 10px " + $(this).css("color") + ")"
    })
})

$(document).on('mouseleave', fluentelements,function() {
    $(this).css({
        filter: ""
    })
})

