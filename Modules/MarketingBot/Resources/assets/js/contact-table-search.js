let contactsDebounceTimer;

function searchContacts(element) {
    const searchValue = element ? element.value.trim() : '';

    // Clear previous timeout
    clearTimeout(contactsDebounceTimer);

    // Set new timeout for debouncing
    contactsDebounceTimer = setTimeout(() => {
        performContactsSearch(searchValue);
    }, 800);
}

function performContactsSearch(searchValue) {
    // Check if contactRoute is defined
    if (typeof contactRoute === 'undefined') {
        console.error('contactRoute is not defined');
        return;
    }

    // Show skeleton loader
    const container = document.getElementById('contacts-table-container');
    if (!container) {
        return;
    }

    // Show skeleton and hide content
    const tableSkeleton = document.getElementById('contacts-table-skeleton');
    const tableContent = container.querySelector('.contacts-table');
    
    if (tableSkeleton) {
        tableSkeleton.classList.remove('hidden');
    }
    if (tableContent) {
        tableContent.classList.add('hidden');
    }

    // Build URL with search parameter
    let url = contactRoute;
    if (searchValue) {
        // Check if URL already has query parameters
        const separator = url.includes('?') ? '&' : '?';
        url += `${separator}search=${encodeURIComponent(searchValue)}`;
    }

    // Make the request
    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            // Hide skeleton
            if (tableSkeleton) {
                tableSkeleton.classList.add('hidden');
            }

            if (container && data && data.items) {
                // Create a temporary div to parse the HTML response
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.items;
                
                // Extract only the contacts-table div from the response
                const contactsTable = tempDiv.querySelector('.contacts-table');
                
                if (contactsTable) {
                    // Replace container content with only the table
                    container.innerHTML = '';
                    container.appendChild(contactsTable);
                    
                    // Always show the table - it contains either data or empty state
                    contactsTable.classList.remove('hidden');
                } else {
                    // If table not found in response, show error
                    container.innerHTML = '<div class="text-center py-8 text-red-500">Failed to load contacts table.</div>';
                }
                
                // Re-initialize any event handlers that might need it
                initializeContactHandlers();
            } else {
                // If no items returned, show error or empty state
                if (tableSkeleton) {
                    tableSkeleton.classList.add('hidden');
                }
                if (tableContent) {
                    tableContent.classList.remove('hidden');
                }
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            // Hide skeleton on error
            if (tableSkeleton) {
                tableSkeleton.classList.add('hidden');
            }
            // Show original content on error
            if (tableContent) {
                tableContent.classList.remove('hidden');
            } else if (container) {
                container.innerHTML = '<div class="text-center py-8 text-red-500">Failed to load contacts. Please try again.</div>';
            }
        });
}

// Helper function to reload the contacts table
function reloadContactsTable() {
    const searchInput = document.getElementById('searchContacts');
    if (searchInput) {
        searchContacts(searchInput);
    } else {
        // If search input doesn't exist, reload without search
        searchContacts(null);
    }
}

// Initialize event handlers after table is loaded dynamically
function initializeContactHandlers() {
    // Delete modal opening handlers are already set up with document.on()
    // so they should work automatically with dynamically loaded content
    // But we can add any additional initialization here if needed
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's a search parameter in URL and apply it
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    const searchInput = document.getElementById('searchContacts');
    
    if (searchInput && searchParam) {
        searchInput.value = searchParam;
        // Trigger search with the URL parameter
        performContactsSearch(searchParam);
    }
});

