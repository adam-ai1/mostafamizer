// Campaign Skeleton Loading Functions
function showSkeletonLoaders() {
    // Show KPI cards skeleton
    const kpiCards = document.getElementById('kpi-cards');
    const kpiSkeleton = document.getElementById('kpi-cards-skeleton');
    if (kpiCards && kpiSkeleton) {
        kpiCards.classList.add('hidden');
        kpiSkeleton.classList.remove('hidden');
    }

    // Show table skeleton
    const tableSection = document.getElementById('campaigns-table-section');
    const tableSkeleton = document.getElementById('campaigns-table-skeleton');
    if (tableSection && tableSkeleton) {
        tableSection.classList.add('hidden');
        tableSkeleton.classList.remove('hidden');
    }
}

function hideSkeletonLoaders() {
    // Hide KPI cards skeleton
    const kpiCards = document.getElementById('kpi-cards');
    const kpiSkeleton = document.getElementById('kpi-cards-skeleton');
    if (kpiCards && kpiSkeleton) {
        kpiSkeleton.classList.add('hidden');
        kpiCards.classList.remove('hidden');
    }

    // Hide table skeleton
    const tableSection = document.getElementById('campaigns-table-section');
    const tableSkeleton = document.getElementById('campaigns-table-skeleton');
    if (tableSection && tableSkeleton) {
        tableSkeleton.classList.add('hidden');
        tableSection.classList.remove('hidden');
    }
}


// Show skeletons immediately on page load
showSkeletonLoaders();

// Auto-initialize skeleton loaders on page load
document.addEventListener('DOMContentLoaded', function() {
    // Use dashboard timing pattern - wait for content to load, then hide skeletons
    function hideSkeletons() {
        const kpiSkeletonElements = document.querySelectorAll('.kpi-cards-skeleton');
        const kpiContentElements = document.querySelectorAll('.kpi-cards-content');
        const tableSkeletonElements = document.querySelectorAll('.table-skeleton');
        const tableContentElements = document.querySelectorAll('.table-content');

        kpiSkeletonElements.forEach(e => e.classList.add('hidden'));
        kpiContentElements.forEach(e => e.classList.remove('hidden'));
        tableSkeletonElements.forEach(e => e.classList.add('hidden'));
        tableContentElements.forEach(e => e.classList.remove('hidden'));
    }

    // Check if content is already loaded (server-side rendered)
    const kpiContentElements = document.querySelectorAll('.kpi-cards-content');
    const tableContentElements = document.querySelectorAll('.table-content');

    if (kpiContentElements.length > 0 && tableContentElements.length > 0) {
        // Content is already loaded, hide skeletons immediately
        setTimeout(hideSkeletons, 200);
        return;
    }

    // Watch for when KPI content and table content are loaded (for dynamic loading)
    const elementsToWatch = ['#kpi-cards-section', '#campaigns-table-section'];
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
window.campaignSkeleton = {
    show: showSkeletonLoaders,
    hide: hideSkeletonLoaders
};
