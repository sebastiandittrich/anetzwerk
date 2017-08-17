$(document).ready(function() {
    var vue = new Vue({
        el: '#vuebox',
        data: {
            addedelements: [],
            editors: []
        },
        methods: {
            deleteElement(index) {
                this.addedelements.find(function(element) {return element.index === index}).object = undefined
            },
            submitForm() {
                console.log('hallo')
                var data = {}
                data._token = $('input[name=_token]').val()
                data.objects = this.addedelements.filter(function(element) {
                    return element.object != undefined
                })
                $.ajax({url: '/activities/new', type: 'POST', data: data, success: function(response) {
                    if(response == 'true') {
                        window.location.href = '/activities'
                    } else {
                        additem(response)
                    }
                }});
            },
            getFreeIndex() {
                var indexes = [-1]
                for(item of this.addedelements) {
                    indexes.push(item.index)
                }
                indexes.sort()
                return indexes.pop() + 1

            },
            addText() {
                var self = this
                var index = this.getFreeIndex();
                this.addedelements.push({object: 'App\\Post', content: '', index: index, object_id: null})
                window.setTimeout(function() {
                    var quill = new Quill('#editor' + index, {
                        theme: 'snow',
                        placeholder: 'Schreibe etwas',
                        modules: {
                            toolbar: [  
                                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                                ['bold', 'italic', 'underline', 'strike'],
                                ['code-block', 'link'],
                                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                [{ 'color': [] }, { 'background': [] }],
                                ['clean'] 
                            ]
                        }
                    })
                    quill.on('text-change', function() {
                        self.addedelements.find(function(element) { return element.index === index}).content = $('#editor' + index + ' .ql-editor').html()
                    })
                }, 500)
                $('body').animate({scrollTop: document.body.scrollHeight},500);
            },
            addImage(id, url) {
                this.addedelements.push({object: 'App\\Image', object_id: id, url: url, index: this.getFreeIndex()})
                window.scrollTo(0,document.body.scrollHeight);
            }
        }
    })

    $('#additembuttons .a-image').click(function() {
        $('.a-chooseimage').modal('show')
    })
    $('.a-chooseimage .uploadform #files').change(function() {
        $.ajax({url: '/images/new', type: 'POST', data: new FormData($('.uploadform')[0]), processData: false, contentType: false, success: function(response) {
            for(var i = 0; i < response.length; i++) {
                vue.addImage(response[i][0], response[i][1])
            }
            $('.a-chooseimage').modal('hide')
        }});
    })
    $('.item.upload').click(function() {
        $('.a-chooseimage .uploadform #files').click()
    })
    $('.a-chooseimage').find('.item.my').click(function() {
        $('.a-chooseimage').find('.content.main, .content.all').hide()
        $('.a-chooseimage').find('.content.my').css('display', '')
    })
    $('.a-chooseimage .content.my img').click(function() {
        $('.a-chooseimage').modal('hide')
        vue.addImage($(this).attr('data-id'), $(this).attr('src'))
    })
    $('.a-chooseimage').find('.a-backbutton').click(function() {
        $('.a-chooseimage').find('.content.my, .content.all').hide()
        $('.a-chooseimage').find('.content.main').show()
    })
})