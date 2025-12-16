"use strict";
document.addEventListener('DOMContentLoaded', function() {
    if (window.modalUtils && window.modalUtils.init) {
        window.modalUtils.init();
    }

    // Ensure alignment rules are present at startup
    ensureSegmentInputAlignment();

    initSearch();

    // Add input event listeners to clear errors on typing
    initInputErrorClearing();

    const addSegmentForm = document.getElementById('addSegmentForm');
    addSegmentForm?.addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        const loader = submitBtn.querySelector('.loader');

        // Get CSRF token from the form
        const csrfToken = form.querySelector('input[name="_token"]').value;

        // Show loader
        if (loader) {
            loader.classList.remove('hidden');
            submitBtn.disabled = true;
        }

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(async response => {
                // Attempt to parse JSON regardless of status
                let payload = null;
                try { payload = await response.json(); } catch (_) {}

                if (!response.ok) {
                    // Validation error (422)
                    if (response.status === 422 && payload && payload.errors) {
                        displayValidationErrors(payload.errors);
                        // Don't throw error - validation errors are already displayed
                        // Just stop execution here
                        return null;
                    }
                    // Other server error
                    const msg = (payload && (payload.message || payload.error)) || jsLang('Request failed');
                    throw new Error(msg);
                }

                return payload;
            })
            .then(data => {
                // Skip if data is null (validation error case)
                if (!data) {
                    return;
                }

                if (data.success) {
                    // Add new segment to table
                    addSegmentToTable(data.segment);

                    // Reset form
                    form.reset();

                    // Close modal
                    closeCreateModal();

                    // Show success notification
                    toastMixin.fire({
                        title: data.message || jsLang('Segment created successfully'),
                        icon: 'success',
                    });

                } else {
                    // Handle validation errors
                    if (data && data.errors) {
                        displayValidationErrors(data.errors);
                    } else if (data && data.message) {
                        toastMixin.fire({
                            title: data.message,
                            icon: 'error',
                        });
                    }
                }
            })
            .catch(err => {
                if (err) {
                    toastMixin.fire({
                        title: err.error || err.message || jsLang('Failed to create segment'),
                        icon: 'error',
                    });
                }
            })
            .finally(() => {
                if (loader) {
                    loader.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            });
    });

    // Use event delegation for edit and delete buttons
    document.addEventListener('click', function(e) {
        // Handle create modal clicks (clear form values)
        if (e.target.closest('.openModalBtn[data-target="modal1"]')) {
            // Clear the create segment form when opening the modal
            const addSegmentForm = document.getElementById('addSegmentForm');
            if (addSegmentForm) {
                addSegmentForm.reset();
            }
        }

        // Handle edit button clicks
        if (e.target.closest('.openModalBtn[data-target^="editModal-"]')) {
            // Prevent any other click handlers from running first
            e.preventDefault();
            e.stopImmediatePropagation();

            const button = e.target.closest('.openModalBtn');
            const targetModal = button.getAttribute('data-target');
            const segmentId = targetModal.replace('editModal-', '');

            // Create the modal if it doesn't exist yet
            if (!document.getElementById(targetModal)) {
                createEditModal(segmentId);
            }

            // Open on next tick to let DOM update and modalUtils init
            setTimeout(() => {
                openModalWithFallback(targetModal);
            }, 0);
        }
    
        // Handle delete button clicks
        if (e.target.closest('.openModalBtn[data-target^="deleteModal-"]')) {
            const button = e.target.closest('.openModalBtn');
            const targetModal = button.getAttribute('data-target');
            const segmentId = targetModal.replace('deleteModal-', '');
    
            // Check if modal exists, if not create it
            if (!document.getElementById(targetModal)) {
                createDeleteModal(segmentId);
            }
    
            // Open the modal immediately so it works on first click
            openModalWithFallback(targetModal);
        }
    });

    // Handle form submissions using event delegation
    document.addEventListener('submit', function(e) {
        // Edit forms
        if (e.target.id && e.target.id.startsWith('editSegmentForm-')) {
            e.preventDefault();
            handleEditFormSubmit(e.target);
        }

        // Delete forms
        if (e.target.id && e.target.id.startsWith('deleteSegmentForm-')) {
            e.preventDefault();
            handleDeleteFormSubmit(e.target);
        }
    });
});

