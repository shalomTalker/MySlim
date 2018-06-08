animateFlash()
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

$('#image').change(function() {
  readURL(this);
});
    // readURL($('input[type=file]')).bind(this);

function animateFlash() {
    setInterval(function() {
    if ('.alert') {
        setTimeout(() => {
            $('.alert').slideUp();
            setTimeout(() => {
                $('.alert').remove();
            }, 1000);
        }, 4000);
    }
}, 500);
    // console.log('start')
    // setTimeout(function frame() {
    //     var el = $('.alert').css('animation', 'alertmove 2s')
    //     removeEl(el)
    //     console.log('done')
    // }, 5000)
    //     function removeEl(el) {
    //         el.remove()
    //     }
}