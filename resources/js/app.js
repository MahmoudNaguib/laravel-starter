$(function () {
    'use strict';
    $('form').submit(function () {
        $(this).find("button").prop('disabled', true);
    });
    $('.select2').select2({
        placeholder: "Select",
    });
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: 'c-90:c+10',
    });
    function confirmation() {
        $('a[data-confirm]').on('click', function () {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('body').append('<div class="modal fade" id="dataConfirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
                    '  <div class="modal-dialog modal-dialog-centered modal-sm">\n' +
                    '    <div class="modal-content">\n' +
                    '      <div class="d-flex justify-content-center mt-2">\n' +
                    '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n' +
                    '      </div>\n' +
                    '      <div class="modal-body">\n' +
                    '        <div class="content d-flex justify-content-center"></div>' +
                    '        <div class="buttons d-flex justify-content-center mt-3">' +
                    '           <a class="btn btn-lg btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i></a>' +
                    '&nbsp; &nbsp; &nbsp; &nbsp;'+
                    '           <a class="btn btn-lg btn-success" id="dataConfirmOK"><i class="fa fa-check"></i></a>' +
                    '</div>' +
                    '      </div>\n' +
                    '    </div>\n' +
                    '  </div>\n' +
                    '</div>');
            }

            $('#dataConfirmModal').find('.modal-body .content').html($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            var myModal = new bootstrap.Modal(document.getElementById('dataConfirmModal'), {
                keyboard: false
            })
            myModal.show();
            return false;
        });
    }
    confirmation();
    $('.tags').tagsinput();
});


$(document).ready(function() {
    $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('nav-fixed');
        } else {
            $('.navbar').removeClass('nav-fixed');
        }
    });
});