// Get CSRF token from multiple possible sources
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

// Handle edit form submission
function handleEditFormSubmit(form) {
    const formData = new FormData(form);
    const csrfToken = getCsrfToken();
    const segmentId = form.id.split('-')[1];
    const submitBtn = form.querySelector('button[type="submit"]');
    const loader = submitBtn.querySelector('.loader');
    const buttonText = submitBtn.querySelector('span');

    loader.classList.remove('hidden');
    submitBtn.disabled = true;

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(async response => {
            let payload = {};
            try { payload = await response.json(); } catch (_) {}

            if (!response.ok) {
                // Mirror create flow: show 422 validation errors under input
                if (response.status === 422 && payload && payload.errors) {
                    displayEditValidationErrors(payload.errors, form);
                    // Don't throw error - validation errors are already displayed
                    // Just stop execution here
                    return null;
                }
                const msg = (payload && (payload.message || payload.error)) || jsLang('Request failed');
                throw new Error(msg);
            }

            return payload;
        })
        .then(data => {
            // Skip if data is null (validation error case)
            if (!data) {
                return;
            }

            if (data.success) {
                const row = document.querySelector(`tr[data-segment-id="${segmentId}"]`);
                if (row) {
                    row.querySelector('td:nth-child(2)').textContent = data.segment.name;
                }
                // Close modal
                forceCloseModal(`editModal-${segmentId}`);
                
                // Show success notification
                toastMixin.fire({
                    title: data.message || jsLang('Segment updated successfully'),
                    icon: 'success',
                });
            } else {
                if (data.errors) {
                    displayEditValidationErrors(data.errors, form);
                } else if (data.message) {
                    toastMixin.fire({
                        title: data.message,
                        icon: 'error',
                    });
                }
            }
        })
        .catch(err => {
            if (err) {
                toastMixin.fire({
                    title: err.error || err.message || jsLang('Failed to update segment'),
                    icon: 'error',
                });
                forceCloseModal(`editModal-${segmentId}`);
            }
        })
        .finally(() => {
            loader.classList.add('hidden');
            submitBtn.disabled = false;
        });
}

// Handle delete form submission
function handleDeleteFormSubmit(form) {
    const formData = new FormData(form);
    const csrfToken = getCsrfToken();
    const segmentId = form.id.split('-')[1];
    const submitBtn = form.querySelector('button[type="submit"]');
    const loader = submitBtn.querySelector('.loader');
    const buttonText = submitBtn.querySelector('span');

    // Show loader
    if (loader) {
        loader.classList.remove('hidden');
    }
    submitBtn.disabled = true;

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(async response => {
            if (!response.ok) {
                // Attempt to parse JSON regardless of status to get error message
                let payload = null;
                try { payload = await response.json(); } catch (_) {}

                // Show error message and close modal
                const errorMessage = (payload && (payload.message || payload.error)) || jsLang('Request failed');
                toastMixin.fire({
                    title: errorMessage,
                    icon: 'error',
                });

                // Close the modal
                forceCloseModal(`deleteModal-${segmentId}`);

                // Hide loader and re-enable button
                if (loader) {
                    loader.classList.add('hidden');
                }
                if (submitBtn) {
                    submitBtn.disabled = false;
                }

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
                const row = document.querySelector(`tr[data-segment-id="${segmentId}"]`);
                if (row) {
                    row.remove();
                }

                // Check if table is now empty and show empty state
                const tbody = document.querySelector('table tbody');
                const tableSection = document.querySelector('.table-content');
                const remainingRows = tbody.querySelectorAll('tr[data-segment-id]');
                if (remainingRows.length === 0) {
                    // Hide table and show empty state
                    if (tableSection) {
                        tableSection.classList.add('hidden');
                    }
                    showEmptyState();
                } else {
                    // Renumber remaining rows to maintain synchronized sequence
                    renumberTableRows();
                }

                // Close modal
                forceCloseModal(`deleteModal-${segmentId}`);

                // Show success toast notification
                toastMixin.fire({
                    title: data.message || jsLang('Segment deleted successfully'),
                    icon: 'success',
                });

            } else {
                throw new Error(data.message || jsLang('Failed to delete segment'));
            }
        })
        .catch(err => {
            toastMixin.fire({
                title: err.message || jsLang('Failed to delete segment'),
                icon: 'error',
            });
        })
        .finally(() => {
            // Hide loader and re-enable button
            if (loader) {
                loader.classList.add('hidden');
            }
            submitBtn.disabled = false;
        });
}

