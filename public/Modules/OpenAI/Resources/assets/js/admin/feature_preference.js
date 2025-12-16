'use strict';

$(function () {
    var pagination = ['v-pills-general_options_ai_doc_chat-tab'];

    if (typeof dynamic_page !== 'undefined') {
        pagination = ['v-pills-general_options_ai_doc_chat-tab'];
        for (const value of dynamic_page) {
            pagination.push(`v-pills-${value}-tab`)
        }
    }
    
    function tabTitle(id) {
        var title = $('#' + id).attr('data-id');
        $('#theme-title').html(title);
    }

    $(document).on("click", '.tab-name', function () {
        $('#' + $(this).attr('id')).addClass('show active');
        var id = $(this).attr('data-id');
        $('#theme-title').html(id);
        updateUrlWithTab($(this).attr('id'));
    });

    $(".feature-preference-submit-button").on("click", function () {
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

    $(document).on("click", '.tab-name', function () {
        setTimeout(() => {
            $('.nav-link.active').closest('ul').addClass('show').siblings('a').removeClass('collapses').attr('aria-expanded', true);
        }, 100);
        var id = $(this).attr('data-id');
        $('#theme-title').html(id);
        $('.tab-pane').removeClass('show active')
        $(`.tab-pane[aria-labelledby="${$(this).attr('id')}"`).addClass('show active')

        $('.tab-name').removeClass('active').attr('aria-selected', false);
        $(this).addClass('active').attr('aria-selected', true);
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
})

function populateModels(provider, selectedModel) {
    var $modelSelect = $('#model-select');

    // Clear previous model options and add default option
    $modelSelect.empty().append($('<option>', {
        value: '',
        text: jsLang('Select a Model')
    }));

    // Populate model options based on the selected provider
    if (providerModels[provider]) {
        $.each(providerModels[provider], function(index, model) {
            $modelSelect.append($('<option>', {
                value: model,
                text: model,
                selected: model === selectedModel 
            }));
        });
    }
}

// Handle the provider change event
$('#provider-select').on('change', function() {
    var selectedProvider = $(this).val();
    populateModels(selectedProvider, '');
});

$( document ).ready(function() {

    selectTabFromUrl();

    $('.conditional').ifs();

    var initialProvider = $('#provider-select').val();
    var initialModel = $('#model-select').val();
    if (initialProvider) {
        populateModels(initialProvider, initialModel);
    }

    $('.themes input[type="color"]').on('click', function(e) {
        e.stopPropagation();
        var $container = $(this).closest('.color-input-container');
        var $drawer = $container.find('.drawer');
        var $colorContainer = $(this).closest('.color-container');
        $('.drawer').not($drawer).removeClass('open');
        $('.color-input-container').not($container).removeClass('expanded');
        $('.color-container').not($colorContainer).removeClass('marked');
        $drawer.toggleClass('open');
        $container.toggleClass('expanded');
        $colorContainer.toggleClass('marked');
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.color-input-container').length) {
            $('.drawer').removeClass('open');
            $('.color-input-container').removeClass('expanded');
            $('.color-container').removeClass('marked');
        }
    });

    $('.themes input[type="color"]').on('input', function() {
        var newColor = $(this).val();
        $(this).closest('.color-input-container').find('.color-code').text(newColor);
    });
});

$(document).on("file-attached", ".custom-file", function (e, param) {
    let data = param.data;
    if (data) {
        $(this).closest(".preview-parent").find(".custom-file-input").val(data[0].id);
    }
});

// Function to handle tab selection based on the URL
function selectTabFromUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    const tabId = urlParams.get('tab');
    
    // Trigger click on the tab specified in the URL, or the first tab if none is specified
    if (tabId) {
        $(`.tab-name[id="${tabId}"]`).trigger('click');
    } else {
        $('.tab-name').first().trigger('click');
    }
}

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
