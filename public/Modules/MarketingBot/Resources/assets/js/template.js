"use strict";

$(document).on('click', '.template-button', function(e) {
    e.preventDefault();

    const channel = $(this).data('channel');
    const form = $(this).closest('form');
    const submitButton = $(this);

    $.ajax({
        url: route,
        type: 'POST',
        data: {
            'channel': channel,
            'user_id': user_id,
            '_token': CSRF_TOKEN
        },
        dataType: 'JSON',
        beforeSend: function() {
            submitButton.prop('disabled', true)
                .find('.loader-icon').removeClass('hidden');

            // Show skeleton loader during sync
            if (window.templatesSkeleton && window.templatesSkeleton.show) {
                window.templatesSkeleton.show();
            }
        },
        success: function(response) {
            // Replace the entire table content (including pagination)
            $('.template-table').html(response.data);

            // Show the table if it was hidden (when there were no templates before)
            $('.template-table .table-content').removeClass('hidden');

            // Hide skeleton loader
            if (window.templatesSkeleton && window.templatesSkeleton.hide) {
                window.templatesSkeleton.hide();
            }

            toastMixin.fire({
                title: jsLang('Successfully Synced.'),
                icon: 'success',
            });
        },
        error: function(error) {
            let response = error.responseJSON?.error || error.responseJSON?.message || jsLang('An error occurred');

            // Hide skeleton loader on error
            if (window.templatesSkeleton && window.templatesSkeleton.hide) {
                window.templatesSkeleton.hide();
            }

            toastMixin.fire({
                title: response,
                icon: 'error',
            });
        },
        complete: function() {
            submitButton.prop('disabled', false)
                .find('.loader-icon').addClass('hidden');
        }
    });
});

$(document).on('click', '.openModalBtn', function() {
    $('.delete-template').attr('data-id', $(this).data('id'));
    $('.delete-template').attr('data-channel', $(this).data('channel'));
});

$(document).on('click', '.delete-template', function(e) {
    let id = $(this).attr("data-id");
    let channel = $(this).data('channel');

    $(".loader").removeClass('hidden');
    $(this).attr('disabled');
    
    doAjaxprocess(
        SITE_URL + "/user/marketing-bot/templates/delete/" + id,
        {
            user_id : user_id,
            channel : channel,
            _token: CSRF_TOKEN
        },
        'delete',
        'json'
    ).done(function(response, textStatus, jqXHR) {
        toastMixin.fire({
            title: response.message,
            icon: textStatus,
        });
        $('#template-row-'+id).remove();
        $(".loader").addClass('hidden');
        $(this).removeAttr('disabled');
        $('.closeModalBtn').click();

    }).fail(function(jqXHR, textStatus, errorThrown) {

        toastMixin.fire({
            title: JSON.parse(jqXHR.responseText).error ,
            icon: textStatus,
        });
        $(".loader").addClass('hidden');
        $(this).removeAttr('disabled');
        $('.closeModalBtn').click();
    });
})

let debounceTimer;

function filterTemplates(e, category) {
    const value = $(e).text().trim().toLowerCase();
    const url = buildUrl({ [category]: value });

    getMaterials(url);
}

function searchTemplates(e) {
    const url = buildUrl({ search: $(e).val().trim().toLowerCase() });
    
    getMaterials(url);
}

function getFilters() {
    return {
        channels: $('.custom-select .selected-option.filter-channel').text().trim().toLowerCase(),
        search: $('#template-search').val().trim().toLowerCase()
    };
}

function buildUrl(extra = {}) {
    const base = search_route;
    const filters = { ...getFilters(), ...extra };
    const query = Object.entries(filters)
        .filter(([_, v]) => v && v !== 'all')
        .map(([k, v]) => `${k}=${encodeURIComponent(v)}`)
        .join('&');
    return `${base}?${query}`;
}

function getMaterials(url) {

    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        const container = $('.template-table');
        if (!container.length) return;

        // Show skeleton loader
        const tableSkeletonElements = container.find('.table-skeleton');
        const tableContentElements = container.find('.table-content');
        tableSkeletonElements.removeClass('hidden');
        tableContentElements.addClass('hidden');

        $.ajax({
            url: url,
            type: 'GET',
            data: {},
            dataType: 'json',
            beforeSend: function () {
                $('#template-search').parent().find('.loader-icon').removeClass('hidden');
            },
            success: function (response) {
                $('#template-search').parent().find('.loader-icon').addClass('hidden');
                
                if (response && response.items) {
                    container.html(response.items);
                    // Hide skeleton and show content after loading search results
                    const newSkeletonElements = container.find('.table-skeleton');
                    const newContentElements = container.find('.table-content');
                    newSkeletonElements.addClass('hidden');
                    newContentElements.removeClass('hidden');
                }
            },
            error: function() {
                $('#template-search').parent().find('.loader-icon').addClass('hidden');
                // On error, hide skeleton and show error message
                const tableSkeletonElements = container.find('.table-skeleton');
                const tableContentElements = container.find('.table-content');
                tableSkeletonElements.addClass('hidden');
                tableContentElements.removeClass('hidden');
            }
        });
    }, 1000);
}