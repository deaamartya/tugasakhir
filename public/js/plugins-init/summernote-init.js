jQuery(document).ready(function() {
    $(".summernote").summernote({
        height: 190,
        minHeight: null,
        maxHeight: null,
        focus: !1,
        toolbar: [
            ['font', ['superscript', 'subscript']],
        ],
        callbacks: {
            onFocus: function (contents) {
                if($('.summernote').summernote('isEmpty')){
                    $(".summernote").html(''); 
                }
            }
        },
    }), $(".inline-editor").summernote({
        airMode: !0
    })
}), window.edit = function() {
    $(".click2edit").summernote()
}, window.save = function() {
    $(".click2edit").summernote("destroy")
};
