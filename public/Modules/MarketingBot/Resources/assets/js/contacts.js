"use strict";
let phoneInput;
let selectedSegments = {}; // Object to store selected segments {id: name}

// Function to update selected segments display
function updateSelectedSegmentsDisplay() {
    const selectedCount = Object.keys(selectedSegments).length;
    const selectSegmentText = $('#selectSegmentText').val() || jsLang('Select Segment');
    const maxVisibleTags = 4; // Show max 4 tags, then show count badge
    
    if (selectedCount === 0) {
        $('#selectedSegment').text(selectSegmentText).removeClass('hidden');
        $('#selectedSegmentsTags').addClass('hidden').empty();
        $('#selectedCountBadge').addClass('hidden');
    } else {
        $('#selectedSegment').addClass('hidden');
        $('#selectedSegmentsTags').removeClass('hidden').empty();
        $('#selectedCountBadge').addClass('hidden');
        
        const segmentIds = Object.keys(selectedSegments);
        const visibleCount = Math.min(selectedCount, maxVisibleTags);
        const remainingCount = selectedCount - maxVisibleTags;
        
        // Show visible tags with fade-in animation
        for (let i = 0; i < visibleCount; i++) {
            const id = segmentIds[i];
            const name = selectedSegments[id];
            const safeName = $('<div/>').text(name).html();
            const tagHtml = `
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 text-white rounded-md text-xs font-medium shadow-sm hover:shadow-md transition-all duration-200 animate-fadeIn" style="animation-delay: ${i * 50}ms">
                    <span class="max-w-[120px] truncate">${safeName}</span>
                    <button type="button" class="remove-segment-tag flex-shrink-0 hover:bg-white/20 rounded-full p-0.5 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-white/50" data-id="${id}" onclick="removeSegment(${id})" aria-label="${jsLang('Remove')} ${safeName}">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </span>
            `;
            $('#selectedSegmentsTags').append(tagHtml);
        }
        
        // Show count badge if there are more than maxVisibleTags
        if (remainingCount > 0) {
            $('#selectedCountBadge').removeClass('hidden').text(`+${remainingCount} ${jsLang('more')}`);
        }
    }
}

// Function to update hidden input with selected segment IDs
function updateSegmentIdsInput() {
    const segmentIds = Object.keys(selectedSegments);
    $('#selectedSegmentIds').val(segmentIds.join(','));
    
    // Also update as array for form submission
    $('input[name="segment_ids[]"]').remove();
    segmentIds.forEach(function(id) {
        $('#selectedSegmentIds').after(`<input type="hidden" name="segment_ids[]" value="${id}">`);
    });
}

