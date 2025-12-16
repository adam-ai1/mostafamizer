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

    // Try the hidden input at the top of the page
    const pageToken = document.querySelector('input[name="_token"][type="hidden"]');
    if (pageToken && pageToken.value) {
        return pageToken.value;
    }

    return '';
}

let segmentsDebounceTimer;

function searchSegments(element) {
    const searchValue = element ? element.value.trim() : '';

    // Clear previous timeout
    clearTimeout(segmentsDebounceTimer);

    // Set new timeout for debouncing
    segmentsDebounceTimer = setTimeout(() => {
        performSearch(searchValue);
    }, 800);
}

function initSearch() {
    const searchInput = document.getElementById('searchInput');

    if (!searchInput) {
        return;
    }

    let searchTimeout;
    let currentAbortController = null;

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.trim();

        // Clear previous timeout
        clearTimeout(searchTimeout);

        // Abort any pending request
        if (currentAbortController) {
            currentAbortController.abort();
        }

        // Only trigger search if search term is at least 2 characters or empty (to clear search)
        if (searchTerm.length >= 2 || searchTerm.length === 0) {
            currentAbortController = new AbortController();
            // Set new timeout to delay the search
            searchTimeout = setTimeout(() => {
                performSearch(searchTerm);
            }, 800);
        }
    });

    // Handle Enter key for immediate search
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(searchTimeout);
            // Abort any pending request
            if (currentAbortController) {
                currentAbortController.abort();
            }

            // Create new controller for this search
            currentAbortController = new AbortController();

            const searchTerm = e.target.value.trim();
            // Only trigger search if search term is at least 2 characters or empty (to clear search)
            if (searchTerm.length >= 2 || searchTerm.length === 0) {
                performSearch(searchTerm);
            }
        }
    });
}

function performSearch(searchTerm = '', page = 1) {
    const searchInput = document.getElementById('searchInput');

    if (!searchInput) {
        return;
    }

    // Create AbortController if not provided
    currentAbortController = new AbortController();

    // Build the search URL with query parameters
    const searchUrl = window.location.href.split('?')[0];
    const params = new URLSearchParams();
    
    // Always include search parameter, even if empty
    params.append('search', searchTerm);
    
    if (page > 1) {
        params.append('page', page);
    }

    const url = `${searchUrl}?${params.toString()}`;
    const paginationContainer = document.querySelector('.pagination');
    const container = document.getElementById('segments-table-container');

    // Show skeleton loader
    showLoadingState(true);

    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        signal: currentAbortController.signal
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Hide skeleton and show content
        showLoadingState(false);

        if (data && data.items) {
            // Replace container content with new data
            if (container) {
                // Create a temporary div to parse the HTML response
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.items;
                
                // Extract only the segments-table div from the response
                const segmentsTable = tempDiv.querySelector('.segments-table');
                
                if (segmentsTable) {
                    // Replace container content with only the table
                    container.innerHTML = '';
                    container.appendChild(segmentsTable);
                    
                    // Show the table - empty state is already in the HTML from the server
                    segmentsTable.classList.remove('hidden');
                } else {
                    // If table not found in response, show error
                    container.innerHTML = '<div class="text-center py-8 text-red-500">Failed to load segments table.</div>';
                }
            } else {
                // Fallback: Replace the table section directly
                const tableSection = document.querySelector('section.rounded-xl.bg-white, section.rounded-xl.bg-color-3A');
                if (tableSection) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.items;
                    const newTableSection = tempDiv.querySelector('section.rounded-xl');
                    
                    if (newTableSection) {
                        tableSection.outerHTML = newTableSection.outerHTML;
                    }
                    
                    // Also update pagination if it exists in the response
                    const newPagination = tempDiv.querySelector('.pagination');
                    if (newPagination && paginationContainer) {
                        paginationContainer.innerHTML = newPagination.innerHTML;
                    }
                }
            }
            
            // Reinitialize modal utils for the new content
            if (window.modalUtils && window.modalUtils.init) {
                window.modalUtils.init();
            }
            
            // Re-apply alignment after dynamic DOM replacement
            if (window.ensureSegmentInputAlignment) {
                window.ensureSegmentInputAlignment();
            }
            
        } else {
            throw new Error('Invalid response format from server');
        }
    })
    .catch(error => {
        // Don't show error for aborted requests (normal when user types quickly)
        if (error.name === 'AbortError') {
            return;
        }

        // Hide skeleton on error
        showLoadingState(false);

        // Show error in container
        if (container) {
            container.innerHTML = '<div class="text-center py-8 text-red-500">Failed to load segments. Please try again.</div>';
        }

        if (typeof toastMixin !== 'undefined' && toastMixin.fire) {
            toastMixin.fire({
                title: error.message,
                icon: 'error',
            });
        }
    })
    .finally(() => {
        // Clear the controller reference after request completes
        if (currentAbortController) {
            currentAbortController = null;
        }
    });
}

