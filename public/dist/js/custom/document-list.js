"use strict";
if ($('.main-body .page-wrapper').find('#'+listContainer+'').length) {
    // For export csv
    $(document).on("click", "#csv, #pdf", function(event) {
        event.preventDefault();
        window.location = SITE_URL + endRoute + this.id;
    });
}

$('#sync-data').on('click', function (e) {
    e.preventDefault();
    var type = $('#type').val();
    var provider = $('#provider').val();
    var feature = $('#feature').val();
    $.ajax({
        url: SITE_URL + route + '/sync',
        type: "POST",
        data: {
            type: type,
            provider: provider,
            feature: feature,
            dataType: 'json',
            _token: token
        },
        beforeSend: function () {
           $('#sync-data').addClass('disabled');
           $('#sync-data').append(`<div id="spinner" class="spinner-border spinner-border-sm ml-2" role="status"></div>`);
        },
        complete: function () {
            $('#spinner').remove();
            $('#sync-data').removeClass('disabled');
        },
        success: function (data) {
            if (data.status == 'success') {
                $('#spinner').remove();
                $('#sync-data').removeClass('disabled');
                window.location.reload();
            }
        },
        error: function (response) {
            var jsonData = JSON.parse(response.responseText);
            $('.top-notification').removeClass('d-none').find('.alert').addClass('alert-danger').removeClass('alert-success').find('.alertText').text(jsonData.error);
            $('#spinner').remove();
            $('#sync-data').removeClass('disabled');
            $('.animateModal-close').trigger('click');
        }
    });
})

$('#dataTableBuilder').on('draw.dt', function () {
    $('.audio-player').off('play').on('play', function () {
        $('.audio-player').not(this).each(function () {
            this.pause();
        });
    });
});

$('#feature').on('change', function() {
    $(this).find('option:first').prop('disabled', false);
    $('#provider option:first').prop('selected', true).prop('disabled', false);

    const feature = this.value;
    $('#provider option:not(:first)').hide().filter(`[id^="${feature}_"]`).show();
})