$(document).ready(function() {
    // Handle import success/error messages and reload table
    if (typeof window.contactSessionSuccess !== 'undefined' && window.contactSessionSuccess) {
        toastMixin.fire({
            icon: 'success',
            title: window.contactSessionSuccess
        });
        // Reload contacts table after successful import
        setTimeout(function() {
            if (typeof reloadContactsTable === 'function') {
                reloadContactsTable();
            } else if (typeof searchContacts === 'function') {
                const searchInput = document.getElementById('searchContacts');
                if (searchInput) {
                    searchContacts(searchInput);
                }
            }
        }, 1000);
    }

    if (typeof window.contactSessionError !== 'undefined' && window.contactSessionError) {
        toastMixin.fire({
            icon: 'error',
            title: window.contactSessionError
        });
    }

    initializePhoneInput();
    initializeImportForm();

    // Form submission for new/edit contact
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        saveContact();
    });

    // Open modal for new contact (Add Contact button)
    $(document).on('click', '.openModalBtn[data-target="modal7"]', function(e) {
        e.preventDefault();

        // Reset form
        $('#contactForm')[0].reset();
        $('#contactId').val('');

        // Reset dropdowns
        selectedSegments = {};
        $('.segment-checkbox').prop('checked', false);
        $('#selectedSegmentIds').val('');
        $('#selectedSegmentsTags').addClass('hidden').empty();
        $('#selectedCountBadge').addClass('hidden');
        $('input[name="segment_ids[]"]').remove();
        // Ensure display is properly reset
        updateSelectedSegmentsDisplay();

        // Clear errors
        $('.error-message').addClass('hidden').text('');
        $('.border-red-500').removeClass('border-red-500');

        // Reset phone input
        if (phoneInput) {
            phoneInput.setNumber("");
        }

        // Update modal title for add
        $('#modal7 h5').text(jsLang('Contact Add'));
        $('#modal7 p').text(jsLang('Select Segment'));

        // Show modal
        const modal = $('#modal7');
        modal.removeClass('hidden');
        setTimeout(() => {
            modal.addClass('opacity-100');
            modal.find('.modalBox').addClass('scale-100 opacity-100');
        }, 50);
    });

    // Close modal handler for main contact modal
    $(document).on('click', '.closeModalBtn', function() {
        const modal = $(this).closest('.sweet-modal');
        if (modal.length) {
            closeModal(modal);
        }
    });

    // DELETE MODAL OPENING
    $(document).on('click', '.openModalBtn[data-target^="deleteModal-"]', function(e) {
        e.preventDefault();
        e.stopPropagation();

        const modalId = $(this).attr('data-target');

        const modal = $(`#${modalId}`);

        if (modal.length) {
            modal.removeClass('hidden');
            setTimeout(() => {
                modal.addClass('opacity-100');
                modal.find('.modalBox').addClass('scale-100 opacity-100');
            }, 10);
        } else {
        }
    });

    // Close modal when clicking outside
    $(document).on('click', '.sweet-modal', function(e) {
        if (e.target === this) {
            closeModal($(this));
        }
    });

    // Handle delete form submissions
    $(document).on('submit', 'form[id^="deleteContactForm-"]', function(e) {
        e.preventDefault();
        const id = this.id.split('-')[1];
        deleteContact(id);
    });



    // Segment dropdown pagination and search variables
    let segmentCurrentPage = 1;
    let segmentIsLoading = false;
    let segmentHasMorePages = true;
    let segmentSearchTerm = '';
    let segmentSearchTimeout = null;
    let segmentApiInitialized = false;

    // Initialize segment API state from initial blade-rendered segments
    function initializeSegmentPagination() {
        if (segmentApiInitialized) return;
        
        const initialSegmentCount = $('.segment-option').length;
        const perPage = initialSegmentCount; // Assume initial count equals per_page
        
        // Check if there are more segments by checking if we have exactly per_page items
        // This is a heuristic - we'll know for sure after first API call
        segmentHasMorePages = initialSegmentCount >= perPage;
        segmentApiInitialized = true;
    }

    // Segment dropdown functionality
    $('#segmentDropdownBtn').on('click', function(e) {
        e.stopPropagation();
        const isOpening = $('#segmentDropdown').hasClass('hidden');
        $('#segmentDropdown').toggleClass('hidden');
        
        // Rotate arrow icon
        if (isOpening) {
            $('#dropdownArrow').addClass('rotate-180');
        } else {
            $('#dropdownArrow').removeClass('rotate-180');
        }
        
        // Initialize pagination state on first open
        if (!segmentApiInitialized) {
            initializeSegmentPagination();
        }
    });

    // Segment selection - handle checkbox click
    $(document).on('change', '.segment-checkbox', function(e) {
        e.stopPropagation();
        const $option = $(this).closest('.segment-option');
        const segmentId = $(this).val();
        const segmentName = $(this).data('name');
        const isChecked = $(this).is(':checked');
        
        if (isChecked) {
            selectedSegments[segmentId] = segmentName;
        } else {
            delete selectedSegments[segmentId];
        }
        
        updateSelectedSegmentsDisplay();
        updateSegmentIdsInput();
    });

    // Prevent checkbox click from triggering option click
    $(document).on('click', '.segment-checkbox', function(e) {
        e.stopPropagation();
    });

    // Segment option click - toggle checkbox
    $(document).on('click', '.segment-option', function(e) {
        // Don't toggle if clicking directly on checkbox
        if ($(e.target).is('.segment-checkbox')) {
            return;
        }
        
        const $checkbox = $(this).find('.segment-checkbox');
        $checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
    });

    // Prevent dropdown from closing when clicking inside the dropdown
    $(document).on('click', '#segmentDropdown', function(e) {
        e.stopPropagation(); // This prevents the click from bubbling up
    });

    // Close dropdowns when clicking outside (updated to exclude search input)
    $(document).on('click', function(e) {
        // Check if the click is outside both the dropdown button and the dropdown itself
        if (!$(e.target).closest('#segmentDropdownBtn, #segmentDropdown').length) {
            $('#segmentDropdown').addClass('hidden');
        }
    });

    // Server-side search with debouncing
    $('#segmentSearch').on('input', function() {
        const searchValue = $(this).val().trim();
        
        // Clear existing timeout
        if (segmentSearchTimeout) {
            clearTimeout(segmentSearchTimeout);
        }
        
        // Set new timeout for debouncing (300ms)
        segmentSearchTimeout = setTimeout(function() {
            segmentSearchTerm = searchValue;
            segmentCurrentPage = 1;
            // If search is empty, load first page; otherwise search
            loadSegments(1, searchValue, false);
        }, 300);
    });

    // Prevent search input from closing dropdown when clicked
    $('#segmentSearch').on('click', function(e) {
        e.stopPropagation();
    });

    // Infinite scroll for segment list
    $('#segmentList').on('scroll', function() {
        const $list = $(this);
        const scrollTop = $list.scrollTop();
        const scrollHeight = $list[0].scrollHeight;
        const clientHeight = $list.height();
        
        // Check if near bottom (50px threshold)
        if (scrollTop + clientHeight >= scrollHeight - 50) {
            if (segmentHasMorePages && !segmentIsLoading) {
                // If we're on initial page and haven't searched, load page 2
                // Otherwise load next page
                const nextPage = segmentCurrentPage + 1
                loadSegments(nextPage, segmentSearchTerm, true);
            }
        }
    });

    // Function to load segments from API
    function loadSegments(page, search = '', append = false) {
        if (segmentIsLoading) return;
        
        segmentIsLoading = true;
        
        // Show loading indicator
        if (!append) {
            $('#segmentList').html(`<div class="px-4 py-2.5 text-sm text-gray-500 text-center">${jsLang('Loading...')}</div>`);
        } else {
            $('#segmentList').append(`<div class="px-4 py-2.5 text-sm text-gray-500 text-center" id="segmentLoadingMore">${jsLang('Loading more...')}</div>`);
        }
        
        // Build API URL
        const url = SITE_URL + '/user/marketing-bot/get-segments-dropdown';
        
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                page: page,
                search: search || ''
            },
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            success: function(data) {
                // Remove loading indicator
                $('#segmentLoadingMore').remove();
                
                if (data.success) {
                    if (!append) {
                        $('#segmentList').empty();
                    }
                    
                    // Render segment options
                    if (data.segments && data.segments.length > 0) {
                        data.segments.forEach(function(segment) {
                            renderSegmentOption(segment);
                        });
                    } else if (!append) {
                        $('#segmentList').html(`<div class="px-4 py-2.5 text-sm text-gray-500 text-center">${jsLang('No segments found')}</div>`);
                    }
                    
                    // Update pagination state
                    segmentCurrentPage = data.current_page;
                    segmentHasMorePages = data.has_more_pages;
                } else {
                    // Handle error response from server
                    const errorMsg = data.error || jsLang('Failed to load segments');
                    if (!append) {
                        $('#segmentList').html(`<div class="px-4 py-2.5 text-sm text-red-500 text-center">${errorMsg}</div>`);
                    } else {
                        $('#segmentLoadingMore').remove();
                    }
                }
            },
            error: function(xhr, status, error) {
                
                let errorMsg = jsLang('Error loading segments');
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg = xhr.responseJSON.error;
                } else if (xhr.status === 404) {
                    errorMsg = jsLang('Endpoint not found. Please check the route.');
                } else if (xhr.status === 500) {
                    errorMsg = jsLang('Server error. Please try again.');
                } else if (xhr.status === 0) {
                    errorMsg = jsLang('Network error. Please check your connection.');
                }
                
                if (!append) {
                    $('#segmentList').html(`<div class="px-4 py-2.5 text-sm text-red-500 text-center">${errorMsg}</div>`);
                } else {
                    $('#segmentLoadingMore').remove();
                }
            },
            complete: function() {
                segmentIsLoading = false;
                    }
                });
            }

    // Function to render a single segment option
    function renderSegmentOption(segment) {
        const segmentIdStr = String(segment.id);
        const isChecked = selectedSegments[segmentIdStr] ? 'checked' : '';
        
        // Update selectedSegments with actual segment name if it was a placeholder
        if (selectedSegments[segmentIdStr] && selectedSegments[segmentIdStr].startsWith('Segment ')) {
            selectedSegments[segmentIdStr] = segment.name;
        }
        
        const safeSegmentName = $('<div/>').text(segment.name).html();
        const optionHtml = `
            <div class="segment-option px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer flex items-center gap-3 transition-colors duration-150"
                data-id="${segment.id}" data-name="${segment.name}">
                <div class="relative flex items-center">
                    <input type="checkbox" class="segment-checkbox w-4 h-4 rounded border-color-DF dark:border-color-47 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-0 cursor-pointer transition-all duration-150" value="${segment.id}" data-name="${segment.name}" ${isChecked}>
                </div>
                <span class="flex-1 font-medium">${safeSegmentName}</span>
            </div>
        `;
        $('#segmentList').append(optionHtml);
        
        // If this segment was selected, update the display
        if (isChecked) {
            updateSelectedSegmentsDisplay();
        }
    }

    // Function to remove a segment from selection
    window.removeSegment = function(segmentId) {
        delete selectedSegments[segmentId];
        $('.segment-checkbox[value="' + segmentId + '"]').prop('checked', false);
        updateSelectedSegmentsDisplay();
        updateSegmentIdsInput();
    };
});

