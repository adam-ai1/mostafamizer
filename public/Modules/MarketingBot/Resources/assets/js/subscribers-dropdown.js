"use strict";

/**
 * Subscribers Dropdown with Infinite Scroll, Search, and Multi-Select
 * Handles subscribers selection for Telegram campaigns
 */
$(document).ready(function() {
    let $subscribersDropdown, $subscribersContainer, $subscribersSearch, $subscribersLoader;
    let $subscribersButton, $subscribersHiddenInput, $subscribersDisplay;
    let selectedSubscribers = [];
    let searchTimeout;
    let isLoading = false;
    let currentXhr = null;
    let currentPage = 1;
    let hasMorePages = true;
    let baseUrl = '';

    /**
     * Initialize subscribers dropdown functionality
     */
    function init() {
        $subscribersDropdown = $('#subscribers-dropdown');
        $subscribersContainer = $('#subscribers-container');
        $subscribersSearch = $('#subscribers-search');
        $subscribersLoader = $('#subscribers-loader');
        $subscribersButton = $('#subscribers-button');
        $subscribersHiddenInput = $('#subscribers-hidden-input');
        $subscribersDisplay = $('#subscribers-display');

        if ($subscribersDropdown.length === 0 || $subscribersContainer.length === 0) return;

        // Get base URL
        baseUrl = $subscribersDropdown.attr('data-base-url') || '';

        // Attach handlers to existing subscribers in DOM (server-side rendered)
        attachHandlersToExistingSubscribers();

        // Load initial subscribers via AJAX if baseUrl exists, otherwise use existing DOM items
        if (baseUrl) {
            loadSubscribers(true);
        }

        setupEventListeners();
    }

    /**
     * Setup event listeners
     */
    function setupEventListeners() {
        // Prevent dropdown from closing when clicking anywhere inside it
        $subscribersDropdown.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent clicks on search input and container from closing dropdown
        $subscribersSearch.on('click', function(e) {
            e.stopPropagation();
        });

        $subscribersContainer.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent clicks on any child elements from closing dropdown
        $subscribersDropdown.on('click', '*', function(e) {
            e.stopPropagation();
        });

        // Search input with debouncing
        $subscribersSearch.on('input', function(e) {
            clearTimeout(searchTimeout);
            const searchTerm = $(this).val().trim();

            // Show loader immediately when user types
            if ($subscribersLoader.length > 0) {
                if (searchTerm) {
                    $subscribersLoader.removeClass('hidden');
                } else {
                    $subscribersLoader.addClass('hidden');
                }
            }

            // Debounce search request
            searchTimeout = setTimeout(function() {
                loadSubscribers(true, searchTerm);
            }, 300);
        });

        // Infinite scroll
        $subscribersContainer.on('scroll', function() {
            if (isLoading || !hasMorePages) return;

            const $this = $(this);
            const scrollTop = $this.scrollTop();
            const scrollHeight = $this[0].scrollHeight;
            const clientHeight = $this.height();

            // Load more when scrolled to 80% of the container
            if (scrollTop + clientHeight >= scrollHeight * 0.8) {
                loadSubscribers(false);
            }
        });
    }

    /**
     * Load subscribers via AJAX
     * @param {boolean} reset - Whether to reset the list or append
     * @param {string} searchTerm - Search term to filter subscribers
     */
    function loadSubscribers(reset = false, searchTerm = '') {
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

        // If no base URL, use static data from page
        if (!baseUrl) {
            // Use client-side filtering on existing DOM items
            filterStaticSubscribers(searchTerm);
            // Re-attach handlers after filtering
            attachHandlersToExistingSubscribers();
            isLoading = false;
            if ($subscribersLoader.length > 0) {
                $subscribersLoader.addClass('hidden');
            }
            return;
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

                if (data.success && data.subscribers) {
                    if (reset) {
                        $subscribersContainer.html('');
                    }

                    // Check if subscribers array is empty (no results found)
                    if (data.subscribers.length === 0 && reset) {
                        $subscribersContainer.html(`
                            <div class="px-4 py-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-color-89 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-color-89 dark:text-gray-400">${jsLang('No subscribers found')}</p>
                                <p class="text-xs text-color-89 dark:text-gray-500 mt-1">${jsLang('Try adjusting your search terms')}</p>
                            </div>
                        `);
                        currentPage = data.current_page;
                        hasMorePages = data.has_more_pages;
                        return;
                    }

                    // Add subscribers to container
                    data.subscribers.forEach(function(subscriber) {
                        const isSelected = selectedSubscribers.includes(subscriber.id);
                        const subscriberName = subscriber.name || subscriber.phone || `Subscriber ${subscriber.id}`;
                        const $subscriberItem = $(`
                            <div class="px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer flex items-center gap-3 transition-colors duration-150"
                                data-id="${subscriber.id}"
                                data-name="${escapeHtml(subscriberName)}">
                                <div class="relative flex items-center">
                                    <input type="checkbox"
                                           class="subscriber-checkbox w-4 h-4 rounded border-color-DF dark:border-color-47 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-0 cursor-pointer transition-all duration-150"
                                           value="${subscriber.id}"
                                           ${isSelected ? 'checked' : ''}>
                                </div>
                                <span class="flex-1 font-medium">${escapeHtml(subscriberName)}</span>
                            </div>
                        `);

                        attachSubscriberHandlers($subscriberItem);
                        $subscribersContainer.append($subscriberItem);
                    });

                    // Update pagination info
                    currentPage = data.current_page;
                    hasMorePages = data.has_more_pages;
                } else {
                    // Show error message
                    if (reset) {
                        $subscribersContainer.html(`
                            <div class="px-4 py-8 text-center">
                                <p class="text-sm text-red-500">${jsLang('Failed to load subscribers')}</p>
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

                console.error('Error loading subscribers:', error);

                // Show error message
                if (reset) {
                    $subscribersContainer.html(`
                        <div class="px-4 py-8 text-center">
                            <p class="text-sm text-red-500">Failed to load subscribers</p>
                        </div>
                    `);
                }
            },
            complete: function() {
                isLoading = false;
                currentXhr = null;

                // Hide loader
                if ($subscribersLoader.length > 0) {
                    $subscribersLoader.addClass('hidden');
                }
            }
        });
    }

    /**
     * Attach handlers to existing subscribers in the DOM (server-side rendered)
     */
    function attachHandlersToExistingSubscribers() {
        $subscribersContainer.find('.subscriber-checkbox').each(function() {
            const $checkbox = $(this);
            const $subscriberItem = $checkbox.closest('[data-id]');
            
            if ($subscriberItem.length === 0) return;

            // Handle checkbox changes
            $checkbox.off('change').on('change', function() {
                const subscriberId = $(this).val();
                const subscriberName = $subscriberItem.attr('data-name');

                if ($(this).is(':checked')) {
                    if (!selectedSubscribers.includes(subscriberId)) {
                        selectedSubscribers.push(subscriberId);
                    }
                } else {
                    const index = selectedSubscribers.indexOf(subscriberId);
                    if (index > -1) {
                        selectedSubscribers.splice(index, 1);
                    }
                }

                updateSelectedDisplay();
            });

            // Prevent checkbox click from bubbling to row
            $checkbox.off('click').on('click', function(e) {
                e.stopPropagation();
            });

            // Handle row click - toggle checkbox when clicking anywhere on the row
            $subscriberItem.off('click').on('click', function(e) {
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
        });
    }

    /**
     * Filter static subscribers (client-side filtering when no AJAX endpoint)
     */
    function filterStaticSubscribers(searchTerm = '') {
        const $allItems = $subscribersContainer.find('[data-id]');
        
        if (searchTerm) {
            const searchLower = searchTerm.toLowerCase();
            $allItems.each(function() {
                const $item = $(this);
                const name = $item.attr('data-name') || '';
                if (name.toLowerCase().includes(searchLower)) {
                    $item.show();
                } else {
                    $item.hide();
                }
            });
        } else {
            $allItems.show();
        }
    }

    /**
     * Attach event handlers to subscriber item
     */
    function attachSubscriberHandlers($subscriberItem) {
        const $checkbox = $subscriberItem.find('.subscriber-checkbox');
        
        // Handle checkbox changes
        $checkbox.on('change', function() {
            const subscriberId = $(this).val();
            const subscriberName = $(this).closest('[data-name]').attr('data-name');

            if ($(this).is(':checked')) {
                if (!selectedSubscribers.includes(subscriberId)) {
                    selectedSubscribers.push(subscriberId);
                }
            } else {
                const index = selectedSubscribers.indexOf(subscriberId);
                if (index > -1) {
                    selectedSubscribers.splice(index, 1);
                }
            }

            updateSelectedDisplay();
        });

        // Prevent checkbox click from bubbling to row
        $checkbox.on('click', function(e) {
            e.stopPropagation();
        });

        // Handle row click - toggle checkbox when clicking anywhere on the row
        $subscriberItem.on('click', function(e) {
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
    }

    /**
     * Update the selected subscribers display
     */
    function updateSelectedDisplay() {
        if ($subscribersHiddenInput.length > 0) {
            $subscribersHiddenInput.val(selectedSubscribers.join(','));
        }

        if ($subscribersDisplay.length > 0) {
            if (selectedSubscribers.length === 0) {
                $subscribersDisplay.text(jsLang('Select Subscriber'));
            } else if (selectedSubscribers.length === 1) {
                // Find the subscriber name
                const $selectedItem = $subscribersContainer.find(`[data-id="${selectedSubscribers[0]}"]`);
                const subscriberName = $selectedItem.attr('data-name') || jsLang('Subscriber');
                $subscribersDisplay.text(subscriberName);
            } else {
                $subscribersDisplay.text(`${selectedSubscribers.length} ${jsLang('subscribers selected')}`);
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

