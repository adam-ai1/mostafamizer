// Debounce timer variable
let searchCampaignsTimeout = null;

function searchCampaigns(element) {
    const searchValue = element.value;

    // Clear previous timeout
    if (searchCampaignsTimeout) {
        clearTimeout(searchCampaignsTimeout);
    }

    // Set new timeout for debounce (500ms)
    searchCampaignsTimeout = setTimeout(() => {
        const container = document.getElementById('campaigns-table-container');
        if (!container) return;

        // Show skeleton loader
        const tableSkeletonElements = container.querySelectorAll('.table-skeleton');
        const tableContentElements = container.querySelectorAll('.table-content');
        tableSkeletonElements.forEach(e => e.classList.remove('hidden'));
        tableContentElements.forEach(e => e.classList.add('hidden'));

        // Make the request
        fetch(`${campaignRoute}?search=${encodeURIComponent(searchValue)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) throw new Error(jsLang('Network error'));
                return response.json();
            })
            .then(data => {
                if (container && data.items) {
                    container.innerHTML = data.items;
                    // Response already has skeleton hidden and content visible (is_ajax = true)
                    // Ensure skeleton is hidden and content is visible
                    const newSkeletonElements = container.querySelectorAll('.table-skeleton');
                    const newContentElements = container.querySelectorAll('.table-content');
                    newSkeletonElements.forEach(e => e.classList.add('hidden'));
                    newContentElements.forEach(e => e.classList.remove('hidden'));
                }
            })
            .catch(error => {
                // On error, hide skeleton and show error message
                const tableSkeletonElements = container.querySelectorAll('.table-skeleton');
                const tableContentElements = container.querySelectorAll('.table-content');
                tableSkeletonElements.forEach(e => e.classList.add('hidden'));
                tableContentElements.forEach(e => {
                    e.classList.remove('hidden');
                    e.innerHTML = `<div class="text-center py-8 text-red-500">${jsLang('Search failed')}</div>`;
                });
            });
    }, 500);
}

// Filter function
function filterCampaignsByType(element, type) {
    const value = element.getAttribute('data-value');

    // Update UI
    if (type === 'status') {
        document.querySelector('.filter-status').textContent = element.textContent;
        document.querySelector('.filter-status').setAttribute('data-value', value);
    } else if (type === 'training') {
        document.querySelector('.filter-training').textContent = element.textContent;
        document.querySelector('.filter-training').setAttribute('data-value', value);
    }

    // Get search value
    const searchValue = document.getElementById('campaign-search').value || '';

    // Build URL
    let url = `${campaignRoute}?`;
    if (searchValue) url += `search=${encodeURIComponent(searchValue)}&`;
    if (value !== 'all') url += `${type}=${value}&`;

    // Remove trailing &
    url = url.replace(/&$/, '');

    // Show skeleton loader
    const container = document.getElementById('campaigns-table-container');
    if (!container) return;

    const tableSkeletonElements = container.querySelectorAll('.table-skeleton');
    const tableContentElements = container.querySelectorAll('.table-content');
    tableSkeletonElements.forEach(e => e.classList.remove('hidden'));
    tableContentElements.forEach(e => e.classList.add('hidden'));

    // Make request
    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => {
            if (!response.ok) throw new Error(jsLang('Network error'));
            return response.json();
        })
        .then(data => {
            if (container && data.items) {
                container.innerHTML = data.items;
                // Response already has skeleton hidden and content visible (is_ajax = true)
                // Ensure skeleton is hidden and content is visible
                const newSkeletonElements = container.querySelectorAll('.table-skeleton');
                const newContentElements = container.querySelectorAll('.table-content');
                newSkeletonElements.forEach(e => e.classList.add('hidden'));
                newContentElements.forEach(e => e.classList.remove('hidden'));
            }
        })
        .catch(error => {
            // On error, hide skeleton and show error message
            const tableSkeletonElements = container.querySelectorAll('.table-skeleton');
            const tableContentElements = container.querySelectorAll('.table-content');
            tableSkeletonElements.forEach(e => e.classList.add('hidden'));
            tableContentElements.forEach(e => {
                e.classList.remove('hidden');
                e.innerHTML = `<div class="text-center py-8 text-red-500">${jsLang('Filter failed')}</div>`;
            });
        });
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {

    // Add search input listener
    const searchInput = document.getElementById('campaign-search');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchCampaigns(e.target);
        });
    }
});

document.addEventListener('click', function(e) {
    const editBtn = e.target.closest('a[data-campaign-id]');
    if (editBtn && editBtn.getAttribute('data-campaign-id')) {
        e.preventDefault();
        const campaignId = editBtn.getAttribute('data-campaign-id');
        openEditModal(campaignId);
    }
});

// Function to open edit modal with campaign data
function openEditModal(campaignId) {

    // Show loading state
    document.getElementById('edit_campaign_title').value = jsLang('Loading...');

    // Build the correct URL using route template set in Blade
    const editRoute = (typeof editCampaignRouteTemplate !== 'undefined' && editCampaignRouteTemplate)
        ? editCampaignRouteTemplate.replace('__ID__', campaignId)
        : `${campaignRoute}/${campaignId}/edit`;

    // Fetch campaign data
    fetch(editRoute, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(jsLang('Network response was not ok: ') + response.status);
            }
            return response.json();
        })
        .then(campaign => {

            // Populate form fields
            document.getElementById('edit_campaign_id').value = campaign.id;
            document.getElementById('edit_campaign_title').value = campaign.title || '';

            // Handle ends_at date - extract only the date part if it's a datetime
            let endsAtValue = campaign.ends_at || '';
            if (endsAtValue && endsAtValue.includes(' ')) {
                // If it's a datetime string, extract just the date part
                endsAtValue = endsAtValue.split(' ')[0];
            }

            const endDateInput = document.getElementById('edit_end_date');
            endDateInput.value = endsAtValue;

            // Handle status-based field disabling - ONLY FOR END DATE
            const endDateDisabledMessage = document.getElementById('end_date_disabled_message');

            if (campaign.status === 'published') {
                // Disable end date input for completed campaigns
                endDateInput.readOnly = true;
                endDateInput.disabled = true;
                endDateInput.classList.add('bg-gray-100', 'dark:bg-color-47', 'cursor-not-allowed', 'opacity-75');
                endDateDisabledMessage.classList.remove('hidden');
            } else {
                // Enable end date input for other statuses
                endDateInput.readOnly = false;
                endDateInput.disabled = false;
                endDateInput.classList.remove('bg-gray-100', 'dark:bg-color-47', 'cursor-not-allowed', 'opacity-75');
                endDateDisabledMessage.classList.add('hidden');
            }

            // Set AI Reply checkbox - handle multiple value formats
            const aiReplyCheckbox = document.getElementById('edit_ai_reply');
            const aiReplyOptions = document.getElementById('aiReplyOptions');
            // Check if AI reply is enabled (handle string 'on', boolean true, or numeric 1)
            // Also check meta value if ai_reply is not directly on campaign
            const aiReplyValue = campaign.ai_reply || campaign.metas?.find(m => m.key === 'ai_reply')?.value;
            const isAiReplyOn = aiReplyValue === 'on' || aiReplyValue === true || aiReplyValue === 1 || aiReplyValue === '1';
            
            // Set AI Reply checkbox state
            if (aiReplyCheckbox) {
                aiReplyCheckbox.value = isAiReplyOn ? 'on' : '';
                aiReplyCheckbox.checked = isAiReplyOn;
            }
            
            // Helper function to trigger select change events
            const triggerSelectChange = (select) => {
                if (typeof $ !== 'undefined') {
                    $(select).trigger('change');
                } else {
                    select.dispatchEvent(new Event('change'));
                }
            };
            
            // Initialize AI Reply options visibility and populate values
            const initAiReplyOptions = () => {
                const optionsEl = document.getElementById('aiReplyOptions');
                const checkboxEl = document.getElementById('edit_ai_reply');
                
                if (!optionsEl || !checkboxEl) return;
                
                // Set visibility
                if (checkboxEl.checked) {
                    optionsEl.classList.remove('hidden');
                    
                    // Populate values if enabled
                    if (campaign.chat_provider) {
                        const chatProvider = document.getElementById('chatProvider');
                        if (chatProvider) {
                            chatProvider.value = campaign.chat_provider;
                            triggerSelectChange(chatProvider);
                        }
                    }
                    
                    if (campaign.chat_model) {
                        const chatModel = document.getElementById('chatModel');
                        if (chatModel) chatModel.value = campaign.chat_model;
                    }
                    
                    if (campaign.embedding_provider) {
                        const embeddingProvider = document.getElementById('embeddingProvider');
                        if (embeddingProvider) {
                            embeddingProvider.value = campaign.embedding_provider;
                            triggerSelectChange(embeddingProvider);
                        }
                    }
                    
                    if (campaign.embedding_model) {
                        const embeddingModel = document.getElementById('embeddingModel');
                        if (embeddingModel) embeddingModel.value = campaign.embedding_model;
                    }
                } else {
                    optionsEl.classList.add('hidden');
                }
            };

            // Handle Schedule Campaign toggle, date, and time
            const scheduleCheckbox = document.getElementById('edit_schedule_toggle');
            const scheduleOptions = document.getElementById('edit_schedule_options');
            const scheduleDateInput = document.getElementById('edit_schedule_date');
            const scheduleTimeInput = document.getElementById('edit_schedule_time');

            // Check if schedule is on and show/hide options accordingly
            const isScheduleOn = campaign.schedule === 'on' || campaign.schedule === true;
            scheduleCheckbox.checked = isScheduleOn;

            if (isScheduleOn) {
                scheduleOptions.classList.remove('hidden');

                // Set schedule date and time if available
                if (campaign.schedule_at) {
                    // If schedule_at is a datetime string, split into date and time
                    const scheduleAt = new Date(campaign.schedule_at);

                    scheduleDateInput.value = formatDateToYMD(scheduleAt);
                    scheduleTimeInput.value = formatTimeToHM(scheduleAt);
                } else {
                    // If no schedule_at, set current date and time as default
                    const now = new Date();
                    scheduleDateInput.value = formatDateToYMD(now);
                    scheduleTimeInput.value = formatTimeToHM(now);
                }
            } else {
                scheduleOptions.classList.add('hidden');
                // Clear schedule date and time when schedule is off
                scheduleDateInput.value = '';
                scheduleTimeInput.value = '';
            }

            // Open modal using modalUtils if available, otherwise use direct method
            const modal = document.getElementById('editCampaignModal');
            if (modal) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('opacity-100');
                    const modalBox = modal.querySelector('.modalBox');
                    if (modalBox) {
                        modalBox.classList.remove('scale-0', 'opacity-0');
                        modalBox.classList.add('scale-100', 'opacity-100');
                    }
                    
                    // Initialize AI Reply options after modal animation
                    setTimeout(() => initAiReplyOptions(), 100);
                }, 10);
            } else if (typeof window.modalUtils !== 'undefined' && window.modalUtils.openModal) {
                window.modalUtils.openModal('editCampaignModal');
                setTimeout(() => initAiReplyOptions(), 100);
            }
        })
        .catch(error => {
            toastMixin.fire({
                title: jsLang('Error loading campaign data. Please try again.'),
                icon: 'error',
            });
        });
}

// Function to update campaign
function updateCampaign(form) {
    const formData = new FormData(form);
    const campaignId = document.getElementById('edit_campaign_id').value;
    const submitButton = form.querySelector('button[type="submit"]');
    const loaderIcon = submitButton.querySelector('.loader-icon');
    const buttonText = submitButton.querySelector('span');

    // Remove disabled end date field from formData to prevent it from being sent
    const endDateInput = document.getElementById('edit_end_date');
    if (endDateInput.disabled) {
        formData.delete('ends_at');
    }

    // Handle checkbox values properly
    const aiReplyCheckbox = document.getElementById('edit_ai_reply');
    const scheduleCheckbox = document.getElementById('edit_schedule_toggle');

    if (aiReplyCheckbox && aiReplyCheckbox.checked) {
        formData.set('ai_reply', 'on');
    } else {
        formData.delete('ai_reply');
        // Clear AI Reply options when AI Reply is off
        formData.delete('chat_provider');
        formData.delete('chat_model');
        formData.delete('embedding_provider');
        formData.delete('embedding_model');
    }

    if (scheduleCheckbox && scheduleCheckbox.checked) {
        formData.set('schedule', 'on');
    } else {
        formData.delete('schedule');
        // Also clear schedule date and time when schedule is off
        formData.delete('schedule_date');
        formData.delete('schedule_time');
    }

    // Show loading state
    buttonText.textContent = jsLang('Updating...');
    loaderIcon.classList.remove('hidden');
    submitButton.disabled = true;

    // Build the correct update URL using route template from Blade
    const updateRoute = (typeof updateCampaignRouteTemplate !== 'undefined' && updateCampaignRouteTemplate)
        ? updateCampaignRouteTemplate.replace('__ID__', campaignId)
        : `${campaignRoute}/${campaignId}`;

    // Add method spoofing for PUT request
    formData.append('_method', 'PUT');

    fetch(updateRoute, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
        .then(async response => {
            const data = await response.json();
            
            if (!response.ok) {
                // Handle validation errors (422) or other errors
                let errorMessage = jsLang('Error updating campaign. Please try again.');
                
                if (response.status === 422 && data.errors) {
                    // Extract validation error messages
                    const errorMessages = [];
                    for (const field in data.errors) {
                        if (Array.isArray(data.errors[field])) {
                            errorMessages.push(...data.errors[field]);
                        } else {
                            errorMessages.push(data.errors[field]);
                        }
                    }
                    errorMessage = errorMessages.length > 0 
                        ? errorMessages.join('<br>') 
                        : jsLang('Validation failed. Please check your input.');
                } else if (data.error) {
                    errorMessage = data.error;
                } else if (data.message) {
                    errorMessage = data.message;
                }
                
                throw new Error(errorMessage);
            }
            
            return data;
        })
        .then(data => {
            if (data.success) {
                // Close modal
                closeModal('editCampaignModal');

                // Show success toast
                toastMixin.fire({
                    title: jsLang('Campaign updated successfully.'),
                    icon: 'success',
                });

                // Reload the page or update the table
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                throw new Error(data.error || data.message || jsLang('Failed to update campaign'));
            }
        })
        .catch(error => {
            // Show error toast with exact error message
            const errorMessage = error.message || jsLang('Error updating campaign. Please try again.');
            toastMixin.fire({
                title: errorMessage,
                icon: 'error',
            });
            console.error('Update campaign error:', error);
        })
        .finally(() => {
            buttonText.textContent = jsLang('Update');
            loaderIcon.classList.add('hidden');
            submitButton.disabled = false;
        });
}


function formatDateToYMD(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}
function formatTimeToHM(date) {
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
}

// Add event listeners for toggles and form submission
document.addEventListener('DOMContentLoaded', function() {
    // Schedule toggle event listener
    const scheduleToggle = document.getElementById('edit_schedule_toggle');
    const scheduleOptions = document.getElementById('edit_schedule_options');
    const scheduleDateInput = document.getElementById('edit_schedule_date');
    const scheduleTimeInput = document.getElementById('edit_schedule_time');

    if (scheduleToggle) {
        scheduleToggle.addEventListener('change', function() {
            if (this.checked) {
                scheduleOptions.classList.remove('hidden');
                // Set default date and time if empty
                if (!scheduleDateInput.value) {
                    const now = new Date();
                    scheduleDateInput.value = formatDateToYMD(now);
                }
                if (!scheduleTimeInput.value) {
                    const now = new Date();
                    scheduleTimeInput.value = formatTimeToHM(now);
                }
            } else {
                scheduleOptions.classList.add('hidden');
                // Clear values when schedule is turned off
                scheduleDateInput.value = '';
                scheduleTimeInput.value = '';
            }
        });
    }

    // AI Reply toggle event listener
    const aiReplyToggle = document.getElementById('edit_ai_reply');
    const aiReplyOptions = document.getElementById('aiReplyOptions');
    
    if (aiReplyToggle && aiReplyOptions) {
        aiReplyToggle.addEventListener('change', function() {
            aiReplyOptions.classList.toggle('hidden', !this.checked);
        });
    }

    // Add event listener for form submission
    const editForm = document.getElementById('edit-campaign-form');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            updateCampaign(this);
        });
    }
});