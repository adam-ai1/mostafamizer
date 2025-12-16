"use strict";

/**
 * Contacts Dropdown with Infinite Scroll, Search, and Multi-Select
 * Handles contacts selection for WhatsApp campaigns
 */
$(document).ready(function() {
    let $contactsDropdown, $contactsContainer, $contactsSearch, $contactsLoader;
    let $contactsButton, $contactsHiddenInput, $contactsDisplay;
    let selectedContacts = [];
    let searchTimeout;
    let isLoading = false;
    let currentXhr = null;
    let currentPage = 1;
    let hasMorePages = true;
    let baseUrl = '';

    /**
     * Initialize contacts dropdown functionality
     */
    function init() {
        $contactsDropdown = $('#contacts-dropdown');
        $contactsContainer = $('#contacts-container');
        $contactsSearch = $('#contacts-search');
        $contactsLoader = $('#contacts-loader');
        $contactsButton = $('#contacts-button');
        $contactsHiddenInput = $('#contacts-hidden-input');
        $contactsDisplay = $('#contacts-display');

        if ($contactsDropdown.length === 0 || $contactsContainer.length === 0) return;

        // Get base URL
        baseUrl = $contactsDropdown.attr('data-base-url') || '{{ route("user.marketing-bot.contacts.dropdown") }}';

        // Load initial contacts
        loadContacts(true);

        setupEventListeners();
    }

    /**
     * Setup event listeners
     */
    function setupEventListeners() {
        // Prevent dropdown from closing when clicking anywhere inside it
        $contactsDropdown.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent clicks on search input and container from closing dropdown
        $contactsSearch.on('click', function(e) {
            e.stopPropagation();
        });

        $contactsContainer.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent clicks on any child elements from closing dropdown
        $contactsDropdown.on('click', '*', function(e) {
            e.stopPropagation();
        });

        // Search input with debouncing
        $contactsSearch.on('input', function(e) {
            clearTimeout(searchTimeout);
            const searchTerm = $(this).val().trim();

            // Show loader immediately when user types
            if ($contactsLoader.length > 0) {
                if (searchTerm) {
                    $contactsLoader.removeClass('hidden');
                } else {
                    $contactsLoader.addClass('hidden');
                }
            }

            // Debounce search request
            searchTimeout = setTimeout(function() {
                loadContacts(true, searchTerm);
            }, 300);
        });

        // Infinite scroll
        $contactsContainer.on('scroll', function() {
            if (isLoading || !hasMorePages) return;

            const $this = $(this);
            const scrollTop = $this.scrollTop();
            const scrollHeight = $this[0].scrollHeight;
            const clientHeight = $this.height();

            // Load more when scrolled to 80% of the container
            if (scrollTop + clientHeight >= scrollHeight * 0.8) {
                loadContacts(false);
            }
        });

        // Close dropdown when clicking outside (handled in main blade file)
        // This is commented out to avoid conflicts with the main script
        // $(document).on('click', function(e) {
        //     if (!$contactsDropdown.has(e.target).length && !$contactsButton.has(e.target).length) {
        //         $contactsDropdown.slideUp(200);
        //     }
        // });
    }

    /**
     * Load contacts via AJAX
     * @param {boolean} reset - Whether to reset the list or append
     * @param {string} searchTerm - Search term to filter contacts
     */
    function loadContacts(reset = false, searchTerm = '') {
        if (isLoading) return;

        // Abort previous request if still pending
        if (currentXhr && currentXhr.readyState !== 4) {
            currentXhr.abort();
            currentXhr = null;
        }

        isLoading = true;

        if (reset) {
            currentPage = 1;
            hasMorePages = true;
        }

        let url = baseUrl;
        const params = new URLSearchParams();
        params.append('page', currentPage);

        if (searchTerm) {
            params.append('search', searchTerm);
        }

        if (params.toString()) {
            url += '?' + params.toString();
        }

        currentXhr = $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            beforeSend: function(xhr) {
                currentXhr = xhr;
            },
            success: function(data) {
                if (currentXhr && currentXhr.statusText === 'abort') {
                    return;
                }

                if (data.success && data.contacts) {
                    if (reset) {
                        $contactsContainer.html('');
                    }

                    // Check if contacts array is empty (no results found)
                    if (data.contacts.length === 0 && reset) {
                        $contactsContainer.html(`
                            <div class="px-4 py-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-color-89 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-color-89 dark:text-gray-400">${jsLang('No contacts found')}</p>
                                <p class="text-xs text-color-89 dark:text-gray-500 mt-1">${jsLang('Try adjusting your search terms')}</p>
                            </div>
                        `);
                        currentPage = data.current_page;
                        hasMorePages = data.has_more_pages;
                        return;
                    }

                    // Add contacts to container
                    data.contacts.forEach(function(contact) {
                        const isSelected = selectedContacts.includes(contact.id);
                        const contactName = contact.name || contact.phone || `Contact ${contact.id}`;
                        const $contactItem = $(`
                            <div class="px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer flex items-center gap-3 transition-colors duration-150"
                                data-id="${contact.id}"
                                data-name="${escapeHtml(contactName)}">
                                <div class="relative flex items-center">
                                    <input type="checkbox"
                                           class="contact-checkbox w-4 h-4 rounded border-color-DF dark:border-color-47 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-0 cursor-pointer transition-all duration-150"
                                           value="${contact.id}"
                                           ${isSelected ? 'checked' : ''}>
                                </div>
                                <span class="flex-1 font-medium">${escapeHtml(contactName)}</span>
                            </div>
                        `);

                        // Handle checkbox changes
                        const $checkbox = $contactItem.find('.contact-checkbox');
                        $checkbox.on('change', function() {
                            const contactId = $(this).val();
                            const contactName = $(this).closest('[data-name]').attr('data-name');

                            if ($(this).is(':checked')) {
                                if (!selectedContacts.includes(contactId)) {
                                    selectedContacts.push(contactId);
                                }
                            } else {
                                const index = selectedContacts.indexOf(contactId);
                                if (index > -1) {
                                    selectedContacts.splice(index, 1);
                                }
                            }

                            updateSelectedDisplay();
                        });

                        // Prevent checkbox click from bubbling to row
                        $checkbox.on('click', function(e) {
                            e.stopPropagation();
                        });

                        // Handle row click - toggle checkbox when clicking anywhere on the row
                        $contactItem.on('click', function(e) {
                            // Don't trigger if clicking directly on the checkbox
                            if ($(e.target).is('input[type="checkbox"]')) {
                                return;
                            }
                            
                            e.preventDefault();
                            e.stopPropagation();
                            
                            // Toggle checkbox
                            const isChecked = $checkbox.is(':checked');
                            $checkbox.prop('checked', !isChecked).trigger('change');
                        });

                        $contactsContainer.append($contactItem);
                    });

                    // Update pagination info
                    currentPage = data.current_page;
                    hasMorePages = data.has_more_pages;
                } else {
                    // Show error message
                    if (reset) {
                        $contactsContainer.html(`
                            <div class="px-4 py-8 text-center">
                                <p class="text-sm text-red-500">${jsLang('Failed to load contacts')}</p>
                            </div>
                        `);
                    }
                }
            },
            error: function(xhr, status, error) {
                // Ignore abort errors
                if (status === 'abort') {
                    return;
                }

                console.error('Error loading contacts:', error);

                // Show error message
                if (reset) {
                    $contactsContainer.html(`
                        <div class="px-4 py-8 text-center">
                            <p class="text-sm text-red-500">Failed to load contacts</p>
                        </div>
                    `);
                }
            },
            complete: function() {
                isLoading = false;
                currentXhr = null;

                // Hide loader
                if ($contactsLoader.length > 0) {
                    $contactsLoader.addClass('hidden');
                }
            }
        });
    }

    /**
     * Update the selected contacts display
     */
    function updateSelectedDisplay() {
        if ($contactsHiddenInput.length > 0) {
            $contactsHiddenInput.val(selectedContacts.join(','));
        }

        if ($contactsDisplay.length > 0) {
            if (selectedContacts.length === 0) {
                $contactsDisplay.text(jsLang('Select Contact List'));
            } else if (selectedContacts.length === 1) {
                // Find the contact name
                const $selectedItem = $contactsContainer.find(`[data-id="${selectedContacts[0]}"]`);
                const contactName = $selectedItem.attr('data-name') || jsLang('Contact');
                $contactsDisplay.text(contactName);
            } else {
                $contactsDisplay.text(`${selectedContacts.length} ${jsLang('contacts selected')}`);
            }
        }
    }

    /**
     * Escape HTML to prevent XSS
     */
    function escapeHtml(unsafe) {
        if (unsafe == null) {
            return '';
        }

        const str = String(unsafe);

        return str
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // Initialize
    init();
});