function initializePhoneInput() {
    const phoneInputField = document.querySelector("#contactPhone");

    if (!phoneInputField) {
        return;
    }

    try {
        phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ["us", "gb", "ca", "au", "in", "bd"],
            separateDialCode: true,
            initialCountry: "bd",
            utilsScript: utilsScriptLoadingPath,
            autoPlaceholder: "polite",
            nationalMode: false,
        });

        // Restrict input to numbers only
        phoneInputField.addEventListener("input", function(e) {
            // Remove any non-numeric characters (keep only digits)
            const originalValue = e.target.value;
            const numericValue = originalValue.replace(/\D/g, '');
            
            // Only update if the value changed (non-numeric characters were removed)
            if (originalValue !== numericValue) {
                const cursorPosition = e.target.selectionStart;
                const removedChars = originalValue.length - numericValue.length;
                
                e.target.value = numericValue;
                
                // Adjust cursor position based on how many characters were removed
                const newCursorPosition = Math.max(0, cursorPosition - removedChars);
                e.target.setSelectionRange(newCursorPosition, newCursorPosition);
            }
            
            updatePhoneData();
        });

        // Handle paste events to filter non-numeric characters
        phoneInputField.addEventListener("paste", function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const numericValue = pastedText.replace(/\D/g, '');
            
            if (numericValue) {
                const start = e.target.selectionStart;
                const end = e.target.selectionEnd;
                const currentValue = e.target.value;
                const newValue = currentValue.substring(0, start) + numericValue + currentValue.substring(end);
                e.target.value = newValue.replace(/\D/g, '');
                e.target.setSelectionRange(start + numericValue.length, start + numericValue.length);
                updatePhoneData();
            }
        });

        // Prevent non-numeric keypress
        phoneInputField.addEventListener("keypress", function(e) {
            // Allow: backspace, delete, tab, escape, enter, and numbers
            if (e.key === 'Backspace' || e.key === 'Delete' || e.key === 'Tab' || 
                e.key === 'Escape' || e.key === 'Enter' || e.key === 'ArrowLeft' || 
                e.key === 'ArrowRight' || e.key === 'ArrowUp' || e.key === 'ArrowDown') {
                return;
            }
            
            // Only allow numeric characters (0-9)
            if (!/^[0-9]$/.test(e.key)) {
                e.preventDefault();
            }
        });

        phoneInputField.addEventListener("countrychange", function() {
            updatePhoneData();
        });

    } catch (error) {
        toastMixin.fire({
            icon: 'error',
            title: jsLang('Failed to initialize phone input. Please try again.')
        });
    }
}

