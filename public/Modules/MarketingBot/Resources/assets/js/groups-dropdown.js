"use strict";

/**
 * Groups Dropdown with Infinite Scroll, Search, and Multi-Select
 * Handles groups selection for Telegram campaigns
 */
$(document).ready(function() {
    let $groupsDropdown, $groupsContainer, $groupsSearch, $groupsLoader;
    let $groupsButton, $groupsHiddenInput, $groupsDisplay;
    let selectedGroups = [];
    let searchTimeout;
    let isLoading = false;
    let currentXhr = null;
    let currentPage = 1;
    let hasMorePages = true;
    let baseUrl = '';

    /**
     * Initialize groups dropdown functionality
     */
    function init() {
        $groupsDropdown = $('#groups-dropdown');
        $groupsContainer = $('#groups-container');
        $groupsSearch = $('#groups-search');
        $groupsLoader = $('#groups-loader');
        $groupsButton = $('#groups-button');
        $groupsHiddenInput = $('#groups-hidden-input');
        $groupsDisplay = $('#groups-display');

        if ($groupsDropdown.length === 0 || $groupsContainer.length === 0) return;

        // Get base URL
        baseUrl = $groupsDropdown.attr('data-base-url') || '';

        // Attach handlers to existing groups in DOM (server-side rendered)
        attachHandlersToExistingGroups();

        // Load initial groups via AJAX if baseUrl exists, otherwise use existing DOM items
        if (baseUrl) {
            loadGroups(true);
        }

        setupEventListeners();
    }

    /**
     * Setup event listeners
     */
    function setupEventListeners() {
        // Prevent dropdown from closing when clicking anywhere inside it
        $groupsDropdown.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent clicks on search input and container from closing dropdown
        $groupsSearch.on('click', function(e) {
            e.stopPropagation();
        });

        $groupsContainer.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent clicks on any child elements from closing dropdown
        $groupsDropdown.on('click', '*', function(e) {
            e.stopPropagation();
        });

        // Search input with debouncing
        $groupsSearch.on('input', function(e) {
            clearTimeout(searchTimeout);
            const searchTerm = $(this).val().trim();

            // Show loader immediately when user types
            if ($groupsLoader.length > 0) {
                if (searchTerm) {
                    $groupsLoader.removeClass('hidden');
                } else {
                    $groupsLoader.addClass('hidden');
                }
            }

            // Debounce search request
            searchTimeout = setTimeout(function() {
                loadGroups(true, searchTerm);
            }, 300);
        });

        // Infinite scroll
        $groupsContainer.on('scroll', function() {
            if (isLoading || !hasMorePages) return;

            const $this = $(this);
            const scrollTop = $this.scrollTop();
            const scrollHeight = $this[0].scrollHeight;
            const clientHeight = $this.height();

            // Load more when scrolled to 80% of the container
            if (scrollTop + clientHeight >= scrollHeight * 0.8) {
                loadGroups(false);
            }
        });
    }

    /**
     * Load groups via AJAX
     * @param {boolean} reset - Whether to reset the list or append
     * @param {string} searchTerm - Search term to filter groups
     */
    function loadGroups(reset = false, searchTerm = '') {
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
            filterStaticGroups(searchTerm);
            // Re-attach handlers after filtering
            attachHandlersToExistingGroups();
            isLoading = false;
            if ($groupsLoader.length > 0) {
                $groupsLoader.addClass('hidden');
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

                if (data.success && data.groups) {
                    if (reset) {
                        $groupsContainer.html('');
                    }

                    // Check if groups array is empty (no results found)
                    if (data.groups.length === 0 && reset) {
                        $groupsContainer.html(`
                            <div class="px-4 py-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-color-89 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-color-89 dark:text-gray-400">${jsLang('No groups found')}</p>
                                <p class="text-xs text-color-89 dark:text-gray-500 mt-1">${jsLang('Try adjusting your search terms')}</p>
                            </div>
                        `);
                        currentPage = data.current_page;
                        hasMorePages = data.has_more_pages;
                        return;
                    }

                    // Add groups to container
                    data.groups.forEach(function(group) {
                        const isSelected = selectedGroups.includes(group.id);
                        const $groupItem = $(`
                            <div class="px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer flex items-center gap-3 transition-colors duration-150"
                                data-id="${group.id}"
                                data-name="${escapeHtml(group.name)}">
                                <div class="relative flex items-center">
                                    <input type="checkbox"
                                           class="group-checkbox w-4 h-4 rounded border-color-DF dark:border-color-47 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-0 cursor-pointer transition-all duration-150"
                                           value="${group.id}"
                                           ${isSelected ? 'checked' : ''}>
                                </div>
                                <span class="flex-1 font-medium">${escapeHtml(group.name)}</span>
                            </div>
                        `);

                        attachGroupHandlers($groupItem);
                        $groupsContainer.append($groupItem);
                    });

                    // Update pagination info
                    currentPage = data.current_page;
                    hasMorePages = data.has_more_pages;
                } else {
                    // Show error message
                    if (reset) {
                        $groupsContainer.html(`
                            <div class="px-4 py-8 text-center">
                                <p class="text-sm text-red-500">${jsLang('Failed to load groups')}</p>
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

                console.error('Error loading groups:', error);

                // Show error message
                if (reset) {
                    $groupsContainer.html(`
                        <div class="px-4 py-8 text-center">
                            <p class="text-sm text-red-500">Failed to load groups</p>
                        </div>
                    `);
                }
            },
            complete: function() {
                isLoading = false;
                currentXhr = null;

                // Hide loader
                if ($groupsLoader.length > 0) {
                    $groupsLoader.addClass('hidden');
                }
            }
        });
    }

    /**
     * Attach handlers to existing groups in the DOM (server-side rendered)
     */
    function attachHandlersToExistingGroups() {
        $groupsContainer.find('.group-checkbox').each(function() {
            const $checkbox = $(this);
            const $groupItem = $checkbox.closest('[data-id]');
            
            if ($groupItem.length === 0) return;

            // Handle checkbox changes
            $checkbox.off('change').on('change', function() {
                const groupId = $(this).val();
                const groupName = $groupItem.attr('data-name');

                if ($(this).is(':checked')) {
                    if (!selectedGroups.includes(groupId)) {
                        selectedGroups.push(groupId);
                    }
                } else {
                    const index = selectedGroups.indexOf(groupId);
                    if (index > -1) {
                        selectedGroups.splice(index, 1);
                    }
                }

                updateSelectedDisplay();
            });

            // Prevent checkbox click from bubbling to row
            $checkbox.off('click').on('click', function(e) {
                e.stopPropagation();
            });

            // Handle row click - toggle checkbox when clicking anywhere on the row
            $groupItem.off('click').on('click', function(e) {
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
     * Filter static groups (client-side filtering when no AJAX endpoint)
     */
    function filterStaticGroups(searchTerm = '') {
        const $allItems = $groupsContainer.find('[data-id]');
        
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
     * Attach event handlers to group item
     */
    function attachGroupHandlers($groupItem) {
        const $checkbox = $groupItem.find('.group-checkbox');
        
        // Handle checkbox changes
        $checkbox.on('change', function() {
            const groupId = $(this).val();
            const groupName = $(this).closest('[data-name]').attr('data-name');

            if ($(this).is(':checked')) {
                if (!selectedGroups.includes(groupId)) {
                    selectedGroups.push(groupId);
                }
            } else {
                const index = selectedGroups.indexOf(groupId);
                if (index > -1) {
                    selectedGroups.splice(index, 1);
                }
            }

            updateSelectedDisplay();
        });

        // Prevent checkbox click from bubbling to row
        $checkbox.on('click', function(e) {
            e.stopPropagation();
        });

        // Handle row click - toggle checkbox when clicking anywhere on the row
        $groupItem.on('click', function(e) {
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
     * Update the selected groups display
     */
    function updateSelectedDisplay() {
        if ($groupsHiddenInput.length > 0) {
            $groupsHiddenInput.val(selectedGroups.join(','));
        }

        if ($groupsDisplay.length > 0) {
            if (selectedGroups.length === 0) {
                $groupsDisplay.text(jsLang('Select Group'));
            } else if (selectedGroups.length === 1) {
                // Find the group name
                const $selectedItem = $groupsContainer.find(`[data-id="${selectedGroups[0]}"]`);
                const groupName = $selectedItem.attr('data-name') || jsLang('Group');
                $groupsDisplay.text(groupName);
            } else {
                $groupsDisplay.text(`${selectedGroups.length} ${jsLang('groups selected')}`);
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

