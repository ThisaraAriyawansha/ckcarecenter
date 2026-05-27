$(function () {
    'use strict';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // --- Success modal ---
    var $modal = $('#ckSuccessModal');

    function showSuccessModal() {
        $modal.addClass('ck-show');
        $('body').css('overflow', 'hidden');
    }

    function hideSuccessModal() {
        $modal.removeClass('ck-show');
        $('body').css('overflow', '');
    }

    $('#ckModalClose').on('click', hideSuccessModal);

    $modal.on('click', function (e) {
        if ($(e.target).is($modal)) hideSuccessModal();
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') hideSuccessModal();
    });

    // --- Form submit ---
    var $forms = $('.needs-validation');

    $forms.on('submit', function (event) {
        event.preventDefault();
        var $form = $(this);

        if (!$form[0].checkValidity()) {
            $form.addClass('was-validated');
            return;
        }

        $form.addClass('was-validated');

        var $submitBtn = $form.find('.submit_form');
        var $subscribeBtn = $form.find('.submit_subscribe');
        var actionInput = $form.find("input[name='action']");

        // Disable button + show spinner
        $submitBtn.prop('disabled', true)
            .html('<span class="ck-spinner"></span>&nbsp; Sending...');
        $subscribeBtn.prop('disabled', true).html('Sending...');

        var errtoast = new bootstrap.Toast($('.error_msg')[0]);
        var formUrl  = $form.attr('action') || 'php/form_process.php';

        $.ajax({
            type: 'POST',
            url: formUrl,
            data: $form.serialize(),
            success: function (response) {
                if (response.success) {
                    if (actionInput.length > 0 && actionInput.val() === 'subscribe') {
                        $subscribeBtn.prop('disabled', false).html('Subscribe');
                        var toast_comment = new bootstrap.Toast($('.success_msg_subscribe')[0]);
                        toast_comment.show();
                    } else {
                        $form[0].reset();
                        $form.removeClass('was-validated');
                        $submitBtn.prop('disabled', false).html('Send Message');
                        showSuccessModal();
                    }
                } else {
                    $submitBtn.prop('disabled', false).html('Send Message');
                    $subscribeBtn.prop('disabled', false).html('Subscribe');
                    errtoast.show();
                }
            },
            error: function () {
                $submitBtn.prop('disabled', false).html('Send Message');
                $subscribeBtn.prop('disabled', false).html('Subscribe');
                errtoast.show();
            }
        });
    });
});