function updatePhoneData() {
    if (!phoneInput) return;

    try {
        const countryData = phoneInput.getSelectedCountryData();

        // Get the full E164 number and clean it
        // Use utils if available, otherwise use getNumber() without format
        let fullNumberE164;
        if (typeof window.intlTelInputUtils !== 'undefined' && window.intlTelInputUtils && window.intlTelInputUtils.numberFormat) {
            fullNumberE164 = phoneInput.getNumber(window.intlTelInputUtils.numberFormat.E164);
        } else if (typeof intlTelInputUtils !== 'undefined' && intlTelInputUtils && intlTelInputUtils.numberFormat) {
            fullNumberE164 = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
        } else {
            fullNumberE164 = phoneInput.getNumber();
        }

        // Remove + sign and any non-digit characters
        const cleanFullNumber = fullNumberE164 ? fullNumberE164.replace('+', '').replace(/\D/g, '') : '';

        // Get country ISO code (uppercase)
        const countryIsoCode = countryData.iso2.toUpperCase();

        // Update hidden fields
        $('#dialCode').val(countryData.dialCode);
        $('#countryCode').val(countryIsoCode);
        $('#fullPhone').val(cleanFullNumber);

    } catch (error) {
        toastMixin.fire({
            icon: 'error',
            title: error
        });
    }
}


// Override any cached loadContacts function to prevent errors
window.loadContacts = function() {
    // Redirect to the new reloadContactsTable function
    if (typeof reloadContactsTable === 'function') {
        reloadContactsTable();
    } else if (typeof searchContacts === 'function') {
        const searchInput = document.getElementById('searchContacts');
        if (searchInput) {
            searchContacts(searchInput);
        } else {
            // Fallback: reload without search
            if (typeof contactRoute !== 'undefined') {
                window.location.href = contactRoute;
            } else {
                window.location.reload();
            }
        }
    } else {
        window.location.reload();
    }
};

