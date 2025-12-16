"use strict";
    function toggleSideNav() {
        let collapse_icon = document.querySelector('.collapse-icon');
        let close = document.querySelector('.close');
        let sidenav = document.querySelector('#sidenav');
        let overlay = document.querySelector('#overlay');

        let classOpen = [sidenav, overlay];

        collapse_icon.addEventListener('click', function(e) {
            classOpen.forEach(el => el.classList.add('active'));
        });

        let classCloseClick = [overlay, close];
        classCloseClick.forEach(function(el) {
            el.addEventListener('click', function(els) {
                classOpen.forEach(el => el.classList.remove('active'));
            });
        });
    }

    function checkWindowWidth() {
        if (window.innerWidth < 992) {
            toggleSideNav();
        }
    }

    checkWindowWidth();
    window.addEventListener('resize', function() {
        checkWindowWidth();
    });

// toggle bar

var shrink_btn = document.querySelector(".shrink-btn");
if(shrink_btn) {
    shrink_btn.addEventListener("click", () => {
        document.body.classList.toggle("shrink");
        if (typeof moveActiveTab !== 'undefined') {
            setTimeout(moveActiveTab, 400);
        }
        shrink_btn.classList.add("hovered");
        setTimeout(() => {
            shrink_btn.classList.remove("hovered");
        }, 500);
    });
}

// Sidebar category management
// Make functions available immediately, before DOMContentLoaded
// localStorage keys
const STORAGE_KEY = 'sidebar_category_states';
const BADGE_STORAGE_KEY = 'new_badges_hidden';

// Get saved category states from localStorage
function getSavedCategoryStates() {
    try {
        const saved = localStorage.getItem(STORAGE_KEY);
        return saved ? JSON.parse(saved) : {};
    } catch (e) {
        return {};
    }
}

// Save category state to localStorage
function saveCategoryState(categoryName, isExpanded) {
    try {
        const states = getSavedCategoryStates();
        states[categoryName] = isExpanded;
        localStorage.setItem(STORAGE_KEY, JSON.stringify(states));
    } catch (e) {
    }
}

// Expand category
function expandCategory(button, saveState = true) {
    const ul = button.nextElementSibling;
    if (!ul) return;
    
    const icon = button.querySelector('.category-arrow');
    const categoryName = button.getAttribute('data-category-name');
    
    ul.style.maxHeight = ul.scrollHeight + "px";
    
    if (icon) {
        icon.classList.add('rotate-180');
    }
    
    button.classList.add('active-category');
    
    if (saveState && categoryName) {
        saveCategoryState(categoryName, true);
    }
    
    // Auto-adjust height when content changes
    setTimeout(() => {
        if (ul.offsetHeight > 0) {
            ul.style.maxHeight = ul.scrollHeight + "px";
        }
    }, 100);
}

// Collapse category
function collapseCategory(button, saveState = true) {
    const ul = button.nextElementSibling;
    if (!ul) return;
    
    const icon = button.querySelector('.category-arrow');
    const categoryName = button.getAttribute('data-category-name');
    
    ul.style.maxHeight = '0px';
    
    if (icon) {
        icon.classList.remove('rotate-180');
    }
    
    button.classList.remove('active-category');
    
    if (saveState && categoryName) {
        saveCategoryState(categoryName, false);
    }
}

// Toggle category - make it globally accessible immediately
function toggleSidebarCategory(button) {
    if (!button) return;
    
    const ul = button.nextElementSibling;
    if (!ul) return;
    
    const isExpanded = ul.scrollHeight > 0 && ul.offsetHeight > 0;
    
    if (isExpanded) {
        collapseCategory(button);
    } else {
        expandCategory(button);
    }
}

// Make it globally accessible
window.toggleSidebarCategory = toggleSidebarCategory;

// Check if badge should be hidden
function isBadgeHidden(itemId) {
    try {
        const hidden = localStorage.getItem(BADGE_STORAGE_KEY);
        if (!hidden) return false;
        const hiddenIds = JSON.parse(hidden);
        return Array.isArray(hiddenIds) && hiddenIds.includes(itemId);
    } catch (e) {
        return false;
    }
}