// Add a global helper to strongly enforce left alignment in segment inputs
function ensureSegmentInputAlignment() {
    if (document.getElementById('segment-input-align-style')) return;
    const style = document.createElement('style');
    style.id = 'segment-input-align-style';
    style.textContent = `
        /* Create & Edit modals: force left alignment with high specificity */
        #modal1 input[name="segment_name"],
        [id^="editModal-"] input[name="segment_name"],
        input[id^="editSegmentName-"] {
            text-align: left !important;
            direction: ltr !important;
        }
    `;
    document.head.appendChild(style);
}

// Helper: re-apply alignment on a specific edit input
function applyEditInputAlignment(segmentId) {
    const input = document.querySelector(`#editSegmentName-${segmentId}`);
    if (!input) return;
    // Remove any centering classes that might be applied globally
    input.classList.remove('text-center');
    input.style.textAlign = 'left';
    input.style.direction = 'ltr';
    input.setAttribute('dir', 'ltr');
}

// Create edit modal dynamically
function createEditModal(segmentId) {
    const row = document.querySelector(`tr[data-segment-id="${segmentId}"]`);
    if (!row) return;

    const segmentName = row.querySelector('td:nth-child(2)').textContent.trim();
    const csrfToken = getCsrfToken();

    let route = SITE_URL + '/user/marketing-bot/update-segment/' + segmentId;

    const editModalHtml = `
        <div id="editModal-${segmentId}" 
            class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4">
            <div class="modalBox max-w-[600px] bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0">
                <form id="editSegmentForm-${segmentId}" class="px-7" action="${route}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PUT">
                    <h5 class="text-lg text-color-14 dark:text-white text-left font-medium mb-0.5">
                        ${jsLang('Edit Segment')}
                    </h5>
                    <p class="text-xs text-color-89 text-left font-medium mb-5">${jsLang('Update your segment information.')}</p>
                    <div class="relative z-5 w-full">
                        <input
                            id="editSegmentName-${segmentId}" type="text" name="segment_name" value="${segmentName}" required
                            class="form-control text-left align-left max-h-[200px] min-w-[320px] p-3 dark:bg-color-33 dark:border-color-47 text-sm font-normal focus:outline-none active:outline-none hover:border-gray-1 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 dark:text-white w-full bg-color-F6 rounded-xl border border-color-DF text-color-89 mb-2"
                            style="text-align: left !important; direction: ltr !important; text-align-last: left !important;"
                            dir="ltr"
                        >
                        <div id="edit_segment_name_error" class="text-red-500 text-xs mb-3 hidden"></div>
                    </div>
                    <div class="flex gap-4">
                        <button type="button" class="closeModalBtn flex items-center justify-center w-full rounded-[6px] text-[15px] text-center bg-color-14 hover:shadow-lg text-white px-5 py-2 font-medium hover:opacity-90 transition-all duration-200">
                            ${jsLang('Cancel')}
                        </button>
                        <button type="submit" class="flex items-center justify-center w-full rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2 font-medium hover:opacity-90 transition-all duration-200">
                            <span>${jsLang('Update')}</span>
                            <svg class="loader animate-spin h-5 w-5 ml-2 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', editModalHtml);

    // Force alignment after modal is added to DOM
    setTimeout(() => {
        const input = document.querySelector(`#editModal-${segmentId} input[name="segment_name"]`);
        if (input) {
            // Apply multiple inline style properties to ensure left alignment
            input.style.textAlign = 'left';
            input.style.direction = 'ltr';
            input.style.textAlignLast = 'left';
            input.setAttribute('dir', 'ltr');
        }
    }, 50);

    // Reinitialize modalUtils for the new modal
    if (window.modalUtils && window.modalUtils.init) {
        window.modalUtils.init();
    }
}