function saveContact() {
    // Clear previous validation errors
    $('.error-message').addClass('hidden').text('');
    $('.border-red-500').removeClass('border-red-500');

    // Update phone data BEFORE form submission
    updatePhoneData();

    // Validate phone number
    if (!phoneInput) {
        $('#contactPhone').addClass('border-red-500');
        $('#phone-error').text(jsLang('Phone input not initialized')).removeClass('hidden');
        return false;
    }

    // Get national number - use utils if available, otherwise get raw value
    let nationalNumber;
    if (typeof window.intlTelInputUtils !== 'undefined' && window.intlTelInputUtils && window.intlTelInputUtils.numberFormat) {
        nationalNumber = phoneInput.getNumber(window.intlTelInputUtils.numberFormat.NATIONAL);
    } else if (typeof intlTelInputUtils !== 'undefined' && intlTelInputUtils && intlTelInputUtils.numberFormat) {
        nationalNumber = phoneInput.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
    } else {
        nationalNumber = phoneInput.getNumber();
    }
    
    // Remove non-digit characters
    nationalNumber = nationalNumber ? nationalNumber.replace(/\D/g, '') : '';
    
    if (!nationalNumber || nationalNumber.length < 5) {
        $('#contactPhone').addClass('border-red-500');
        $('#phone-error').text('Please enter a valid phone number').removeClass('hidden');
        return false;
    }

    // Get form data - use the full phone number from hidden field
    const segmentIds = Object.keys(selectedSegments);
    const formData = {
        name: $('#contactName').val().trim(),
        phone: $('#fullPhone').val(),
        country_code: $('#countryCode').val(),
        segment_ids: segmentIds.length > 0 ? segmentIds : null,
        _token: $('input[name="_token"]').val()
    };

    // Validate required fields
    let isValid = true;

    if (!formData.name) {
        isValid = false;
        $('#contactName').addClass('border-red-500');
        $('#name-error').text('Contact name is required').removeClass('hidden');
    }

    if (!formData.phone || formData.phone.length < 10) {
        isValid = false;
        $('#contactPhone').addClass('border-red-500');
        $('#phone-error').text('Please enter a valid phone number').removeClass('hidden');
    }

    if (!isValid) return false;

    // Show loading state
    $('#saveBtnText').addClass('hidden');
    $('#saveBtnLoader').removeClass('hidden');
    $('#saveContactBtn').prop('disabled', true);

    // Determine if this is an update or create
    const contactId = $('#contactId').val();
    const url = contactId ? updateContactUrl.replace(':id', contactId) : storeContactUrl;
    const method = contactId ? 'PUT' : 'POST';

    // Add _method for PUT requests
    if (method === 'PUT') {
        formData._method = 'PUT';
    }

    // Make AJAX request
    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                closeModal($('#modal7'));
                $('#contactForm')[0].reset();
                $('#contactId').val('');
                selectedSegments = {};
                $('.segment-checkbox').prop('checked', false);
                $('#selectedSegment').text('Select Segment');
                $('#selectedSegmentIds').val('');
                $('#selectedSegmentsTags').addClass('hidden').empty();
                $('#selectedCountBadge').addClass('hidden');
                $('input[name="segment_ids[]"]').remove();
                if (phoneInput) {
                    phoneInput.setNumber("");
                }
                toastMixin.fire({
                    icon: 'success',
                    title: response.message || jsLang('Contact saved successfully')
                });

                // Reload contacts table after a short delay to ensure server has processed the update
                setTimeout(function() {
                    // Always use reloadContactsTable which is more reliable
                    if (typeof reloadContactsTable === 'function') {
                        reloadContactsTable();
                    } else {
                        // Direct call to searchContacts with null to reload without search filter
                        searchContacts(null);
                    }
                }, 500);
            } else {
                toastMixin.fire({
                    icon: 'error',
                    title: response.message || jsLang('Failed to save contact')
                });
            }
        },
        // In your saveContact() function, update the error handling:
        error: function(xhr) {

            const errors = xhr.responseJSON?.errors;
            const errorMessage = xhr.responseJSON?.error || xhr.responseJSON?.message;

            if (errors) {
                // Display field-specific validation errors
                for (const [field, messages] of Object.entries(errors)) {
                    const errorElement = $(`#${field}-error`);
                    const inputElement = $(`[name="${field}"]`);
                    
                    if (errorElement.length) {
                        errorElement.text(messages[0]).removeClass('hidden');
                    }
                    if (inputElement.length) {
                        inputElement.addClass('border-red-500');
                    }
                }

                // Show toast for phone error (or first error)
                const toastError = errors.phone?.[0] || Object.values(errors)[0]?.[0];
                if (toastError) {
                    toastMixin.fire({
                        icon: 'error',
                        title: toastError
                    });
                }
            } else {
                // Show generic error message
                toastMixin.fire({
                    icon: 'error',
                    title: errorMessage || jsLang('An error occurred while saving the contact')
                });
            }
        },
        complete: function() {
            $('#saveBtnText').removeClass('hidden');
            $('#saveBtnLoader').addClass('hidden');
            $('#saveContactBtn').prop('disabled', false);
        }
    });
}

function editContact(id) {
    // Reset form and clear errors
    $('#contactForm')[0].reset();
    $('.error-message').addClass('hidden').text('');
    $('.border-red-500').removeClass('border-red-500');

    // Show loading state
    const formWrapper = $('#modal7 .px-7');
    formWrapper.addClass('opacity-50 pointer-events-none');

    // Change modal title
    $('#modal7 h5').text('Edit Contact');
    $('#modal7 p').text('Update your existing contact information.');

    // Fetch contact data
    $.ajax({
        url: getContactUrl.replace(':id', id),
        method: 'GET',
        success: function(response) {
            if (response.success) {
                const contact = response.contact;

                // Populate form fields
                $('#contactId').val(contact.id || '');
                $('#contactName').val(contact.name || '');

                // Set phone number - reconstruct for display
                if (phoneInput && contact.phone && contact.country_code) {
                    // Set the country first
                    phoneInput.setCountry(contact.country_code.toLowerCase());


                    const countryMeta = phoneInput.getSelectedCountryData();
                    const dialCode = countryMeta && countryMeta.dialCode ? countryMeta.dialCode : '';
                    let nationalNumber = contact.phone;

                    if (dialCode && contact.phone.startsWith(dialCode)) {
                        nationalNumber = contact.phone.substring(dialCode.length);
                    }

                    // Set the national number in the input
                    phoneInput.setNumber(nationalNumber);
                }

                // Set country code (ISO code)
                $('#countryCode').val(contact.country_code ? contact.country_code.toUpperCase() : '');

                // Reset and populate segments
                selectedSegments = {};
                $('.segment-checkbox').prop('checked', false);

                // Function to check and select segments
                function selectSegments(retryCount = 0) {
                    // Handle segment_ids (plural)
                    if (contact.segment_ids) {
                        let ids = [];
                        
                        // Handle different formats
                        if (Array.isArray(contact.segment_ids)) {
                            ids = contact.segment_ids;
                        } else if (typeof contact.segment_ids === 'string') {
                            // Try to parse as JSON first
                            try {
                                const parsed = JSON.parse(contact.segment_ids);
                                ids = Array.isArray(parsed) ? parsed : contact.segment_ids.split(',').map(id => id.trim()).filter(id => id);
                            } catch(e) {
                                // If not JSON, try comma-separated string
                                ids = contact.segment_ids.split(',').map(id => id.trim()).filter(id => id);
                            }
                        } else if (contact.segment_ids !== null && contact.segment_ids !== undefined) {
                            // Convert to array if it's a single value
                            ids = [contact.segment_ids];
                        }
                        
                        let allFound = true;
                        ids.forEach(id => {
                            const idStr = String(id).trim();
                            if (!idStr) return; // Skip empty values
                            
                            const $cb = $(`.segment-checkbox[value="${idStr}"]`);
                            
                            if ($cb.length) {
                                const segmentName = $cb.data('name') || $cb.closest('.segment-option').data('name') || `Segment ${idStr}`;
                                selectedSegments[idStr] = segmentName;
                                $cb.prop('checked', true);
                            } else {
                                selectedSegments[idStr] = `Segment ${idStr}`;
                                allFound = false;
                            }
                        });
                        
                        updateSelectedSegmentsDisplay();
                        updateSegmentIdsInput();
                        
                        // Retry if some checkboxes weren't found (segments might be loading)
                        if (!allFound && retryCount < 3) {
                            setTimeout(() => selectSegments(retryCount + 1), 200);
                        }
                    } else {
                        // No segments - ensure display is properly reset
                        $('#selectedSegmentIds').val('');
                        updateSelectedSegmentsDisplay();
                    }
                }

                // Show modal first
                const modal = $('#modal7');
                modal.removeClass('hidden');
                setTimeout(() => {
                    modal.addClass('opacity-100');
                    modal.find('.modalBox').addClass('scale-100 opacity-100');
                    
                    // Wait a bit for DOM to be ready, then select segments
                    setTimeout(selectSegments, 100);
                }, 50);
            }
        },
        error: function(xhr) {
            toastMixin.fire({
                icon: 'error',
                title: jsLang('Failed to load contact information. Please try again.')
            });
        },
        complete: function() {
            formWrapper.removeClass('opacity-50 pointer-events-none');
        }
    });
}