// Hide badge when user interacts with feature
function hideBadge(itemId) {
    try {
        const hidden = localStorage.getItem(BADGE_STORAGE_KEY);
        let hiddenIds = hidden ? JSON.parse(hidden) : [];
        if (!Array.isArray(hiddenIds)) hiddenIds = [];
        if (!hiddenIds.includes(itemId)) {
            hiddenIds.push(itemId);
            localStorage.setItem(BADGE_STORAGE_KEY, JSON.stringify(hiddenIds));
        }
        // Hide the badge element
        const badge = document.querySelector(`.new-badge[data-item-id="${itemId}"]`);
        if (badge) {
            badge.style.display = 'none';
        }
    } catch (e) {
    }
}


// Update active category state
function updateActiveCategory() {
    const categoryButtons = document.querySelectorAll('.category-header');
    const currentUrl = window.location.href;
    const currentPath = window.location.pathname;
    
    categoryButtons.forEach(button => {
        const ul = button.nextElementSibling;
        if (!ul) return;
        
        // Check for active menu item using multiple methods
        let hasActiveItem = false;
        
        // Method 1: Check for .main-menu.active class
        const activeMenuElement = ul.querySelector('.main-menu.active');
        if (activeMenuElement) {
            hasActiveItem = true;
        }
        
        // Method 2: Check for menu items with active-related classes
        if (!hasActiveItem) {
            const menuItems = ul.querySelectorAll('.main-menu');
            menuItems.forEach(menuItem => {
                // Check if menu item has active class or contains active link
                if (menuItem.classList.contains('active') || 
                    menuItem.classList.contains('bg-color-F6') ||
                    menuItem.classList.contains('border-design-1')) {
                    hasActiveItem = true;
                }
                
                // Check if the link href matches current URL
                const link = menuItem.querySelector('a');
                if (link) {
                    const linkHref = link.getAttribute('href');
                    if (linkHref) {
                        try {
                            const linkUrl = new URL(linkHref, window.location.origin);
                            if (linkUrl.pathname === currentPath || currentUrl.includes(linkUrl.pathname)) {
                                hasActiveItem = true;
                                // Also add active class if not present
                                if (!menuItem.classList.contains('active')) {
                                    menuItem.classList.add('active');
                                }
                            }
                        } catch (e) {
                            // If URL parsing fails, do simple string comparison
                            if (currentUrl.includes(linkHref) || linkHref === currentPath) {
                                hasActiveItem = true;
                                if (!menuItem.classList.contains('active')) {
                                    menuItem.classList.add('active');
                                }
                            }
                        }
                    }
                }
            });
        }
        
        if (hasActiveItem) {
            button.classList.add('active-category');
            // Also expand the category if it's collapsed
            const isExpanded = ul.scrollHeight > 0 && ul.offsetHeight > 0;
            if (!isExpanded) {
                expandCategory(button, false);
            }
        } else {
            button.classList.remove('active-category');
        }
    });
}