function createDeleteModal(segmentId) {
    const csrfToken = getCsrfToken();

    const deleteModalHtml = `
        <div id="deleteModal-${segmentId}" class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4">
            <div class="modalBox max-w-[600px] min-w-[300px] bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0">
                <form id="deleteSegmentForm-${segmentId}" class="px-7" action="${SITE_URL}/user/marketing-bot/segments/${segmentId}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="DELETE">
                    <h5 class="max-w-[300px] text-xl text-color-14 dark:text-white text-center font-medium mb-0.5">
                        ${jsLang('Are you sure you want to delete this item?')}
                    </h5>
                    <div class="flex justify-center gap-3 mt-6">
                        <button type="submit" class="deleteSegmentBtn w-full flex items-center justify-center rounded-[6px] text-sm text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200">
                            <span>${jsLang('Delete')}</span>
                            <svg class="loader animate-spin h-5 w-5 ml-2 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                        <button type="button" class="closeModalBtn w-full flex items-center justify-center rounded-[6px] text-sm text-center bg-color-14 hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200">
                            <span>${jsLang('Cancel')}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', deleteModalHtml);

    // Reinitialize modalUtils for the new modal
    if (window.modalUtils && window.modalUtils.init) {
        window.modalUtils.init();
    }
}

    // Special function to close the create modal
    function closeCreateModal() {

        // Method 1: Try modalUtils first
        if (window.modalUtils && window.modalUtils.closeModal) {
            try {
                window.modalUtils.closeModal('modal1');
                return;
            } catch (error) {
            }
        }

        // Method 2: Find the modal and click its close button
        const modal = document.getElementById('modal1');
        if (modal) {
            // Find and click all close buttons inside the modal
            const closeButtons = modal.querySelectorAll('.closeModalBtn');
            if (closeButtons.length > 0) {
                closeButtons.forEach(btn => {
                    btn.click();
                });
                return;
            }

            // Method 3: Direct removal with animation
            modal.style.opacity = '0';
            modal.style.visibility = 'hidden';

            setTimeout(() => {
                modal.remove();
            }, 300);
        } else {
        }

        // Method 4: Reset body styles
        document.body.style.overflow = '';
        document.body.classList.remove('modal-open');
    }

    // Force close modal using multiple reliable methods
    function forceCloseModal(modalId) {

        const modal = document.getElementById(modalId);
        if (!modal) {
            return;
        }

        // Method 1: Try the modalUtils library first
        if (window.modalUtils && window.modalUtils.closeModal) {
            try {
                window.modalUtils.closeModal(modalId);
                return;
            } catch (error) {
            }
        }

        // Method 2: Find and click the close button inside the modal
        const closeButtons = modal.querySelectorAll('.closeModalBtn');
        if (closeButtons.length > 0) {
            closeButtons.forEach(btn => {
                btn.click();
            });
            return;
        }

        // Method 3: Direct DOM manipulation - hide and remove
        setTimeout(() => {
            // Hide with CSS
            modal.style.display = 'none';
            modal.style.visibility = 'hidden';
            modal.style.opacity = '0';

            // Add hidden class
            modal.classList.add('hidden');

            // Remove from DOM after animation
            setTimeout(() => {
                if (modal.parentNode) {
                    modal.remove();
                }
            }, 300);
        }, 100);

        // Method 4: Reset body styles
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        document.body.classList.remove('modal-open', 'sweet-modal-open');

        // Method 5: Remove backdrop if exists
        const backdrops = document.querySelectorAll('.modal-backdrop, .sweet-modal-backdrop');
        backdrops.forEach(backdrop => {
            backdrop.remove();
        });

    }

    function addSegmentToTable(segment) {
        const tbody = document.querySelector('table tbody');
        const tableSection = document.querySelector('.table-content');
        
        // Show the table if it's hidden
        if (tableSection && tableSection.classList.contains('hidden')) {
            tableSection.classList.remove('hidden');
        }
        
        // Remove empty state row if it exists
        const emptyStateRow = document.getElementById('segments-empty-state-row');
        if (emptyStateRow) {
            emptyStateRow.remove();
        }
        
        // Calculate the correct row number based on existing rows
        const existingRows = tbody.querySelectorAll('tr[data-segment-id]');
        const rowNumber = existingRows.length + 1;
        
        const newRow = `
            <tr data-segment-id="${segment.id}" class="border-t border-color-89/10 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-purple-50/50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20">
                <td class="px-6 py-3 text-color-89 font-semibold whitespace-nowrap">#${rowNumber}</td>
                <td class="px-6 py-3 whitespace-nowrap text-color-14 dark:text-white">${segment.name}</td>
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
        tbody.insertAdjacentHTML('afterbegin', newRow);

        toastMixin.fire({
            title: jsLang('Segment created successfully'),
            icon: 'success',
        });
        
        // Renumber all rows to maintain synchronized sequence
        renumberTableRows();
    }

    function renumberTableRows() {
        const tbody = document.querySelector('table tbody');
        if (!tbody) return;

        // Get all segment rows (exclude empty state row)
        const rows = tbody.querySelectorAll('tr[data-segment-id]');
        
        // Renumber each row starting from 1
        rows.forEach((row, index) => {
            const firstTd = row.querySelector('td:first-child');
            if (firstTd) {
                firstTd.textContent = `#${index + 1}`;
            }
        });
    }

    function showEmptyState() {
        const tbody = document.querySelector('table tbody');
        if (!tbody) return;

        // Check if empty state already exists
        if (document.getElementById('segments-empty-state-row')) {
            return;
        }

        // Get translated text from data attributes on tbody or use defaults
        const noDataText = tbody.dataset.noDataText || jsLang('No data found');
        const descriptionText = tbody.dataset.descriptionText || jsLang('Looks like you did not create any data yet.');

        const emptyStateRow = `
            <tr id="segments-empty-state-row">
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
                    <p class="text-color-14 dark:text-white text-center font-medium font-Figtree text-20 mt-6">${noDataText}</p>
                    <p class="text-center font-medium text-color-89 text-15 px-5 py-3 font-Figtree mt-3 md:w-[450px] mx-auto">${descriptionText}</p>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', emptyStateRow);
    }


    function displayValidationErrors(errors) {
        // Display validation errors using toast
        Object.keys(errors).forEach(field => {
            toastMixin.fire({
                title: errors[field][0],
                icon: 'error',
            });
        });
    }


    // Display edit validation errors
    function displayEditValidationErrors(errors, form) {
        // Display validation errors using toast
        Object.keys(errors).forEach(field => {
            toastMixin.fire({
                title: errors[field][0],
                icon: 'error',
            });
        });
    }

    // Initialize input error clearing functionality
    function initInputErrorClearing() {
        // Use event delegation for dynamically created inputs
        document.addEventListener('input', function(e) {
            if (e.target.name === 'segment_name') {
                const errorElement = e.target.parentElement.querySelector('[id$="_error"]');
                if (errorElement && !errorElement.classList.contains('hidden')) {
                    // Clear the error message
                    errorElement.classList.add('hidden');
                    errorElement.textContent = '';
                    // Remove error styling from input
                    e.target.classList.remove('border-red-500', 'dark:border-red-500');
                    e.target.classList.add('border-color-DF', 'dark:border-color-47');
                }
            }
        });
    }


    $(document).on('click', '.openModalBtn', function() {
        $('.delete-group').attr('data-id', $(this).data('id'));
    });

    $(document).on('click', '.delete-group', function () {
        let id = $(this).attr("data-id");
        $(".loader").removeClass('hidden');
        $(this).attr('disabled');

        doAjaxprocess(
            SITE_URL + "/user/marketing-bot/group/delete",
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
            $('#group-row-'+id).remove();

            var $materialsBody = $('.group-table');
            if ($materialsBody.find('[id^="group-row-"]').length === 0) {
                $materialsBody.html(groupEmptyHtml());
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

    function searchGroups(e) {
        const value = $(e).val().trim().toLowerCase();
        const url = SITE_URL + "/user/marketing-bot/groups?search=" + value;

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            $.ajax({
                url: url,
                type: 'GET',
                data: {},
                dataType: 'json',
                beforeSend: function() {
                    // Show skeleton loader
                    if (window.groupsSkeleton && typeof window.groupsSkeleton.show === 'function') {
                        window.groupsSkeleton.show();
                    } else {
                        // Fallback if skeleton functions not available
                        $('.table-skeleton').removeClass('hidden');
                        $('.table-content').addClass('hidden');
                    }
                },
                success: function (response) {
                    if (response && response.items && String(response.items).trim().length) {
                        // Replace only the table-content element, not the skeleton
                        $('.group-table.table-content').replaceWith(response.items);
                    } else {
                        // Replace only the table-content element with empty state (wrap in proper div)
                        const emptyHtml = `<div class="group-table table-content">${groupEmptyHtml()}</div>`;
                        $('.group-table.table-content').replaceWith(emptyHtml);
                    }

                    // Hide skeleton loader after content is loaded
                    if (window.groupsSkeleton && typeof window.groupsSkeleton.hide === 'function') {
                        window.groupsSkeleton.hide();
                    } else {
                        // Fallback if skeleton functions not available
                        $('.table-skeleton').addClass('hidden');
                        $('.table-content').removeClass('hidden');
                    }
                },
                error: function(xhr, status, error) {
                    // Hide skeleton loader on error
                    if (window.groupsSkeleton && typeof window.groupsSkeleton.hide === 'function') {
                        window.groupsSkeleton.hide();
                    } else {
                        // Fallback if skeleton functions not available
                        $('.table-skeleton').addClass('hidden');
                        $('.table-content').removeClass('hidden');
                    }

                    toastMixin.fire({
                        title: xhr.responseJSON?.error || xhr.responseJSON?.message,
                        icon: 'error',
                    });
                }
            });
        }, 1000);
    }

    function groupEmptyHtml() {
        return `
        <section class="rounded-xl bg-white dark:bg-color-3A border border-color-89/10 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-light-icon dark:bg-dark-icon text-color-14 dark:text-white">
                        <tr>
                            <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">${jsLang('ID')}</th>
                            <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">${jsLang('Name')}</th>
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
                                <p class="text-color-14 dark:text-white text-center font-medium font-Figtree text-20 mt-6">${jsLang('No data found')}</p>
                                <p class="text-center font-medium text-color-89 text-15 px-5 py-3 font-Figtree mt-3 md:w-[450px] mx-auto">${jsLang('Looks like you did not train any data yet.')}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        `;
    }

    // Helper: Open modal by ID, using modalUtils if available, otherwise fallback
    function openModalWithFallback(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
    
        // Prefer the modal library if present
        if (window.modalUtils && typeof window.modalUtils.openModal === 'function') {
            try {
                window.modalUtils.openModal(modalId);
                return;
            } catch (_) {
                // Fall through to manual open
            }
        }
    
        // Manual open fallback
        modal.classList.remove('hidden');
        modal.style.opacity = '1';
        modal.style.visibility = 'visible';
    
        const box = modal.querySelector('.modalBox');
        if (box) {
            box.classList.remove('scale-0', 'opacity-0');
            box.style.transform = 'scale(1)';
            box.style.opacity = '1';
        }
    
        document.body.classList.add('modal-open', 'sweet-modal-open');
        document.body.style.overflow = 'hidden';
    }
// Add this function to ensure alignment when modals are opened
function ensureModalInputAlignment() {
    // Apply to all existing segment name inputs
    document.querySelectorAll('input[name="segment_name"]').forEach(input => {
        input.style.textAlign = 'left';
        input.style.direction = 'ltr';
        input.setAttribute('dir', 'ltr');
    });
}

// Call this function whenever a modal might open
document.addEventListener('click', function(e) {
    if (e.target.closest('.openModalBtn')) {
        setTimeout(ensureModalInputAlignment, 100);
    }
});

// Force text alignment for edit modal inputs
function forceEditInputAlignment() {
    // Apply to all edit modal inputs
    document.querySelectorAll('[id^="editModal-"] input[name="segment_name"]').forEach(input => {
        // Remove any centering classes
        input.classList.remove('text-center');
        
        // Apply inline styles
        input.style.textAlign = 'left';
        input.style.direction = 'ltr';
        input.style.textAlignLast = 'left';
        
        // Set attributes
        input.setAttribute('dir', 'ltr');
        input.setAttribute('style', 
            input.getAttribute('style') + 
            ' text-align: left !important; ' +
            ' direction: ltr !important; ' +
            ' text-align-last: left !important;'
        );
    });
}

// Call this when modals open
document.addEventListener('click', function(e) {
    if (e.target.closest('.openModalBtn[data-target^="editModal-"]')) {
        setTimeout(forceEditInputAlignment, 200);
    }
});