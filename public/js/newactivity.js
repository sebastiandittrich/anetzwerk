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
                $('body').animate({scrollTop: document.body.scrollHeight},500);
            },
            moveElement(index, new_index) {
                element = this.addedelements.find(function(element) { return element.index === index})
                this.addedelements.splice(this.addedelements.indexOf(this.addedelements.find(function(element) { return element.index === index})), 1)
                this.addedelements = this.addedelements.slice(0,new_index).concat([element].concat(this.addedelements.slice(new_index, this.addedelements.length)))
            }
        }
    })

    imagedialog('#additembuttons .a-image', vue.addImage)
})