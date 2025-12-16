// Segments Skeleton Loading Functions
function showSkeletonLoaders() {
    // Show table skeleton
    const tableSkeletonElements = document.querySelectorAll('.table-skeleton');
    const tableContentElements = document.querySelectorAll('.table-content');

    tableSkeletonElements.forEach(skeleton => skeleton.classList.remove('hidden'));
    tableContentElements.forEach(content => content.classList.add('hidden'));
}

function hideSkeletonLoaders() {
    // Hide table skeleton
    const tableSkeletonElements = document.querySelectorAll('.table-skeleton');
    const tableContentElements = document.querySelectorAll('.table-content');

    tableSkeletonElements.forEach(skeleton => skeleton.classList.add('hidden'));
    tableContentElements.forEach(content => content.classList.remove('hidden'));
}

// Auto-initialize skeleton loaders on page load
document.addEventListener('DOMContentLoaded', function() {
    // Show skeletons when DOM is ready
    showSkeletonLoaders();

    // Function to hide skeletons and show content
    function hideSkeletons() {
        const tableSkeletonElements = document.querySelectorAll('.table-skeleton');
        const tableContentElements = document.querySelectorAll('.table-content');

        tableSkeletonElements.forEach(e => e.classList.add('hidden'));
        tableContentElements.forEach(e => e.classList.remove('hidden'));
    }

    // Check if content is already loaded (server-side rendered)
    const tableContentElements = document.querySelectorAll('.table-content');
    if (tableContentElements.length > 0) {
        // Content is already loaded, hide skeletons immediately
        setTimeout(hideSkeletons, 200);
        return;
    }

    // Watch for when segments table content is loaded (the section element)
    const elementsToWatch = ['section.rounded-xl.bg-white.dark\\:bg-color-3A'];
    let loadedCount = 0;

    elementsToWatch.forEach(selector => {
        const element = document.querySelector(selector);
        if (element) {
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                        loadedCount++;
                        if (loadedCount >= elementsToWatch.length) {
                            setTimeout(hideSkeletons, 200);
                            observer.disconnect();
                        }
                    }
                });
            });

            observer.observe(element, { childList: true, subtree: true });
        }
    });

    // Fallback timeout (same as dashboard - 2 seconds)
    setTimeout(hideSkeletons, 2000);
});

// Export functions for global use
window.segmentsSkeleton = {
    show: showSkeletonLoaders,
    hide: hideSkeletonLoaders
};