function getCsrfToken() {
    // Try meta tag first
    const metaToken = document.querySelector('meta[name="csrf-token"]');
    if (metaToken && metaToken.content) {
        return metaToken.content;
    }

    // Try hidden input in the form
    const formToken = document.querySelector('input[name="_token"]');
    if (formToken && formToken.value) {
        return formToken.value;
    }

    return '';
}

function deleteContact(id) {
    const modal = $(`#deleteModal-${id}`);
    const form = $(`#deleteContactForm-${id}`);
    const csrfToken = getCsrfToken();

    if (!form.length) {
        return;
    }

    const submitBtn = form.find('button[type="submit"]');
    const loader = submitBtn.find('.loader');
    const buttonText = submitBtn.find('span');

    // Show loader
    loader.removeClass('hidden');
    buttonText.addClass('opacity-0');
    submitBtn.prop('disabled', true);

    fetch(deleteContactUrl.replace(':id', id), {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            _method: 'DELETE'
        })
    })
        .then(async response => {
            if (!response.ok) {
                // Attempt to parse JSON regardless of status to get error message
                let payload = null;
                try { payload = await response.json(); } catch (_) {}

                // Show error message and close modal
                const errorMessage = (payload && (payload.message || payload.error)) || 'Request failed';
                toastMixin.fire({
                    title: errorMessage,
                    icon: 'error',
                });

                // Close the modal
                modal.removeClass('opacity-100');
                modal.find('.modalBox').removeClass('scale-100 opacity-100');
                setTimeout(() => {
                    modal.addClass('hidden');
                }, 300);

                // Reset UI state
                loader.addClass('hidden');
                buttonText.removeClass('opacity-0');
                submitBtn.prop('disabled', false);

                // Return null to indicate failure and skip success processing
                return null;
            }
            return response.json();
        })
        .then(data => {
            // Skip processing if error was already handled
            if (data === null) {
                return;
            }

            if (data.success) {
                // Remove the contact row
                $(`tr[data-contact-id="${id}"]`).remove();

                // Close modal
                modal.removeClass('opacity-100');
                modal.find('.modalBox').removeClass('scale-100 opacity-100');
                setTimeout(() => {
                    modal.addClass('hidden');
                }, 300);

                // Show success message
                toastMixin.fire({
                    icon: 'success',
                    title: data.message || jsLang('Contact deleted successfully')
                });

                // Reload contacts table after a short delay
                setTimeout(function() {
                    // Always use reloadContactsTable which is more reliable
                    if (typeof reloadContactsTable === 'function') {
                        reloadContactsTable();
                    } else {
                        // Direct call to searchContacts with null to reload without search filter
                        searchContacts(null);
                    }
                }, 500);
            } else {
                throw new Error(data.message || 'Failed to delete contact');
            }
        })
        .catch(error => {
            toastMixin.fire({
                icon: 'error',
                title: error.message || jsLang('Failed to delete contact')
            });
        })
        .finally(() => {
            // Reset button state
            loader.addClass('hidden');
            buttonText.removeClass('opacity-0');
            submitBtn.prop('disabled', false);
        });
}

// updatePagination function removed - pagination is now handled by the server-rendered table partial

