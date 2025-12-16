"use strict";

/**
 * Segments Dropdown with Infinite Scroll, Search, and Multi-Select
 * Handles segments selection for WhatsApp campaigns
 */
$(document).ready(function() {
    let $segmentsDropdown, $segmentsContainer, $segmentsSearch, $segmentsLoader;
    let $segmentsButton, $segmentsHiddenInput, $segmentsDisplay;
    let selectedSegments = [];
    let searchTimeout;
    let isLoading = false;
    let currentXhr = null;
    let currentPage = 1;
    let hasMorePages = true;
    let baseUrl = '';

    /**
     * Initialize segments dropdown functionality
     */
    function init() {
        $segmentsDropdown = $('#segments-dropdown');
        $segmentsContainer = $('#segments-container');
        $segmentsSearch = $('#segments-search');
        $segmentsLoader = $('#segments-loader');
        $segmentsButton = $('#segments-button');
        $segmentsHiddenInput = $('#segments-hidden-input');
        $segmentsDisplay = $('#segments-display');

        if ($segmentsDropdown.length === 0 || $segmentsContainer.length === 0) return;

        // Get base URL
        baseUrl = $segmentsDropdown.attr('data-base-url') || '{{ route("user.marketing-bot.segments.dropdown") }}';

        // Load initial segments
        loadSegments(true);

        setupEventListeners();
    }

    /**
     * Setup event listeners
     */
    function setupEventListeners() {
        // Prevent dropdown from closing when clicking anywhere inside it
        $segmentsDropdown.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent clicks on search input and container from closing dropdown
        $segmentsSearch.on('click', function(e) {
            e.stopPropagation();
        });

        $segmentsContainer.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent clicks on any child elements from closing dropdown
        $segmentsDropdown.on('click', '*', function(e) {
            e.stopPropagation();
        });

        // Search input with debouncing
        $segmentsSearch.on('input', function(e) {
            clearTimeout(searchTimeout);
            const searchTerm = $(this).val().trim();

            // Show loader immediately when user types
            if ($segmentsLoader.length > 0) {
                if (searchTerm) {
                    $segmentsLoader.removeClass('hidden');
                } else {
                    $segmentsLoader.addClass('hidden');
                }
            }

            // Debounce search request
            searchTimeout = setTimeout(function() {
                loadSegments(true, searchTerm);
            }, 300);
        });

        // Infinite scroll
        $segmentsContainer.on('scroll', function() {
            if (isLoading || !hasMorePages) return;

            const $this = $(this);
            const scrollTop = $this.scrollTop();
            const scrollHeight = $this[0].scrollHeight;
            const clientHeight = $this.height();

            // Load more when scrolled to 80% of the container
            if (scrollTop + clientHeight >= scrollHeight * 0.8) {
                loadSegments(false);
            }
        });

        // Close dropdown when clicking outside (handled in main blade file)
        // This is commented out to avoid conflicts with the main script
        // $(document).on('click', function(e) {
        //     if (!$segmentsDropdown.has(e.target).length && !$segmentsButton.has(e.target).length) {
        //         $segmentsDropdown.slideUp(200);
        //     }
        // });
    }

    /**
     * Load segments via AJAX
     * @param {boolean} reset - Whether to reset the list or append
     * @param {string} searchTerm - Search term to filter segments
     */
    function loadSegments(reset = false, searchTerm = '') {
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

                if (data.success && data.segments) {
                    if (reset) {
                        $segmentsContainer.html('');
                    }

                    // Check if segments array is empty (no results found)
                    if (data.segments.length === 0 && reset) {
                        $segmentsContainer.html(`
                            <div class="px-4 py-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-color-89 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-color-89 dark:text-gray-400">${jsLang('No segments found')}</p>
                                <p class="text-xs text-color-89 dark:text-gray-500 mt-1">${jsLang('Try adjusting your search terms')}</p>
                            </div>
                        `);
                        currentPage = data.current_page;
                        hasMorePages = data.has_more_pages;
                        return;
                    }

                    // Add segments to container
                    data.segments.forEach(function(segment) {
                        const isSelected = selectedSegments.includes(segment.id);
                        const $segmentItem = $(`
                            <div class="px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer flex items-center gap-3 transition-colors duration-150"
                                data-id="${segment.id}"
                                data-name="${escapeHtml(segment.name)}">
                                <div class="relative flex items-center">
                                    <input type="checkbox"
                                           class="segment-checkbox w-4 h-4 rounded border-color-DF dark:border-color-47 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-0 cursor-pointer transition-all duration-150"
                                           value="${segment.id}"
                                           ${isSelected ? 'checked' : ''}>
                                </div>
                                <span class="flex-1 font-medium">${escapeHtml(segment.name)}</span>
                            </div>
                        `);

                        // Handle checkbox changes
                        const $checkbox = $segmentItem.find('.segment-checkbox');
                        $checkbox.on('change', function() {
                            const segmentId = $(this).val();
                            const segmentName = $(this).closest('[data-name]').attr('data-name');

                            if ($(this).is(':checked')) {
                                if (!selectedSegments.includes(segmentId)) {
                                    selectedSegments.push(segmentId);
                                }
                            } else {
                                const index = selectedSegments.indexOf(segmentId);
                                if (index > -1) {
                                    selectedSegments.splice(index, 1);
                                }
                            }

                            updateSelectedDisplay();
                        });

                        // Prevent checkbox click from bubbling to row
                        $checkbox.on('click', function(e) {
                            e.stopPropagation();
                        });

                        // Handle row click - toggle checkbox when clicking anywhere on the row
                        $segmentItem.on('click', function(e) {
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

                        $segmentsContainer.append($segmentItem);
                    });

                    // Update pagination info
                    currentPage = data.current_page;
                    hasMorePages = data.has_more_pages;
                } else {
                    // Show error message
                    if (reset) {
                        $segmentsContainer.html(`
                            <div class="px-4 py-8 text-center">
                                <p class="text-sm text-red-500">${jsLang('Failed to load segments')}</p>
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

                console.error('Error loading segments:', error);

                // Show error message
                if (reset) {
                    $segmentsContainer.html(`
                        <div class="px-4 py-8 text-center">
                            <p class="text-sm text-red-500">Failed to load segments</p>
                        </div>
                    `);
                }
            },
            complete: function() {
                isLoading = false;
                currentXhr = null;

                // Hide loader
                if ($segmentsLoader.length > 0) {
                    $segmentsLoader.addClass('hidden');
                }
            }
        });
    }

    /**
     * Update the selected segments display
     */
    function updateSelectedDisplay() {
        if ($segmentsHiddenInput.length > 0) {
            $segmentsHiddenInput.val(selectedSegments.join(','));
        }

        if ($segmentsDisplay.length > 0) {
            if (selectedSegments.length === 0) {
                $segmentsDisplay.text(jsLang('Select Segment'));
            } else if (selectedSegments.length === 1) {
                // Find the segment name
                const $selectedItem = $segmentsContainer.find(`[data-id="${selectedSegments[0]}"]`);
                const segmentName = $selectedItem.attr('data-name') || jsLang('Segment');
                $segmentsDisplay.text(segmentName);
            } else {
                $segmentsDisplay.text(`${selectedSegments.length} ${jsLang('segments selected')}`);
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
