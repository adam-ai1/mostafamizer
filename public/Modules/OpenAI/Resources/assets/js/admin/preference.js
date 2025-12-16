'use strict';

$(document).ready(function () {
    selectTabFromUrl();

    var pagination = ['v-pills-setup-tab', 'v-pills-bad-word-tab', 'v-pills-access-tab'];

    if (typeof dynamic_page !== 'undefined') {
        pagination = ['v-pills-setup-tab'];
        for (const value of dynamic_page) {
            pagination.push(`v-pills-${value}-tab`)
        }
    }

    function tabTitle(id) {
        var title = $('#' + id).attr('data-id');
        $('#theme-title').html(title);
    }

    $(".package-submit-button").on("click", function () {
        setTimeout(() => {
            for (const data of pagination) {
                if ($('#' + data.replace('-tab', '')).find(".error").length) {
                    var target = $('#' + data.replace('-tab', '')).attr("aria-labelledby");
                    $('#' + target).tab('show');
                    tabTitle(target);
                    break;
                }
            }
        }, 100);
    });
});

$(document).on("click", '.tab-name', function () {
    console.log(1);
    setTimeout(() => {
        $('.nav-link.active').closest('ul').addClass('show').siblings('a').removeClass('collapses').attr('aria-expanded', true);
    }, 100);
    var id = $(this).attr('data-id');
    $('#theme-title').html(id);
    $('.tab-pane').removeClass('show active')
    $(`.tab-pane[aria-labelledby="${$(this).attr('id')}"`).addClass('show active')

    $('.tab-name').removeClass('active').attr('aria-selected', false);
    $(this).addClass('active').attr('aria-selected', true);

    console.log('Clicked tab ID:', $(this).attr('id'));
    updateUrlWithTab($(this).attr('id'));
});

$(document).on('click', '.nav-list .nav-link', function(e) {
    var target = $(".tab-pane");

    $([document.documentElement, document.body]).animate(
        {
        scrollTop: $(target).offset().top - 350,
        },
        350
    );
})

/**
 * Updates the current URL by adding a query parameter "tab" with the value of tabId if tabId is not empty.
 * This is used to keep the tab state in sync with the browser URL.
 * @param {string} [tabId] the ID of the tab to update the URL for
 */

function updateUrlWithTab(tabId) {
    if (tabId) {
        let newUrl = `${window.location.origin}${window.location.pathname}?tab=${tabId}`;
        history.pushState(null, '', newUrl);
    }
}

// Function to handle tab selection based on the URL
function selectTabFromUrl() {

    const urlParams = new URLSearchParams(window.location.search);
    const tabId = urlParams.get('tab');
    console.log('Tab ID from URL:', tabId);
    
    // Trigger click on the tab specified in the URL, or the first tab if none is specified
    if (tabId) {
        console.log(1);
        $(`.tab-name[id="${tabId}"]`).trigger('click');
    } else {
        $('.tab-name').first().trigger('click');
    }
}