function closeModal(modal) {
    // Clear segment values if this is the contact modal
    if (modal.attr('id') === 'modal7') {
        selectedSegments = {};
        $('.segment-checkbox').prop('checked', false);
        $('#selectedSegmentIds').val('');
        $('#selectedSegmentsTags').addClass('hidden').empty();
        $('#selectedCountBadge').addClass('hidden');
        $('input[name="segment_ids[]"]').remove();
        // Ensure display is properly reset
        updateSelectedSegmentsDisplay();
    }
    
    modal.removeClass('opacity-100');
    modal.find('.modalBox').removeClass('scale-100 opacity-100');
    setTimeout(() => {
        modal.addClass('hidden');
    }, 300);
}

$(document).on('click', '.openModalBtn', function() {
    $('.delete-subscriber').attr('data-id', $(this).data('id'));
});

$(document).on('click', '.delete-subscriber', function () {
    let id = $(this).attr("data-id");
    $(".loader").removeClass('hidden');
    $(this).attr('disabled');

    doAjaxprocess(
        SITE_URL + "/user/marketing-bot/subscriber/delete",
        {
            id : id,
            _token: CSRF_TOKEN
        },
        'delete',
        'json'
    ).done(function(response, textStatus, jqXHR) {
        toastMixin.fire({
            title: response.message,
            icon: textStatus,
        });
        $('#subscriber-row-'+id).remove();

        var $materialsBody = $('.subscriber-table');
        if ($materialsBody.find('[id^="subscriber-row-"]').length === 0) {
            $materialsBody.html(subscriberEmptyHtml());
        }
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
});

let debounceTimer;

function searchSubscribers(e) {
    const value = $(e).val().trim().toLowerCase();
    const url = SITE_URL + "/user/marketing-bot/subscribers?search=" + value;

    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        $.ajax({
            url: url,
            type: 'GET',
            data: {},
            dataType: 'json',
            beforeSend: function() {
                // Show skeleton loader
                if (window.subscribersSkeleton && typeof window.subscribersSkeleton.show === 'function') {
                    window.subscribersSkeleton.show();
                } else {
                    // Fallback if skeleton functions not available
                    $('.table-skeleton').removeClass('hidden');
                    $('.table-content').addClass('hidden');
                }
            },
            success: function (response) {
                if (response && response.items && String(response.items).trim().length) {
                    // Replace only the table-content element, not the skeleton
                    $('.subscriber-table.table-content').replaceWith(response.items);
                } else {
                    // Replace only the table-content element with empty state (wrap in proper div)
                    const emptyHtml = `<div class="subscriber-table table-content">${subscriberEmptyHtml()}</div>`;
                    $('.subscriber-table.table-content').replaceWith(emptyHtml);
                }

                // Hide skeleton loader after content is loaded
                if (window.subscribersSkeleton && typeof window.subscribersSkeleton.hide === 'function') {
                    window.subscribersSkeleton.hide();
                } else {
                    // Fallback if skeleton functions not available
                    $('.table-skeleton').addClass('hidden');
                    $('.table-content').removeClass('hidden');
                }
            },
            error: function(xhr, status, error) {
                // Hide skeleton loader on error
                if (window.subscribersSkeleton && typeof window.subscribersSkeleton.hide === 'function') {
                    window.subscribersSkeleton.hide();
                } else {
                    // Fallback if skeleton functions not available
                    $('.table-skeleton').addClass('hidden');
                    $('.table-content').removeClass('hidden');
                }
            }
        });
    }, 1000);
}

