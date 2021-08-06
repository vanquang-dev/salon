$('#girl').click(function() {
    $('#girl').addClass('data');
    $('#boy').removeClass('data');
})

$('#boy').click(function() {
    $('#boy').addClass('data');
    $('#girl').removeClass('data');
})

$('#summernote').summernote({
    placeholder: 'Chi tiết bài viết ',
    height: 250,
    minHeight: null,
    maxHeight: null,
    focus: true,
    callbacks: {
        onImageUpload: function(files) {
            for (var i = 0; i < files.length; i++) {
                upFile(files[i], 'description');
            }
        }
    }
})

$('#image').change(function() {
    img_up = $('#image').val();
    count_img_up = $('#image').get(0).files.length;

    upFile($('#image').get(0).files[0], 'title');

    $(".box-pre-img").children().remove();

    // Nếu đã chọn ảnh
    if (img_up != '') {
        $('.box-pre-img').removeClass('display');
        for (i = 0; i <= count_img_up - 1; i++) {
            $('.box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[i]) + '" style="width: 150px;">');
        }
    }
    // Ngược lại chưa chọn ảnh
    else {
        $('.box-pre-img').html('');
    }
})

function cancel() {
    $('body').attr('style', '')
    $('#success').addClass('display')
}