function showLoadingState(show) {
    const tableSkeleton = document.getElementById('segments-table-skeleton');
    const tableContent = document.querySelector('.segments-table');

    if (show) {
        // Show skeleton and hide content
        if (tableSkeleton) {
            tableSkeleton.classList.remove('hidden');
        }
        if (tableContent) {
            tableContent.classList.add('hidden');
        }
    } else {
        // Hide skeleton and show content
        if (tableSkeleton) {
            tableSkeleton.classList.add('hidden');
        }
        if (tableContent) {
            tableContent.classList.remove('hidden');
        }
    }
}

function updateTable(segments) {
    const tableBody = document.querySelector('table tbody');

    if (!tableBody) {
        return;
    }

    if (segments.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="3" class="px-6 py-8 text-center text-color-89">
                    No segments found matching your search criteria.
                </td>
            </tr>
        `;
        return;
    }

    let html = '';
    segments.forEach(segment => {
        html += `
            <tr data-segment-id="${segment.id}" class="border-t border-color-89/10 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-purple-50/50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20">
                <td class="px-6 py-3 text-color-89 font-semibold whitespace-nowrap">
                    ${segment.id}
                </td>
                <td class="px-6 py-3 whitespace-nowrap text-color-14 dark:text-white">
                    ${escapeHtml(segment.name)}
                </td>
                <td class="px-6 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <!-- Edit Button -->
                        <button
                            data-target="editModal-${segment.id}"
                            class="openModalBtn p-2 h-8 w-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center hover:from-blue-600 hover:to-blue-700 shadow-sm hover:shadow-blue-200 dark:hover:shadow-blue-900/50 transform hover:scale-105 transition duration-200 ease-in-out"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.651 1.651a2.121 2.121 0 010 3.001l-9.193 9.193a2.121 2.121 0 01-1.061.577l-3.388.678a.75.75 0 01-.887-.887l.678-3.388a2.121 2.121 0 01.577-1.061l9.193-9.193a2.121 2.121 0 013.001 0z" />
                            </svg>
                        </button>

                        <!-- Delete Button -->
                        <button
                            data-target="deleteModal-${segment.id}"
                            class="openModalBtn p-2 h-8 w-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center hover:from-red-600 hover:to-red-700 shadow-sm hover:shadow-red-200 dark:hover:shadow-red-900/50 transform hover:scale-105 transition duration-200 ease-in-out"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    });

    tableBody.innerHTML = html;

    if (window.modalUtils && window.modalUtils.init) {
        window.modalUtils.init();
    }
}

function updateTableWithSearchResults(segments) {
    if (!segments || !segments.data) {
        return;
    }
    
    updateTable(segments.data);
}

function updatePagination(paginatedData) {
    const paginationContainer = document.querySelector('.pagination');

    if (!paginatedData || !paginationContainer) return;

    if (paginatedData.data.length === 0) {
        paginationContainer.innerHTML = '';
        return;
    }

    let paginationHtml = '';

    // Previous page link
    if (paginatedData.prev_page_url) {
        const prevPage = paginatedData.current_page - 1;
        paginationHtml += `<a href="#" data-page="${prevPage}" class="pagination-link">Previous</a>`;
    }

    // Page numbers
    for (let i = 1; i <= paginatedData.last_page; i++) {
        if (i === paginatedData.current_page) {
            paginationHtml += `<span class="active">${i}</span>`;
        } else {
            paginationHtml += `<a href="#" data-page="${i}" class="pagination-link">${i}</a>`;
        }
    }

    // Next page link
    if (paginatedData.next_page_url) {
        const nextPage = paginatedData.current_page + 1;
        paginationHtml += `<a href="#" data-page="${nextPage}" class="pagination-link">Next</a>`;
    }

    paginationContainer.innerHTML = paginationHtml;

    // Add click event listeners to pagination links
    const paginationLinks = paginationContainer.querySelectorAll('.pagination-link');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const page = this.getAttribute('data-page');
            const searchTerm = document.getElementById('searchInput').value.trim();
            // Create new AbortController for pagination requests
            performSearch(searchTerm, page);
        });
    });
}

function getCurrentPage() {
    const activePage = document.querySelector('.pagination .active');
    if (activePage) {
        return parseInt(activePage.textContent, 10) || 1;
    }
    return 1;
}

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

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's a search parameter in URL and apply it
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    const searchInput = document.getElementById('searchInput');
    
    if (searchInput && searchParam) {
        searchInput.value = searchParam;
        // Trigger search with the URL parameter
        performSearch(searchParam);
    }
    
    // Also initialize the search if using event listeners instead of onkeyup
    initSearch();
});