function subscriberEmptyHtml() {
    return `
    <section class="rounded-xl bg-white dark:bg-color-3A border border-color-89/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-light-icon dark:bg-dark-icon text-color-14 dark:text-white">
                    <tr>
                        <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">${jsLang('ID')}</th>
                        <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">${jsLang('Name')}</th>
                        <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">${jsLang('User Name')}</th>
                        <th class="text-end font-semibold px-6 py-5 text-xs uppercase tracking-wider">${jsLang('Actions')}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-color-3A divide-y divide-light-secondary/10 dark:divide-dark-secondary/10">
                    <tr>
                        <td colspan="7">
                            <svg class="mx-auto mt-10" xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <g clip-path="url(#clip0_2698_2638)">
                                    <path d="M38.6467 13.4583H5.35361C4.07374 13.4583 3.03613 14.4958 3.03613 15.7757V30.9319H40.9641V15.7757C40.9641 14.4959 39.9265 13.4583 38.6467 13.4583Z" fill="#FF9A00"/>
                                    <path d="M8.8972 0C7.26421 0 5.94043 1.32378 5.94043 2.95677V41.0432C5.94043 42.6762 7.26421 44 8.8972 44H35.1026C36.7356 44 38.0594 42.6762 38.0594 41.0432V9.11745C38.0594 8.52337 37.8234 7.95369 37.4034 7.53354L30.5258 0.655961C30.1057 0.235984 29.5359 0 28.9419 0L8.8972 0Z" fill="#F5F5F5"/>
                                    <path d="M37.4035 7.53367L32.8447 2.97485L32.8284 10.622C32.8274 11.102 33.2163 11.4918 33.6963 11.4918C34.1757 11.4918 34.5642 11.8804 34.5642 12.3597V41.0434C34.5642 42.6763 33.2404 44.0001 31.6074 44.0001H35.1027C36.7357 44.0001 38.0594 42.6763 38.0594 41.0434V12.1156V9.11749C38.0596 8.52341 37.8236 7.95373 37.4035 7.53367Z" fill="#EAEAEA"/>
                                    <path d="M37.4033 7.5335L30.5257 0.655926C30.3342 0.464457 30.1114 0.311746 29.8696 0.20166V5.23279C29.8696 6.86577 31.1934 8.18955 32.8264 8.18955H37.8575C37.7475 7.94772 37.5948 7.72497 37.4033 7.5335Z" fill="#A8D0D5"/>
                                    <path d="M16.3243 21.9575L15.7131 20.5742C15.3422 19.7349 14.511 19.1934 13.5934 19.1934H5.35361C4.07374 19.1934 3.03613 20.2309 3.03613 21.5108V41.6824C3.03613 42.9623 4.07366 43.9999 5.35361 43.9999H38.6467C39.9265 43.9999 40.9641 42.9624 40.9641 41.6824V25.6559C40.9641 24.376 39.9266 23.3384 38.6467 23.3384H18.4441C17.5264 23.3384 16.6952 22.7969 16.3243 21.9575Z" fill="#FFB541"/>
                                    <path d="M12.187 20.5742L12.7982 21.9575C13.1691 22.7968 14.0003 23.3383 14.918 23.3383H18.444C17.5263 23.3382 16.6952 22.7968 16.3243 21.9575L15.7131 20.5742C15.3422 19.7349 14.511 19.1934 13.5934 19.1934H10.0674C10.985 19.1934 11.8161 19.7349 12.187 20.5742Z" fill="#FFA812"/>
                                    <path d="M38.6468 23.3384H35.1209C36.4006 23.3385 37.4381 24.376 37.4381 25.6559V41.6825C37.4381 42.9624 36.4006 44 35.1206 44H38.6467C39.9266 44 40.9642 42.9625 40.9642 41.6825V25.6558C40.9643 24.3759 39.9267 23.3384 38.6468 23.3384Z" fill="#FFA812"/>
                                    <path d="M16.6176 4.86731H10.0499C9.68309 4.86731 9.38574 4.56997 9.38574 4.20319C9.38574 3.83641 9.68309 3.53906 10.0499 3.53906H16.6176C16.9844 3.53906 17.2818 3.83641 17.2818 4.20319C17.2818 4.56997 16.9845 4.86731 16.6176 4.86731Z" fill="#3693BD"/>
                                    <path d="M16.6176 8.86121H10.0499C9.68309 8.86121 9.38574 8.56387 9.38574 8.19708C9.38574 7.8303 9.68309 7.53296 10.0499 7.53296H16.6176C16.9844 7.53296 17.2818 7.8303 17.2818 8.19708C17.2818 8.56387 16.9845 8.86121 16.6176 8.86121Z" fill="#3693BD"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_2698_2638">
                                        <rect width="44" height="44" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <p class="text-color-14 dark:text-white text-center font-medium font-Figtree text-20 mt-6">${jsLang('No subscribers found')}</p>
                            <p class="text-center font-medium text-color-89 text-15 px-5 py-3 font-Figtree mt-3 md:w-[450px] mx-auto">${jsLang('Looks like you did not add any subscribers yet.')}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    `;
}

// Initialize CSV import form
function initializeImportForm() {
    const csvFileInput = $('#csvFileInput');
    const fileNameDisplay = $('#fileNameDisplay');
    const importBtn = $('#importBtn');
    const importBtnText = $('#importBtnText');
    const importSubmitBtn = $('#importSubmitBtn');
    const fileInfoDisplay = $('#fileInfoDisplay');
    const changeFileBtn = $('#changeFileBtn');
    
    if (!csvFileInput.length) {
        return; // Import form not present on this page
    }
    
    // Click Import button to open file dialog
    importBtn.on('click', function(e) {
        e.preventDefault();
        csvFileInput.click();
    });
    
    // Change file button - open file dialog again
    changeFileBtn.on('click', function(e) {
        e.preventDefault();
        csvFileInput.click();
    });
    
    csvFileInput.on('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validate file type
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();

            if (fileExtension !== 'csv' && fileExtension !== 'xlsx') {
                toastMixin.fire({
                    icon: 'error',
                    title: jsLang('Please select a CSV or XLSX file only.')
                });
                csvFileInput.val('');
                resetFileInput();
                return;
            }
            
            // Update UI - show file info and submit button
            fileNameDisplay.text(fileName);
            fileInfoDisplay.removeClass('hidden');
            importBtn.addClass('hidden');
            importSubmitBtn.removeClass('hidden');
        } else {
            resetFileInput();
        }
    });
    
    // Reset file input function
    function resetFileInput() {
        fileNameDisplay.text('');
        fileInfoDisplay.addClass('hidden');
        importBtn.removeClass('hidden');
        importSubmitBtn.addClass('hidden');
        csvFileInput.val('');
    }
    
    // Reset on form reset
    $('#importForm').on('reset', function() {
        setTimeout(resetFileInput, 100);
    });
    
    // Handle form submission - show loading state
    $('#importForm').on('submit', function(e) {
        if (!csvFileInput[0].files.length) {
            e.preventDefault();
            toastMixin.fire({
                icon: 'error',
                title: jsLang('Please select a CSV file first.')
            });
            return false;
        }
        
        importSubmitBtn.prop('disabled', true).html(`
            <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>${jsLang('Importing...')}</span>
        `);
    });
}
