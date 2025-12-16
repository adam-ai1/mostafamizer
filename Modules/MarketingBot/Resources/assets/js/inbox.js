"use strict";

// Global variable to track active conversation ID
let activeConversationId = null;

// Pagination state for messages
let messagePagination = {
    currentPage: 1,
    hasPreviousPage: false,
    hasMorePages: true,
    isLoading: false
};

// Helper function to scroll message container to bottom
function scrollToBottom() {
    const container = $('.message-container');
    if (container.length && container.length > 0) {
        const element = container[0];
        
        // Method 1: Scroll using scrollTop (most reliable)
        element.scrollTop = element.scrollHeight;
        
        // Method 2: Try scrolling the last child element into view
        const lastChild = container.find('> *').last();
        if (lastChild.length > 0) {
            lastChild[0].scrollIntoView({ behavior: 'instant', block: 'end' });
        }
    }
}

// Generate skeleton loader HTML for top loading
function generateTopSkeletonLoader() {
    return `
        <div class="message-top-skeleton-loader space-y-6">
            <!-- Bot Message Skeleton (Right side) -->
            <div class="ml-auto w-72">
                <div class="bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-800 dark:to-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl p-5 animate-pulse">
                    <div class="space-y-3">
                        <div class="h-4 bg-gray-300 dark:bg-gray-600 rounded w-3/4"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-gray-300 dark:bg-gray-600 rounded w-full"></div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="h-6 bg-gray-300 dark:bg-gray-600 rounded-full w-20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Message Skeleton (Left side) -->
            <div class="flex items-start gap-4">
                <div class="shrink-0 w-12 h-12 bg-gray-300 dark:bg-gray-600 rounded-full animate-pulse"></div>
                <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl rounded-tl-md px-6 py-4 max-w-xs border border-gray-200 dark:border-gray-600 animate-pulse">
                    <div class="space-y-2">
                        <div class="h-3 bg-gray-300 dark:bg-gray-600 rounded w-full"></div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Setup scroll event listener for message container
function setupMessageScrollListener(conversationId) {
    const container = $('.message-container');
    
    // Remove any existing listener to avoid duplicates
    container.off('scroll.messagePagination');
    
    // Add scroll listener
    container.on('scroll.messagePagination', function() {
        const scrollTop = $(this).scrollTop();

        // Check if scrolled within 50px of top (scrolling up)
        if (scrollTop <= 50 && !messagePagination.isLoading) {
            loadPreviousMessages(conversationId);
        }
    });
}

// Load previous page of messages when scrolling to top
function loadPreviousMessages(conversationId) {
    if (messagePagination.isLoading) {
        return;
    }
    
    // Check if there's a next page before making the API call
    if (!messagePagination.hasMorePages) {
        return;
    }
    
    const container = $('.message-container');
    if (container.length === 0) {
        return;
    }
    
    messagePagination.isLoading = true;
    const nexPage = messagePagination.currentPage + 1;
    
    // Save current scroll position
    const oldScrollTop = container[0].scrollTop;
    const oldScrollHeight = container[0].scrollHeight;
    
    // Insert skeleton loader at top
    const skeletonHtml = generateTopSkeletonLoader();
    container.prepend(skeletonHtml);
    
    $.ajax({
        url: SITE_URL + `/user/marketing-bot/conversation/${conversationId}/messages`,
        type: "GET",
        data: {
            page: nexPage
        },
        beforeSend(xhr) {
            xhr.setRequestHeader("Authorization", `Bearer ${ACCESS_TOKEN}`);
        },
        success: function (response) {
            // Remove skeleton loader
            container.find('.message-top-skeleton-loader').remove();
            
            // Extract only the message items from the response
            // The response.messages contains skeleton and message-container
            // We need to extract just the children of message-container
            const tempDiv = $('<div>').html(response.messages);
            const messageContainer = tempDiv.find('.message-container');
            const messageItems = messageContainer.children();
            
            if (messageItems.length > 0) {
                // Prepend new messages to top in correct order
                // Reverse the order since prepend adds items in reverse
                const itemsArray = messageItems.toArray().reverse();
                itemsArray.forEach(function(item) {
                    container.prepend(item);
                });
                
                // Restore scroll position
                requestAnimationFrame(function() {
                    const newScrollHeight = container[0].scrollHeight;
                    const heightDiff = newScrollHeight - oldScrollHeight;
                    container[0].scrollTop = oldScrollTop + heightDiff;
                });
            }
            
            // Update pagination state
            if (response.currentPage !== undefined) {
                messagePagination.currentPage = response.currentPage;
                messagePagination.hasPreviousPage = response.hasPreviousPage || false;
                messagePagination.hasMorePages = response.hasMorePages !== undefined ? response.hasMorePages : true;
            }
            messagePagination.isLoading = false;
        },
        error: function() {
            // Remove skeleton loader on error
            container.find('.message-top-skeleton-loader').remove();
            messagePagination.isLoading = false;
        }
    });
}

function getMessages(e) {
    let id = e.getAttribute('data-inbox-id');
    let channel = e.getAttribute('data-channel');

    setTimeout(function() {
        $('.main-header-container').addClass('hidden');
        $('[id^="conversation-row-"]').removeClass('hidden');
        $('.skeleton-header-container').removeClass('hidden');
        $('[class^="inbox-conversation-row-skeleton"]').addClass('hidden');
    }, 500);

    // Update active conversation ID
    activeConversationId = id;
    
    // Reset pagination state for new conversation
    messagePagination.currentPage = 1;
    messagePagination.hasPreviousPage = false;
    messagePagination.hasMorePages = true;
    messagePagination.isLoading = false;

    $.ajax({
        url: SITE_URL + `/user/marketing-bot/conversation/${id}/messages`,
        type: "GET",
        beforeSend(xhr) {
            xhr.setRequestHeader("Authorization", `Bearer ${ACCESS_TOKEN}`);
        },
        success: function (response) {
            // Remove active state from all conversation rows
            $('[id^="conversation-row-"]').removeClass('border-2 border-purple-200 dark:border-purple-700 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200')
            $('[id^="conversation-row-"]').addClass('bg-white dark:bg-color-33 border border-white dark:border-color-47 hover:border-color-89 dark:hover:border-color-89');
            
            // Add active state to selected conversation row
            const selectedRow = $('#conversation-row-' + id);
            selectedRow.removeClass('bg-white dark:bg-color-33 border border-white dark:border-color-47 hover:border-color-89 dark:hover:border-color-89');
            selectedRow.addClass('border-2 border-purple-200 dark:border-purple-700 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200')
            
            // Remove unread badge and update total count
            const unreadBadge = selectedRow.find('span.absolute').filter(function() {
                return /^\d+\+?$/.test($(this).text().trim());
            });
            if (unreadBadge.length) {
                const unreadCount = parseInt(unreadBadge.text().replace('+', '')) || 0;
                unreadBadge.remove();
                const $total = $('#total-unread-count');
                if ($total.length) {
                    const newTotal = Math.max(0, (parseInt($total.text()) || 0) - unreadCount);
                    newTotal > 0 ? $total.text(newTotal) : $total.remove();
                }
            }
            
            $('#header-container').html(response.header);
            $('.skeleton-header-container').addClass('hidden');
            $('#header-empty-state').addClass('hidden');
            
            // Re-initialize chat drawer functionality for the newly inserted header
            if (window.initializeChatDrawer) {
                window.initializeChatDrawer();
            }
            
            $('#all-messages').html(response.messages);
            $('#reply-form #conversation_id').val(id);
            $('#reply-form #channel').val(channel);
            
            // Hide messages empty state when conversation is selected
            $('#messages-empty-state').addClass('hidden');
            
            // Update pagination state
            if (response.currentPage !== undefined) {
                messagePagination.currentPage = response.currentPage;
                messagePagination.hasPreviousPage = response.hasPreviousPage || false;
                messagePagination.hasMorePages = response.hasMorePages !== undefined ? response.hasMorePages : true;
            } else {
                // Default to page 1 if not provided
                messagePagination.currentPage = 1;
                messagePagination.hasPreviousPage = false;
                messagePagination.hasMorePages = true;
            }
            messagePagination.isLoading = false;

            setTimeout(function() {
                $('.skeleton-message-container').addClass('hidden');

                // Check if message container exists (messages are present)
                const messageContainer = $('.message-container');
                if (messageContainer.length > 0) {
                    messageContainer.removeClass('hidden');

                    // Setup scroll listener for infinite scroll to top
                    setupMessageScrollListener(id);

                    // Scroll to bottom after container becomes visible
                    // Use multiple attempts to ensure it works even if content is still loading
                    requestAnimationFrame(function() {
                        scrollToBottom();
                    });

                    // Try scrolling multiple times to handle dynamic content loading
                    setTimeout(function() {
                        scrollToBottom();
                    }, 100);

                    setTimeout(function() {
                        scrollToBottom();
                    }, 300);
                } else {
                    // No messages, show empty state
                    $('#messages-empty-state').removeClass('hidden');
                }
            }, 500);
        }
    });
}

// Delete chat handler
$(document).on('click', '.delete-chat', function (e) {
    e.preventDefault();
    e.stopPropagation();
    
    const deleteBtn = $(this);
    const chatId = deleteBtn.data('chat-id');
    const deleteRoute = deleteBtn.data('chat-route');
    const modal = deleteBtn.closest('.sweet-modal');
    const modalBox = modal.find('.modalBox');
    const loader = deleteBtn.find('.loader');
    const cancelBtn = modal.find('.closeModalBtn');
    
    // Disable buttons and show loading
    deleteBtn.prop('disabled', true);
    cancelBtn.prop('disabled', true);
    loader.removeClass('hidden');
    
    // Make AJAX DELETE request
    $.ajax({
        url: deleteRoute,
        type: 'DELETE',
        data: {
            _token: CSRF_TOKEN
        },
        beforeSend(xhr) {
            xhr.setRequestHeader("Authorization", `Bearer ${ACCESS_TOKEN}`);
        },
        success: function(response) {
            // Hide loading spinner
            loader.addClass('hidden');
            
            // Show success toast
            toastMixin.fire({
                title: response.message || jsLang("Chat deleted successfully"),
                 icon: response.status === 'info' ? 'error' : 'success',
            });
            
            // Close modal
            modal.removeClass('opacity-100');
            modalBox.removeClass('scale-100', 'opacity-100');
            modalBox.addClass('scale-0', 'opacity-0');
            setTimeout(() => {
                modal.addClass('hidden');
            }, 300);
            
            // Update active conversation ID if it was the deleted one
            if (activeConversationId === chatId) {
                activeConversationId = null;
            }
            
            // Find next conversation to select BEFORE removing the row
            const conversationRow = $('#conversation-row-' + chatId);
            let nextRow = null;
            
            // Try to find next sibling (row after the deleted one)
            nextRow = conversationRow.next('[id^="conversation-row-"]');
            
            // If no next row, try previous sibling
            if (nextRow.length === 0) {
                nextRow = conversationRow.prev('[id^="conversation-row-"]');
            }
            
            // If still no row, try first available row (excluding the one being deleted)
            if (nextRow.length === 0) {
                const allRows = $('[id^="conversation-row-"]').not('#conversation-row-' + chatId);
                if (allRows.length > 0) {
                    nextRow = allRows.first();
                }
            }
            
            // Remove conversation row from sidebar
            conversationRow.remove();
            
            // Check if there are any conversations left after removal
            const remainingRows = $('[id^="conversation-row-"]');
            
            if (nextRow && nextRow.length > 0) {
                // Get the inner div with data-inbox-id
                const clickableDiv = nextRow.find('[data-inbox-id]').first();
                if (clickableDiv.length > 0) {
                    // Trigger click to load the next conversation
                    getMessages(clickableDiv[0]);
                }
            } else if (remainingRows.length === 0) {
                // No conversations left - show empty state
                const container = $('#conversation-list-container');
                const noDataHtml = `
                    <div class="flex flex-col items-center justify-center py-12 px-4">
                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium mb-1">${jsLang("No conversations found")}</p>
                        <p class="text-gray-500 dark:text-gray-500 text-xs text-center max-w-xs">${jsLang("Start a conversation to see messages here")}</p>
                    </div>
                `;
                container.html(noDataHtml);

                // Show header empty state and messages empty state
                $('.main-header-container').addClass('hidden');
                $('#header-empty-state').removeClass('hidden');
                
                // Clear messages container and show empty state
                $('.message-container').addClass('hidden');
                $('.skeleton-message-container').addClass('hidden');
                
                // Show messages empty state (it should be in the DOM from messages.blade.php)
                // If it doesn't exist, create it
                if ($('#messages-empty-state').length === 0) {
                    const emptyStateHtml = `
                        <div id="messages-empty-state" class="p-5 h-[calc(100vh-184px)] overflow-y-auto flex flex-col items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium mb-1">${jsLang("No messages yet")}</p>
                            <p class="text-gray-500 dark:text-gray-500 text-xs text-center max-w-xs">${jsLang("Start the conversation by sending a message")}</p>
                        </div>
                    `;
                    $('#all-messages').html(emptyStateHtml);
                } else {
                    $('#messages-empty-state').removeClass('hidden');
                }
                
                // Reset form but keep it visible
                $('#reply-form')[0].reset();
                $('#reply-form #conversation_id').val('');
                $('#reply-form #channel').val('');

                // Reset active conversation
                activeConversationId = null;
            }
        },
        error: function(xhr) {
            // Hide loading spinner
            loader.addClass('hidden');
            
            // Re-enable buttons
            deleteBtn.prop('disabled', false);
            cancelBtn.prop('disabled', false);
            
            // Show error toast
            const errorMessage = xhr.responseJSON?.error || jsLang("Failed to delete chat");
            toastMixin.fire({
                title: errorMessage,
                icon: 'error',
            });
            
            // Modal stays open for retry
        }
    });
});

$(document).on('submit', '#reply-form', function (e) {
    e.preventDefault();

    const form = $(this);
    const id = form.find('[name="conversation_id"]').val();
    const message = form.find('[name="message"]').val();
    const container = $('.message-container');
    const btn = form.find('#send-message');

    // Prevent submission if no conversation is selected
    if (!id || id === '') {
        toastMixin.fire({
            title: jsLang("Please select a conversation first"),
            icon: 'warning',
        });
        return;
    }

    // Hide messages empty state if visible
    $('#messages-empty-state').addClass('hidden');
    
    // Create message bubble
    const messageHtml = formatMessage(message);
    if (container.length > 0) {
        container.removeClass('hidden');
        container.append(messageHtml);
        scrollToBottom();
    }


    $.ajax({
        url: `${SITE_URL}/user/marketing-bot/conversation/${id}/send/message`,
        type: "POST",
        data: form.serialize(),
        beforeSend(xhr) {
            xhr.setRequestHeader("Authorization", `Bearer ${ACCESS_TOKEN}`);
            form.find('[name="message"]').val('');
            btn.attr('disabled', 'disabled');
        },
        success(response) {

            // Check if response indicates demo mode
            if (response.status === 'info') {
                toastMixin.fire({
                    title: response.message,
                    icon: 'error',
                });
                btn.removeAttr('disabled');
                return;
            }

            btn.removeAttr('disabled');
            const row = $('#conversation-row-' + id);
            const container = row.parent();

            // Remove active state from all conversation rows
            $('[id^="conversation-row-"]').removeClass('border-2 border-purple-200 dark:border-purple-700 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200');
            $('[id^="conversation-row-"]').addClass('bg-white dark:bg-color-33 border border-white dark:border-color-47 hover:border-color-89 dark:hover:border-color-89');
            row.detach();
            container.prepend(row);

            // Re-add active state to the moved row
            row.removeClass('bg-white dark:bg-color-33 border border-white dark:border-color-47 hover:border-color-89 dark:hover:border-color-89');
            row.addClass('border-2 border-purple-200 dark:border-purple-700 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200');
            row.find('.conversation-time-' + id).text('Just now');
        },
        error(xhr) {
            // remove the just-added message if error occurs
            container.find('.message-item').first().remove();
            btn.removeAttr('disabled');

            toastMixin.fire({
                title: xhr.responseJSON?.error || xhr.responseJSON?.message || jsLang("Failed to send message"),
                icon: 'error',
            });
        }
    });
});

function formatMessage(message) {
    return `
        <div class="message-item bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border border-orange-200 dark:border-orange-700/50 rounded-2xl p-5 w-72 ml-auto">
            <div class="flex items-start space-x-4">
                <div class="flex-1">
                    <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed">
                        ${message}
                    </p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xs text-orange-600 dark:text-orange-400 font-medium bg-orange-100 dark:bg-orange-900/50 px-3 py-1 rounded-full">
                            ${time}
                        </span>
                    </div>
                </div>
            </div>
        </div>`;
}

function generateSkeletonLoader() {
    let skeletonHtml = '';
    for (let i = 0; i < 6; i++) {
        skeletonHtml += `
            <div class="h-full max-h-[72px] w-full py-[14px] rounded-lg bg-white dark:bg-color-33 border border-white dark:border-color-47 animate-pulse">
                <div class="flex gap-3 px-3">
                    <div class="shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    <div class="w-full">
                        <div class="w-full flex items-center gap-[6px] justify-between">
                            <div class="flex items-center gap-[6px]">
                                <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded"></div>
                            </div>
                            <div class="h-3 w-12 bg-gray-200 dark:bg-gray-700 rounded flex-shrink-0"></div>
                        </div>
                        <div class="mt-1 mb-0.5 h-4 w-32 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    </div>
                </div>
            </div>
        `;
    }
    return skeletonHtml;
}

// Pagination functionality
$(document).ready(function() {
    const container = $('#conversation-list-container');
    
    // Exit if container doesn't exist
    if (container.length === 0) {
        return;
    }
    
    // Activate and load the first conversation automatically
    const firstConversation = $('[data-inbox-id]').first();
    if (firstConversation.length > 0) {
        const firstId = firstConversation.attr('data-inbox-id');
        activeConversationId = firstId;
        getMessages(firstConversation[0]);
    } else {
        // No conversations available, show empty states
        $('#conversation-skeleton-loader').addClass('hidden');
        $('#conversation-empty-state').removeClass('hidden');
        $('.skeleton-header-container').addClass('hidden');
        $('#header-empty-state').removeClass('hidden');
        $('.skeleton-message-container').addClass('hidden');
        $('#messages-empty-state').removeClass('hidden');
        
        // Keep message input form visible but reset it
        $('#reply-form')[0].reset();
        $('#reply-form #conversation_id').val('');
        $('#reply-form #channel').val('');
    }
    
    let isLoading = false;
    let searchTimeout = null;
    let currentSearch = '';
    let currentChannel = 'all';
    
    // Toggle filter dropdown when filter button is clicked
    $(document).on('click', '#inbox-filter-toggle-btn', function(e) {
        e.stopPropagation();
        $('#inbox-channel-filter-section').toggleClass('hidden');
    });
    
    // Toggle channel filter dropdown menu when channel filter button is clicked
    $(document).on('click', '#inbox-channel-filter-btn', function(e) {
        e.preventDefault();
        
        const menu = $('#inbox-channel-menu');
        menu.removeClass('hidden');
    });
    
    // Prevent menu and menu items from triggering document click to close
    $(document).on('click', '#inbox-channel-menu', function(e) {
        e.stopPropagation();
    });
    
    // Prevent menu item clicks from closing immediately
    $(document).on('click', '#inbox-channel-menu li', function(e) {
        e.stopPropagation();
    });
    
    // Close filter dropdown when clicking outside
    $(document).on('click', function(e) {
        
        const target = $(e.target);
        
        // Check if click is inside any of these elements
        const isInsideFilterToggle = target.closest('#inbox-filter-toggle-btn').length > 0;
        const isInsideFilterSection = target.closest('#inbox-channel-filter-section').length > 0;
        const isInsideChannelBtn = target.closest('#inbox-channel-filter-btn').length > 0;
        const isInsideChannelMenu = target.closest('#inbox-channel-menu').length > 0;
        
        // Close channel menu only if clicking outside
        if (!isInsideChannelBtn && !isInsideChannelMenu) {;
            $('#inbox-channel-menu').addClass('hidden');
        }
        
        // Close filter section only if clicking outside
        if (!isInsideFilterToggle && !isInsideFilterSection) {
            $('#inbox-channel-filter-section').addClass('hidden');
        }
    });
    
    // Load conversations function with search and channel filters
    function loadConversations(page = 1, append = false) {
        if (isLoading && !append) return;
        
        // Store active conversation ID before loading new results
        if (!append) {
            const activeRow = $('[id^="conversation-row-"].border-2');
            if (activeRow.length > 0) {
                const rowId = activeRow.attr('id');
                activeConversationId = rowId ? rowId.replace('conversation-row-', '') : null;
            }
        }
        
        isLoading = true;
        
        // Prepare request data
        const requestData = {
            page: page
        };
        
        // Add search parameter if exists
        if (currentSearch && currentSearch.trim() !== '') {
            requestData.search = currentSearch.trim();
        }
        
        // Add channel parameter if not 'all'
        if (currentChannel && currentChannel !== 'all') {
            requestData.channel = currentChannel;
        }
        
        // Show loading indicator for append only
        if (append) {
            $('#conversation-loading').removeClass('hidden');
        }
        
        $.ajax({
            url: `${SITE_URL}/user/marketing-bot/inbox`,
            type: 'GET',
            data: requestData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {

                // Check if response is empty or no conversations found
                // Check if response.html exists and contains conversation rows
                let isEmpty = false;

                if (!response || !response.html) {
                    isEmpty = true;
                } else {
                    // Trim whitespace and check if it's actually empty
                    const trimmedHtml = response.html.trim();
                    if (trimmedHtml === '') {
                        isEmpty = true;
                    } else {
                        // Check if HTML contains conversation-row elements
                        // Use indexOf for faster check before jQuery parsing
                        if (trimmedHtml.indexOf('conversation-row-') === -1) {
                            isEmpty = true;
                        } else {
                            // Create a temporary div to parse the HTML and check for conversation rows
                            const tempDiv = $('<div>').html(trimmedHtml);
                            const conversationRows = tempDiv.find('[id^="conversation-row-"]');
                            isEmpty = conversationRows.length === 0;
                        }
                    }
                }

                if (append) {
                    // Append new conversations before the loading indicator
                    if (!isEmpty) {
                        $('#conversation-loading').before(response.html);
                    }
                } else {
                    // Hide skeleton loader
                    $('#conversation-skeleton-loader').addClass('hidden');

                    if (isEmpty) {
                        // Show empty state
                        $('#conversation-empty-state').removeClass('hidden');
                    } else {
                        // Replace content with new results
                        container.html(response.html);
                    }
                    // Re-add loading indicator
                    container.append('<div id="conversation-loading" class="hidden py-4 text-center"><div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-gray-900 dark:border-white"></div><p class="mt-2 text-sm text-gray-600 dark:text-gray-400">' + jsLang("Loading more conversations...") + '</p></div>');

                    // Reactivate previously active conversation if it exists in new results
                    if (activeConversationId && !isEmpty) {
                        const previousActiveRow = $('#conversation-row-' + activeConversationId);
                        if (previousActiveRow.length > 0) {
                            // Remove active state from all rows
                            $('[id^="conversation-row-"]').removeClass('border-2 border-purple-200 dark:border-purple-700 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200');
                            $('[id^="conversation-row-"]').addClass('bg-white dark:bg-color-33 border border-white dark:border-color-47 hover:border-color-89 dark:hover:border-color-89');

                            // Reactivate the previous active conversation
                            previousActiveRow.removeClass('bg-white dark:bg-color-33 border border-white dark:border-color-47 hover:border-color-89 dark:hover:border-color-89');
                            previousActiveRow.addClass('border-2 border-purple-200 dark:border-purple-700 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200');

                            // Reload messages for the active conversation
                            const activeElement = previousActiveRow.find('[data-inbox-id]').first();
                            if (activeElement.length > 0) {
                                getMessages(activeElement[0]);
                            }
                        }
                    }
                }
                
                // Update pagination state
                container.data('current-page', page);
                container.data('has-more', response.hasMorePages ? 'true' : 'false');
                
                // Hide loading indicator
                $('#conversation-loading').addClass('hidden');
                
                isLoading = false;
            },
            error: function(xhr) {
                $('#conversation-loading').addClass('hidden');

                // Hide skeleton loader on error if this was the initial load
                if (!append) {
                    $('#conversation-skeleton-loader').addClass('hidden');
                    // Show empty state on error
                    $('#conversation-empty-state').removeClass('hidden');
                }

                toastMixin.fire({
                    title: xhr.responseJSON?.message || jsLang("Failed to load conversations"),
                    icon: 'error',
                });

                isLoading = false;
            }
        });
    }
    
    function loadNextPage() {
        if (isLoading) return;
        
        const currentPage = parseInt(container.data('current-page')) || 1;
        const nextPage = currentPage + 1;
        
        loadConversations(nextPage, true);
    }
    
    // Search input handler with debounce
    $('#inbox-search-input').on('input', function() {
        const searchValue = $(this).val();
        currentSearch = searchValue;
        
        // Clear previous timeout
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }
        
        // Debounce search (300ms)
        searchTimeout = setTimeout(function() {
            loadConversations(1, false);
        }, 300);
    });
    
    // Channel filter option click handler using event delegation
    // This works with the existing custom-select dropdown functionality
    $(document).on('click', '#inbox-channel-menu li', function(e) {
        e.stopPropagation();
        
        const channel = $(this).data('channel');
        const channelText = $(this).text().trim();
        
        if (channel !== undefined) {
            currentChannel = channel || 'all';
            
            // Update selected option text
            $('#inbox-channel-selected').text(channelText);
            
            // Close the menu
            $('#inbox-channel-menu').addClass('hidden');
            
            // Reload conversations with new filter
            loadConversations(1, false);
        }
    });
    
    // Scroll pagination
    container.on('scroll', function() {
        const scrollTop = $(this).scrollTop();
        const scrollHeight = $(this)[0].scrollHeight;
        const clientHeight = $(this).height();
        const scrollBottom = scrollHeight - scrollTop - clientHeight;
        
        // Check if near bottom (within 100px)
        if (scrollBottom <= 100 && !isLoading) {
            const hasMore = container.data('has-more') === 'true' || container.data('has-more') === true;
            
            if (hasMore) {
                loadNextPage();
            }
        }
    });
});

$(document).on('change', '#auto-reply-toggle', function() {
    const url = $(this).data('url');
    const isEnabled = $(this).is(':checked');
    const status = isEnabled ? 'on' : 'off';
    const inboxId = $(this).data('inbox-id');
    
    // Your AJAX call to update the status
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            _token: CSRF_TOKEN,
            inbox_id: inboxId,
            ai_reply: status
        },
        success: function(response) {
            toastMixin.fire({
                title: response.message || jsLang("Auto reply updated successfully"),
                icon: 'success',
            });
            // Optional: Show success message
        },
        error: function(error) {
            // Revert toggle on error
            $('#auto-reply-toggle').prop('checked', !isEnabled);
            toastMixin.fire({
                title: error.responseJSON?.message || jsLang("Failed to update auto reply"),
                icon: 'error',
            });
        }
    });
});