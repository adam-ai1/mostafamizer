"use strict";

/**
 * Template Search with AJAX, Debounce, and Request Cancellation
 * Handles template search, infinite scroll, and selection highlighting
 */
$(document).ready(function() {
    let $searchInput, $container, $loader, $dropdown, $templateInput;
    let searchTimeout;
    let isLoading = false;
    let currentSearch = '';
    let currentXhr = null;
    let baseUrl = '';

    /**
     * Initialize template search functionality
     */
    function init() {
        $searchInput = $('#template-search-input');
        $container = $('#template-list-container');
        $loader = $('#template-search-loader');
        $templateInput = $('#template');
        
        if ($searchInput.length === 0 || $container.length === 0) return;

        $dropdown = $container.closest('.voice-dropdown-content');
        if ($dropdown.length === 0) return;

        // Get base URL from data attribute or use default
        baseUrl = $container.attr('data-base-url') || 
                  (window.templateSearchConfig && window.templateSearchConfig.baseUrl) || 
                  '';

        if (!baseUrl) {
            console.warn('Template search base URL not found');
            return;
        }

        setupEventListeners();
        setupSelectionHighlight();
    }

    /**
     * Setup event listeners for search, scroll, and dropdown interactions
     */
    function setupEventListeners() {
        // Prevent dropdown from closing when clicking inside it
        $dropdown.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent dropdown from closing when clicking on search input
        $searchInput.on('click', function(e) {
            e.stopPropagation();
        });

        // Prevent dropdown from closing when clicking on template list container
        $container.on('click', function(e) {
            e.stopPropagation();
        });

        // Debounced search handler with request cancellation
        $searchInput.on('input', function(e) {
            clearTimeout(searchTimeout);
            
            // Abort previous request if still pending
            if (currentXhr && currentXhr.readyState !== 4) {
                currentXhr.abort();
                currentXhr = null;
            }

            const searchTerm = $(this).val().trim();
            currentSearch = searchTerm;
            
            // Show loader immediately when user types (if there's a search term)
            if ($loader.length > 0) {
                if (searchTerm) {
                    $loader.removeClass('hidden');
                } else {
                    $loader.addClass('hidden');
                }
            }
            
            // Debounce search request
            searchTimeout = setTimeout(function() {
                loadTemplates(searchTerm, true);
            }, 300);
        });

        // Infinite scroll handler
        $container.on('scroll', function() {
            if (isLoading) return;
            
            const $this = $(this);
            const scrollTop = $this.scrollTop();
            const scrollHeight = $this[0].scrollHeight;
            const clientHeight = $this.height();
            const nextUrl = $this.attr('data-next');

            // Load more when scrolled to 80% of the container
            if (scrollTop + clientHeight >= scrollHeight * 0.8 && nextUrl) {
                loadTemplates(currentSearch, false);
            }
        });

        // Update selection when dropdown opens
        const $dropdownButton = $dropdown.closest('.relative').find('.voice-type-dropdown');
        if ($dropdownButton.length > 0) {
            $dropdownButton.on('click', function() {
                setTimeout(updateSelectedTemplate, 100);
            });
        }
    }

    /**
     * Setup template selection highlighting
     */
    function setupSelectionHighlight() {
        // Watch for template selection changes using jQuery
        if ($templateInput.length > 0) {
            // Use jQuery to watch for value changes
            $templateInput.on('change', function() {
                updateSelectedTemplate();
            });
        }

        // Override selectTemplate to update highlight and close dropdown
        const originalSelectTemplate = window.selectTemplate;
        window.selectTemplate = function(e) {
            if (originalSelectTemplate) {
                originalSelectTemplate(e);
            }
            // Update highlight after selection
            setTimeout(updateSelectedTemplate, 50);
            
            // Close dropdown after selection
            if ($dropdown.length > 0) {
                $dropdown.slideUp(200);
            }
        };
    }

    /**
     * Update selected template highlight in the dropdown
     */
    function updateSelectedTemplate() {
        if ($container.length === 0 || $templateInput.length === 0) return;
        
        const selectedTemplateId = $templateInput.val();
        if (selectedTemplateId) {
            $container.find('[data-val]').each(function() {
                const $item = $(this);
                if ($item.attr('data-val') === selectedTemplateId) {
                    $item.addClass('bg-color-F6 dark:bg-color-3A font-medium');
                } else {
                    $item.removeClass('bg-color-F6 dark:bg-color-3A font-medium');
                }
            });
        }
    }

    /**
     * Load templates via AJAX with request cancellation
     * @param {string} searchTerm - Search term to filter templates
     * @param {boolean} reset - Whether to reset the list or append
     */
    function loadTemplates(searchTerm, reset = false) {
        if (isLoading) return;
        
        // Abort previous request if still pending
        if (currentXhr && currentXhr.readyState !== 4) {
            currentXhr.abort();
            currentXhr = null;
        }
        
        isLoading = true;
        
        let url;
        
        if (reset) {
            // Reset: build new URL with search
            url = baseUrl + '?only=templates';
            if (searchTerm) {
                url += '&search=' + encodeURIComponent(searchTerm);
            }
        } else {
            // Load next page: use next URL (Laravel pagination preserves query params)
            const nextUrl = $container.attr('data-next');
            if (nextUrl) {
                url = nextUrl;
            } else {
                isLoading = false;
                currentXhr = null;
                return;
            }
        }

        currentXhr = $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            beforeSend: function(xhr) {
                // Store xhr reference for potential cancellation
                currentXhr = xhr;
            },
            success: function(data) {
                // Check if request was aborted (jQuery sets statusText to 'abort')
                if (currentXhr && currentXhr.statusText === 'abort') {
                    return;
                }

                if (reset) {
                    $container.html(data.items);
                } else {
                    // Only append if there are actual items (not empty state message)
                    const $tempDiv = $('<div>').html(data.items);
                    const hasItems = $tempDiv.find('[data-val]').length > 0;
                    
                    if (hasItems) {
                        $container.append(data.items);
                    }
                }
                
                $container.attr('data-next', data.next || '');
                
                // Update selected template highlight after loading
                updateSelectedTemplate();
            },
            error: function(xhr, status, error) {
                // Ignore abort errors (they're expected)
                if (status === 'abort') {
                    return;
                }
                
                console.error('Error loading templates:', error);
            },
            complete: function() {
                isLoading = false;
                currentXhr = null;
                
                // Hide loader
                if ($loader.length > 0) {
                    $loader.addClass('hidden');
                }
            }
        });
    }

    // Initialize
    init();
});

