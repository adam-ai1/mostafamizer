"use strict";

$(document).on('submit', '#whatsapp-form', function(e) {
    e.preventDefault();

    postData(this);
})

$(document).on('submit', '#telegram-form', function(e) {
    e.preventDefault();

    postData(this);
})

function postData(e) {

    let formData = new FormData(e);
    const btn = $(e).find('button[type="submit"]');
    const loader = btn.find('.loader');

    $.ajax({
        url: route,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            btn.prop('disabled', true);
            loader.removeClass('hidden');
        }
    }).done(function(response, status, xhr) {

        btn.prop('disabled', false);
        loader.addClass('hidden');

        const meta = response?.data?.meta || {};

        $.each(meta, function (key, value) {
            const $field = $('#' + key);
            if ($field.length) {
                $field.val(value);
            }
        });

        // Handle connection status update
        const isConnected = response?.connected === true;
        const connectionMessage = response?.connection_message || '';
        const formType = $(e).find('input[name="type"]').val();
        
        if (formType === 'whatsapp') {
            updateConnectionStatus('#whatsapp-form', isConnected, connectionMessage);
        } else if (formType === 'telegram') {
            updateConnectionStatus('#telegram-form', isConnected, connectionMessage);
        }

        // Show toast notification
        if (isConnected) {
            toastMixin.fire({
                title: connectionMessage || jsLang('Saved successfully!'),
                icon: 'success'
            });
        } else if (connectionMessage) {
            // Show error toast if connection failed
            toastMixin.fire({
                title: connectionMessage,
                icon: 'error'
            });
        } else {
            toastMixin.fire({
                title: jsLang('Saved successfully!'),
                icon: 'success'
            });
        }
        
    }).fail(function(response, status, xhr) {

        btn.prop('disabled', false);
        loader.addClass('hidden');

        // Hide connection status on error
        const formType = $(e).find('input[name="type"]').val();
        if (formType === 'whatsapp') {
            updateConnectionStatus('#whatsapp-form', false, '');
        } else if (formType === 'telegram') {
            updateConnectionStatus('#telegram-form', false, '');
        }

        const errorMessage = response.responseJSON?.error || response.responseJSON?.message || jsLang('An error occurred');
        
        toastMixin.fire({
            title: errorMessage,
            icon: 'error'
        });
        
    });
}

/**
 * Update connection status indicator
 */
function updateConnectionStatus(formSelector, isConnected, errorMessage) {
    let $statusBadge;
    
    // Find status badge based on form type
    if (formSelector === '#whatsapp-form') {
        $statusBadge = $('#whatsapp-webhook-status');
    } else if (formSelector === '#telegram-form') {
        $statusBadge = $('#telegram-webhook-status');
    }
    
    // Update label status badge
    if ($statusBadge.length) {
        $statusBadge.removeClass('bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hidden');
        
        if (isConnected) {
            $statusBadge.addClass('inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400');
            $statusBadge.html(`
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                ${jsLang('Connected')}
            `);
        } else {
            $statusBadge.addClass('inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400');
            $statusBadge.html(`
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                ${jsLang('Not Connected')}
            `);
        }
    }
}

$(document).on('click', '.toggle-password-btn', function () {
    const btn = $(this);
    const wrapper = btn.closest('.relative'); // the parent div
    const input = wrapper.find('input[type="password"], input[type="text"]');
    const showIcon = btn.find('svg:first');
    const hideIcon = btn.find('svg:last');

    const isHidden = input.attr('type') === 'password';
    input.attr('type', isHidden ? 'text' : 'password');

    // Toggle icons
    showIcon.toggleClass('hidden', isHidden);
    hideIcon.toggleClass('hidden', !isHidden);
});

$(document).on('click', '.copy-webhook-btn', function () {
    const btn = $(this);
    const input = btn.siblings('input[type="url"]');
    const url = input.val().trim();
    const copyIcon = btn.find('.copy-icon');
    const checkIcon = btn.find('.check-icon');

    if (!url) return;

    navigator.clipboard.writeText(url).then(() => {
        // Swap icons
        copyIcon.addClass('hidden');
        checkIcon.removeClass('hidden');

        // Optional color feedback
        btn.addClass('bg-green-100 dark:bg-green-700');

        // Revert after a short delay
        setTimeout(() => {
            copyIcon.removeClass('hidden');
            checkIcon.addClass('hidden');
            btn.removeClass('bg-green-100 dark:bg-green-700');
        }, 1500);
    });
});