// Initialize sidebar on page load
document.addEventListener('DOMContentLoaded', function() {
    const savedStates = getSavedCategoryStates();
    const categoryButtons = document.querySelectorAll('.category-header');
    let activeCategoryFound = false;
    
    categoryButtons.forEach(button => {
        const categoryName = button.getAttribute('data-category-name');
        const ul = button.nextElementSibling;
        const hasActiveItem = ul && ul.querySelector('.main-menu.active');
        
        // Only expand the category containing the active menu item on initial load
        if (hasActiveItem) {
            expandCategory(button, false);
            button.classList.add('active-category');
            activeCategoryFound = true;
        } else {
            collapseCategory(button, false);
            button.classList.remove('active-category');
        }
    });
    
    // Update active category state immediately and after delays
    updateActiveCategory();
    setTimeout(updateActiveCategory, 50);
    setTimeout(updateActiveCategory, 100);
    setTimeout(updateActiveCategory, 300);
    setTimeout(updateActiveCategory, 500);
    
    // Scroll to active item
    const activeItem = document.querySelector('.main-menu.active');
    if (activeItem) {
        setTimeout(() => {
            activeItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 300);
    }
    
    // Update active category when menu items are clicked
    document.querySelectorAll('.main-menu a').forEach(menuItem => {
        menuItem.addEventListener('click', function(e) {
            // Update after page navigation
            setTimeout(function() {
                updateActiveCategory();
            }, 300);
        });
    });
    
    // Watch for changes in active menu items using MutationObserver
    const observer = new MutationObserver(function(mutations) {
        let shouldUpdate = false;
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                const target = mutation.target;
                if (target.classList.contains('main-menu')) {
                    shouldUpdate = true;
                }
            }
            if (mutation.type === 'childList') {
                shouldUpdate = true;
            }
        });
        if (shouldUpdate) {
            setTimeout(updateActiveCategory, 50);
        }
    });
    
    // Observe all menu items and category lists for changes
    document.querySelectorAll('.main-menu, .category-items').forEach(element => {
        observer.observe(element, {
            attributes: true,
            attributeFilter: ['class'],
            childList: true,
            subtree: true
        });
    });
    
    // Also update on URL change (for SPA-like navigation)
    let currentUrl = window.location.href;
    let currentPath = window.location.pathname;
    setInterval(function() {
        if (window.location.href !== currentUrl || window.location.pathname !== currentPath) {
            currentUrl = window.location.href;
            currentPath = window.location.pathname;
            // Update multiple times to catch different timing scenarios
            updateActiveCategory();
            setTimeout(function() {
                updateActiveCategory();
            }, 50);
            setTimeout(function() {
                updateActiveCategory();
            }, 100);
            setTimeout(function() {
                updateActiveCategory();
            }, 300);
            setTimeout(function() {
                updateActiveCategory();
            }, 500);
        }
    }, 200);
    
    // Update on window focus (when user comes back to tab)
    window.addEventListener('focus', function() {
        setTimeout(updateActiveCategory, 100);
    });
    
    // Hide badges that should be hidden
    document.querySelectorAll('.new-badge').forEach(badge => {
        const itemId = badge.getAttribute('data-item-id');
        if (itemId && isBadgeHidden(itemId)) {
            badge.style.display = 'none';
        }
    });
    
    // Track badge clicks/interactions
    document.querySelectorAll('.new-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            const itemId = this.getAttribute('data-item-id');
            if (itemId) {
                hideBadge(itemId);
            }
        });
    });
    
    // Track menu item clicks to hide badges
    document.querySelectorAll('a[href]').forEach(link => {
        link.addEventListener('click', function() {
            const menuItem = this.closest('.main-menu');
            if (menuItem) {
                const badge = menuItem.querySelector('.new-badge');
                if (badge) {
                    const itemId = badge.getAttribute('data-item-id');
                    if (itemId) {
                        hideBadge(itemId);
                    }
                }
            }
        });
    });
    
    // Mobile swipe gesture support
    let touchStartX = 0;
    let touchStartY = 0;
    
    categoryButtons.forEach(button => {
        button.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        }, { passive: true });
        
        button.addEventListener('touchend', function(e) {
            if (!touchStartX || !touchStartY) return;
            
            const touchEndX = e.changedTouches[0].clientX;
            const touchEndY = e.changedTouches[0].clientY;
            const diffX = touchStartX - touchEndX;
            const diffY = touchStartY - touchEndY;
            
            // Swipe right to expand, swipe left to collapse (if horizontal swipe is dominant)
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                const ul = this.nextElementSibling;
                const isExpanded = ul.scrollHeight > 0 && ul.offsetHeight > 0;
                
                if (diffX > 0 && !isExpanded) {
                    // Swipe right - expand
                    expandCategory(this);
                } else if (diffX < 0 && isExpanded) {
                    // Swipe left - collapse
                    collapseCategory(this);
                }
            }
            
            touchStartX = 0;
            touchStartY = 0;
        }, { passive: true });
    });
});