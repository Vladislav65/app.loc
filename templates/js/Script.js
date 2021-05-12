$(document).ready(function() {
    $('#addTopic').summernote({
        lang: 'ru-Ru',
        height: 500,
        width: 1300,
        minHeight: 400,
        toolbar:[
            ['insert', ['picture', 'link', 'table']],
            ['style', ['bold', 'italic', 'underline']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize', 'fontname']]
        ],
        //fontSizes: [ '12', '16', '18', '24'],
    });
});