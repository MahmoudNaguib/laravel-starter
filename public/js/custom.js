$(function () {
    $('#master').on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });
    $('.sub_chk').on('click', function (e) {
        var numberOfChecked = $('.sub_chk:checked').length;

        if (numberOfChecked > 0) {
            $("#master").prop('checked', true);
        } else {
            $("#master").prop('checked', false);
        }
    });
    $('.delete_all').on('click', function (e) {
        var ids = [];
        $(".sub_chk:checked").each(function () {
            ids.push($(this).attr('data-id'));
        });

        if (ids.length > 0) {
            var href = $(this).attr('href') + '?ids=' + ids;
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
        }
    });
});


