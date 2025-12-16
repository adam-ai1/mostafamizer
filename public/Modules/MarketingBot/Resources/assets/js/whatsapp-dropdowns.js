"use strict";

/**
 * WhatsApp Campaign Dropdown UI Interactions
 * Handles dropdown toggle, select all, and outside click functionality
 * for segments and contacts dropdowns in WhatsApp campaignss
 */
$(document).ready(function() {
    // Handle dropdown toggle for segments
    $('#segments-button').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const $dropdown = $('#segments-dropdown');
        const $arrow = $('.segments-arrow');
        const isHidden = $dropdown.hasClass('hidden');

        // Close all other dropdowns
        $('.voice-dropdown-content').not($dropdown).addClass('hidden');
        $('.segments-arrow, .contacts-arrow').removeClass('rotate-180');

        if (isHidden) {
            // Show dropdown
            $dropdown.removeClass('hidden');
            $arrow.addClass('rotate-180');
            // Update button text when dropdown opens
            updateSegmentsSelectAllButton();
        } else {
            // Hide dropdown
            $dropdown.addClass('hidden');
            $arrow.removeClass('rotate-180');
        }
    });

    // Handle dropdown toggle for contacts
    $('#contacts-button').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const $dropdown = $('#contacts-dropdown');
        const $arrow = $('.contacts-arrow');
        const isHidden = $dropdown.hasClass('hidden');

        // Close all other dropdowns
        $('.voice-dropdown-content').not($dropdown).addClass('hidden');
        $('.segments-arrow, .contacts-arrow').removeClass('rotate-180');

        if (isHidden) {
            // Show dropdown
            $dropdown.removeClass('hidden');
            $arrow.addClass('rotate-180');
            // Update button text when dropdown opens
            updateContactsSelectAllButton();
        } else {
            // Hide dropdown
            $dropdown.addClass('hidden');
            $arrow.removeClass('rotate-180');
        }
    });

    // Function to update Select All button text for segments
    function updateSegmentsSelectAllButton() {
        const $container = $('#segments-container');
        const $checkboxes = $container.find('.segment-checkbox');
        const $selectAllBtn = $('#segments-select-all');
        
        if ($checkboxes.length === 0) {
            $selectAllBtn.text(jsLang('Select All'));
            return;
        }
        
        const allSelected = $checkboxes.length === $checkboxes.filter(':checked').length;
        $selectAllBtn.text(allSelected ? jsLang('Unselect All') : jsLang('Select All'));
    }

    // Select All functionality for segments
    $('#segments-select-all').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const $container = $('#segments-container');
        const $checkboxes = $container.find('.segment-checkbox');

        // Check if all are already selected
        const allSelected = $checkboxes.length > 0 && $checkboxes.length === $checkboxes.filter(':checked').length;

        if (allSelected) {
            // Deselect all
            $checkboxes.prop('checked', false);
            $('#segments-hidden-input').val('');
            $('#segments-display').text(jsLang('Select Segment'));
        } else {
            // Select all
            $checkboxes.prop('checked', true);
            const selectedIds = $checkboxes.map(function() {
                return $(this).val();
            }).get();
            $('#segments-hidden-input').val(selectedIds.join(','));
            if (selectedIds.length > 0) {
                $('#segments-display').text(selectedIds.length + ' ' + jsLang('segments selected'));
            } else {
                $('#segments-display').text(jsLang('Select Segment'));
            }
        }
        
        // Update button text
        updateSegmentsSelectAllButton();
    });

    // Listen to checkbox changes to update Select All button text
    $(document).on('change', '#segments-container .segment-checkbox', function() {
        updateSegmentsSelectAllButton();
    });

    // Function to update Select All button text for contacts
    function updateContactsSelectAllButton() {
        const $container = $('#contacts-container');
        const $checkboxes = $container.find('.contact-checkbox');
        const $selectAllBtn = $('#contacts-select-all');
        
        if ($checkboxes.length === 0) {
            $selectAllBtn.text(jsLang('Select All'));
            return;
        }
        
        const allSelected = $checkboxes.length === $checkboxes.filter(':checked').length;
        $selectAllBtn.text(allSelected ? jsLang('Unselect All') : jsLang('Select All'));
    }

    // Select All functionality for contacts
    $('#contacts-select-all').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const $container = $('#contacts-container');
        const $checkboxes = $container.find('.contact-checkbox');

        // Check if all are already selected
        const allSelected = $checkboxes.length > 0 && $checkboxes.length === $checkboxes.filter(':checked').length;

        if (allSelected) {
            // Deselect all
            $checkboxes.prop('checked', false);
            $('#contacts-hidden-input').val('');
            $('#contacts-display').text(jsLang('Select Contact List'));
        } else {
            // Select all
            $checkboxes.prop('checked', true);
            const selectedIds = $checkboxes.map(function() {
                return $(this).val();
            }).get();
            $('#contacts-hidden-input').val(selectedIds.join(','));
            if (selectedIds.length > 0) {
                $('#contacts-display').text(selectedIds.length + ' ' + jsLang('contacts selected'));
            } else {
                $('#contacts-display').text(jsLang('Select Contact List'));
            }
        }
        
        // Update button text
        updateContactsSelectAllButton();
    });

    // Listen to checkbox changes to update Select All button text
    $(document).on('change', '#contacts-container .contact-checkbox', function() {
        updateContactsSelectAllButton();
    });

    // Close dropdowns when clicking outside and update arrow
    $(document).on('click', function(e) {
        const target = e.target;
        const $segmentsButton = $('#segments-button');
        const $segmentsDropdown = $('#segments-dropdown');
        const $contactsButton = $('#contacts-button');
        const $contactsDropdown = $('#contacts-dropdown');

        // Get DOM elements
        const segmentsButtonEl = $segmentsButton[0];
        const segmentsDropdownEl = $segmentsDropdown[0];
        const contactsButtonEl = $contactsButton[0];
        const contactsDropdownEl = $contactsDropdown[0];

        // Check if click is inside segments button or dropdown
        const isInsideSegments = (segmentsButtonEl && segmentsButtonEl.contains(target)) ||
                                (segmentsDropdownEl && segmentsDropdownEl.contains(target));

        // Check if click is inside contacts button or dropdown
        const isInsideContacts = (contactsButtonEl && contactsButtonEl.contains(target)) ||
                                (contactsDropdownEl && contactsDropdownEl.contains(target));

        // Close segments dropdown if click is outside and it's visible
        if (!isInsideSegments) {
            if (!$segmentsDropdown.hasClass('hidden')) {
                $segmentsDropdown.addClass('hidden');
                $('.segments-arrow').removeClass('rotate-180');
            }
        }

        // Close contacts dropdown if click is outside and it's visible
        if (!isInsideContacts) {
            if (!$contactsDropdown.hasClass('hidden')) {
                $contactsDropdown.addClass('hidden');
                $('.contacts-arrow').removeClass('rotate-180');
            }
        }
    });
});
