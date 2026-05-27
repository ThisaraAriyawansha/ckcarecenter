$(function () {
    'use strict';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const forms = $('.needs-validation');

    forms.on('submit', function (event) {
        event.preventDefault();
        const form = $(this);

        if (!form[0].checkValidity()) {
            form.addClass('was-validated');
            return;
        }

        form.addClass('was-validated');

        var actionInput = form.find("input[name='action']");
        $('.submit_form').html('Sending...');
        $('.submit_subscribe').html('Sending...');

        const toast = new bootstrap.Toast($('.success_msg')[0]);
        const errtoast = new bootstrap.Toast($('.error_msg')[0]);

        var formUrl = form.attr('action') || 'php/form_process.php';
        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function (response) {
                if (response.success) {
                    if (actionInput.length > 0 && actionInput.val() === 'subscribe') {
                        $('.submit_subscribe').html('Subscribe');
                        const toast_comment = new bootstrap.Toast($('.success_msg_subscribe')[0]);
                        toast_comment.show();
                    } else {
                        form[0].reset();
                        form.removeClass('was-validated');
                        toast.show();
                        $('.submit_form').html('Send Message');
                    }
                } else {
                    errtoast.show();
                    $('.submit_form').html('Send Message');
                    $('.submit_subscribe').html('Subscribe');
                }
            },
            error: function (xhr) {
                errtoast.show();
                $('.submit_form').html('Send Message');
                $('.submit_subscribe').html('Subscribe');
            }
        });
    });
});
