$(document).ready(function() {

    // $('#modernfilebutton').click(function() {
    //     $('#files').click()
    // })

    var images = []
    $('#images').val(JSON.stringify(images))

    imagedialog('#modernfilebutton', function(id, url) {
        $('#result').prepend("<div class='item'><div class='ui small rounded image'><img src='" + url + "'/></div></div>");
        images.push(id)
        $('#images').val(JSON.stringify(images))
    })

    //Check File API support
    if (window.File && window.FileList && window.FileReader) {
        var filesInput = $('#files');

        filesInput.change(function(event) {

            var files = event.target.files; //FileList object
            var output = $("#result");

            output.children('.item').children('.image').parent().remove();

            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                //Only pics
                if (!file.type.match('image'))
                    continue;

                var picReader = new FileReader();

                picReader.addEventListener("load", function(event) {

                    var picFile = event.target;

                    output.prepend("<div class='item'><div class='ui small rounded image'><img src='" + picFile.result + "' style='height: " + output.children('.button').css('height') + ";'/></div></div>");

                });

                //Read the image
                picReader.readAsDataURL(file);
            }

        });
    } else {
        console.log("Your browser does not support File API");
    }

    var activeinput = null;
    var alltags = [];

    $('input[type=text],textarea').focus(function() {
        activeinput = $(this);
    });

    $('form').submit(function(event) {
        if (activeinput != null) {
            if (activeinput.attr('id') == 'taginput') {
                event.preventDefault();
            }
        }
    });

    $('#tags').find('input').keypress(function(e) {
        if (e.which == 13) {
            $('#tagsubmit').click();

            e.preventDefault();
        }
    });

    $('#tagsubmit').click(function() {
        var input = $('#tags').find('input');
        var tags = input.val().split(" ");

        tags.forEach(function(tag) {
            if (tag == "") {
                return false;
            }
            if (alltags.indexOf(tag) > -1) {
                return false;
            }
            alltags.push(tag);
            $('#tags').children('.ui .list').prepend('<div class="item" ><a class="ui blue tag label" >' + tag + '</a></div>')
        });

        $('#tagdata').text(JSON.stringify(alltags));

        input.val('')
    });
})
