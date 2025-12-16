"use strict";

/**
 * Telegram Dropdown Handlers
 * Handles dropdown toggle, select all, and click outside functionality for Groups and Subscribers
 */
$(document).ready(function() {
    // Handle dropdown toggle for groups
    $('#groups-button').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const $dropdown = $('#groups-dropdown');
        const $arrow = $('.groups-arrow');
        const isHidden = $dropdown.hasClass('hidden');
        
        // Close all other dropdowns
        $('.voice-dropdown-content').not($dropdown).addClass('hidden');
        $('.groups-arrow, .subscribers-arrow').removeClass('rotate-180');
        
        if (isHidden) {
            // Show dropdown
            $dropdown.removeClass('hidden');
            $arrow.addClass('rotate-180');
            // Update button text when dropdown opens
            updateGroupsSelectAllButton();
        } else {
            // Hide dropdown
            $dropdown.addClass('hidden');
            $arrow.removeClass('rotate-180');
        }
    });

    // Handle dropdown toggle for subscribers
    $('#subscribers-button').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const $dropdown = $('#subscribers-dropdown');
        const $arrow = $('.subscribers-arrow');
        const isHidden = $dropdown.hasClass('hidden');
        
        // Close all other dropdowns
        $('.voice-dropdown-content').not($dropdown).addClass('hidden');
        $('.groups-arrow, .subscribers-arrow').removeClass('rotate-180');
        
        if (isHidden) {
            // Show dropdown
            $dropdown.removeClass('hidden');
            $arrow.addClass('rotate-180');
            // Update button text when dropdown opens
            updateSubscribersSelectAllButton();
        } else {
            // Hide dropdown
            $dropdown.addClass('hidden');
            $arrow.removeClass('rotate-180');
        }
    });

    // Generic function to update Select All button text
    function updateSelectAllButton(config) {
        const $container = $(config.containerSelector);
        const $checkboxes = $container.find(config.checkboxSelector);
        const $selectAllBtn = $(config.buttonSelector);
        
        if ($checkboxes.length === 0) {
            $selectAllBtn.text(jsLang('Select All'));
            return;
        }
        const allSelected = $checkboxes.length === $checkboxes.filter(':checked').length;
        $selectAllBtn.text(allSelected ? jsLang('Unselect All') : jsLang('Select All'));
    }

    // Wrapper for groups
    function updateGroupsSelectAllButton() {
        updateSelectAllButton({
            containerSelector: '#groups-container',
            checkboxSelector: '.group-checkbox',
            buttonSelector: '#groups-select-all'
        });
    }

    // Select All functionality for groups
    $('#groups-select-all').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const $container = $('#groups-container');
        const $checkboxes = $container.find('.group-checkbox');

        // Check if all are already selected
        const allSelected = $checkboxes.length > 0 && $checkboxes.length === $checkboxes.filter(':checked').length;

        if (allSelected) {
            // Deselect all
            $checkboxes.prop('checked', false);
            $('#groups-hidden-input').val('');
            $('#groups-display').text(jsLang('Select Group'));
        } else {
            // Select all
            $checkboxes.prop('checked', true);
            const selectedIds = $checkboxes.map(function() {
                return $(this).val();
            }).get();
            $('#groups-hidden-input').val(selectedIds.join(','));
            if (selectedIds.length > 0) {
                $('#groups-display').text(selectedIds.length + ' ' + jsLang('groups selected'));
            } else {
                $('#groups-display').text(jsLang('Select Group'));
            }
        }
        
        // Update button text
        updateGroupsSelectAllButton();
    });

    // Listen to checkbox changes to update Select All button text
    $(document).on('change', '#groups-container .group-checkbox', function() {
        updateGroupsSelectAllButton();
    });

    // Wrapper for subscribers
    function updateSubscribersSelectAllButton() {
        updateSelectAllButton({
            containerSelector: '#subscribers-container',
            checkboxSelector: '.subscriber-checkbox',
            buttonSelector: '#subscribers-select-all'
        });
    }

    // Select All functionality for subscribers
    $('#subscribers-select-all').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const $container = $('#subscribers-container');
        const $checkboxes = $container.find('.subscriber-checkbox');

        // Check if all are already selected
        const allSelected = $checkboxes.length > 0 && $checkboxes.length === $checkboxes.filter(':checked').length;

        if (allSelected) {
            // Deselect all
            $checkboxes.prop('checked', false);
            $('#subscribers-hidden-input').val('');
            $('#subscribers-display').text(jsLang('Select Subscriber'));
        } else {
            // Select all
            $checkboxes.prop('checked', true);
            const selectedIds = $checkboxes.map(function() {
                return $(this).val();
            }).get();
            $('#subscribers-hidden-input').val(selectedIds.join(','));
            if (selectedIds.length > 0) {
                $('#subscribers-display').text(selectedIds.length + ' ' + jsLang('subscribers selected'));
            } else {
                $('#subscribers-display').text(jsLang('Select Subscriber'));
            }
        }
        
        // Update button text
        updateSubscribersSelectAllButton();
    });

    // Listen to checkbox changes to update Select All button text
    $(document).on('change', '#subscribers-container .subscriber-checkbox', function() {
        updateSubscribersSelectAllButton();
    });

    // Close dropdowns when clicking outside and update arrow
    $(document).on('click', function(e) {
        const target = e.target;
        const $groupsButton = $('#groups-button');
        const $groupsDropdown = $('#groups-dropdown');
        const $subscribersButton = $('#subscribers-button');
        const $subscribersDropdown = $('#subscribers-dropdown');
        
        // Get DOM elements
        const groupsButtonEl = $groupsButton[0];
        const groupsDropdownEl = $groupsDropdown[0];
        const subscribersButtonEl = $subscribersButton[0];
        const subscribersDropdownEl = $subscribersDropdown[0];
        
        // Check if click is inside groups button or dropdown
        const isInsideGroups = (groupsButtonEl && groupsButtonEl.contains(target)) || 
                                (groupsDropdownEl && groupsDropdownEl.contains(target));
        
        // Check if click is inside subscribers button or dropdown
        const isInsideSubscribers = (subscribersButtonEl && subscribersButtonEl.contains(target)) || 
                                (subscribersDropdownEl && subscribersDropdownEl.contains(target));
        
        // Close groups dropdown if click is outside and it's visible
        if (!isInsideGroups) {
            if (!$groupsDropdown.hasClass('hidden')) {
                $groupsDropdown.addClass('hidden');
                $('.groups-arrow').removeClass('rotate-180');
            }
        }
        
        // Close subscribers dropdown if click is outside and it's visible
        if (!isInsideSubscribers) {
            if (!$subscribersDropdown.hasClass('hidden')) {
                $subscribersDropdown.addClass('hidden');
                $('.subscribers-arrow').removeClass('rotate-180');
            }
        }
    });
});

