"use strict";

document.addEventListener("DOMContentLoaded", () => {
	// =========================
	// Inbox
	// =========================
	function toggleInbox() {
		const inbox = document.getElementById("inbox");
		const arrow = document.getElementById("inboxArrow");
		inbox.classList.toggle("hidden");
		arrow.classList.toggle("rotate-180");
	}

	window.toggleInbox = toggleInbox;

	// =========================
	// Sidebar
	// =========================
	function toggleMenu(id, btn) {
		const submenu = document.getElementById(id);
		const arrow = document.getElementById("arrow-" + id.split("-")[1]);

		// Close all other submenus
		document.querySelectorAll(".submenu").forEach((el) => {
			if (el.id !== id) {
				el.classList.add("hidden");
				const otherArrow = document.getElementById(
					"arrow-" + el.id.split("-")[1]
				);
				if (otherArrow) otherArrow.classList.remove("rotate-180");
			}
		});
		document.querySelectorAll(".menu-btn").forEach((el) => {
			el.classList.remove("bg-white", "dark:bg-color-47");
		});

		// Toggle clicked submenu
		if (submenu.classList.contains("hidden")) {
			submenu.classList.remove("hidden");
			arrow.classList.add("rotate-180");
			btn.classList.add("bg-white", "dark:bg-color-47");
		} else {
			submenu.classList.add("hidden");
			arrow.classList.remove("rotate-180");
			btn.classList.remove("bg-white", "dark:bg-color-47");
		}
	}

	window.toggleMenu = toggleMenu;

	const isRTL = document.documentElement.getAttribute("dir") === "rtl";
	const sidebar = document.getElementById("sidebar");
	setTimeout(() => {
		sidebar.classList.remove("invisible");
	}, 150);

	isRTL
		? sidebar.classList.remove("-translate-x-full")
		: sidebar.classList.remove("translate-x-full");
	
	function toggleSidebar(open) {
		const mobileMenuBtn = document.getElementById("mobile-menu-btn");
		const overlay = document.getElementById("sidebar-overlay");
		
		if (open) {
			if (isRTL) {
				sidebar.classList.remove("translate-x-full");
				sidebar.classList.remove("-translate-x-full");
			} else {
				sidebar.classList.remove("-translate-x-full");
				sidebar.classList.remove("translate-x-full");
			}
			overlay.classList.remove("hidden");
			mobileMenuBtn.classList.add("invisible");
		} else {
			if (isRTL) {
				sidebar.classList.add("translate-x-full");
			} else {
				sidebar.classList.add("-translate-x-full");
			}
			overlay.classList.add("hidden");
			mobileMenuBtn.classList.remove("invisible");
		}
	}

	window.toggleSidebar = toggleSidebar;

	// =========================
	// Custom Select / Dropdown
	// =========================
	document.querySelectorAll(".custom-select").forEach((select) => {
		const btn = select.querySelector(".select-btn");
		const menu = select.querySelector(".select-menu");
		const selected = select.querySelector(".selected-option");

		btn.addEventListener("click", () => {
			// Close other selects first
			document.querySelectorAll(".select-menu").forEach((m) => {
				if (m !== menu) m.classList.add("hidden");
			});
			menu.classList.toggle("hidden");
		});

		menu.querySelectorAll("li").forEach((item) => {
			item.addEventListener("click", () => {
				selected.textContent = item.textContent;
				menu.classList.add("hidden");
			});
		});
	});

	// Close dropdowns when clicking outside
	document.addEventListener("click", (e) => {
		document.querySelectorAll(".custom-select").forEach((select) => {
			if (!select.contains(e.target)) {
				select.querySelector(".select-menu").classList.add("hidden");
			}
		});
	});

	// =========================
	// Schedule Toggle
	// =========================
	const scheduleToggle = document.getElementById("scheduleToggle");
	const scheduleOptions = document.getElementById("scheduleOptions");

	if (scheduleToggle && scheduleOptions) {
		scheduleToggle.addEventListener("change", function () {
			if (this.checked) {
				scheduleOptions.classList.remove("hidden");
			} else {
				scheduleOptions.classList.add("hidden");
			}
		});
	}

	const aiReplyToggle = document.getElementById("aiReplyToggle");
	const aiReplyOptions = document.getElementById("aiReplyOptions");

	if (aiReplyToggle && aiReplyOptions) {
		aiReplyToggle.addEventListener("change", function () {
			if (this.checked) {
				aiReplyOptions.classList.remove("hidden");
			} else {
				aiReplyOptions.classList.add("hidden");
			}
		});
	}

	// =========================
	// Live Preview Functionality
	// =========================
	const contentTextarea = document.getElementById("contentTextarea") || document.querySelector("textarea");
	const previewText = document.getElementById("previewText");

	if (contentTextarea && previewText) {
		const defaultText = "This is what your campaign will look like.";

		// update function
		const updatePreview = () => {
			const text = contentTextarea.value.trim();
			if (text) {
				// escape HTML and keep line breaks
				const escaped = text
					.replace(/&/g, "&amp;")
					.replace(/</g, "&lt;")
					.replace(/>/g, "&gt;");
				previewText.innerHTML = escaped.replace(/\r?\n/g, "<br>");
			} else {
				previewText.textContent = defaultText;
			}
		};

		// initialize preview with default text
		previewText.textContent = defaultText;

		// update on user input
		contentTextarea.addEventListener("input", updatePreview);
	}

	const fileInput = document.getElementById("imageUpload");
    const previewImg = document.getElementById("previewImg");
    const uploadLabel = document.getElementById("uploadLabel");
    const deleteImg = document.getElementById("deleteImg");
    const previewImgSec = document.getElementById("previewImgSection");
 
    if (fileInput && previewImg && deleteImg && uploadLabel && previewImgSec) {
        fileInput.addEventListener("change", (event) => {
            const file = event.target.files[0];

			if (file && file.type && file.type.startsWith("image/")) {
				const reader = new FileReader();
				reader.onload = (e) => {
					previewImgSec.src = e.target.result;
					previewImgSec.classList.remove("hidden");
					previewImg.src = e.target.result;
					previewImg.classList.remove("hidden");
					deleteImg.classList.remove("hidden");
					uploadLabel.classList.add("hidden"); // Hide label when image shows
				};
				reader.readAsDataURL(file);
			}
		});
 
        // Delete/reset image
        deleteImg.addEventListener("click", () => {
            previewImgSec.src = "";
            previewImgSec.classList.add("hidden");
            previewImg.src = "";
            previewImg.classList.add("hidden");
            deleteImg.classList.add("hidden");
            uploadLabel.classList.remove("hidden"); // Show label again
            fileInput.value = ""; // Reset input
        });
    }


	// =========================
	// Modal Functionality
	// =========================
	function closeFn(modal, modalBox) {
		modal.classList.remove("opacity-100");
		modalBox.classList.remove("scale-100", "opacity-100");
		modalBox.classList.add("scale-0", "opacity-0");
		setTimeout(() => {
			modal.classList.add("hidden");
		}, 300);
	}

	function openModal(btn) {
		const modalId = btn.getAttribute("data-target");
		const modal = document.getElementById(modalId);
		if (!modal) return;
		const modalBox = modal.querySelector(".modalBox");

		modal.classList.remove("hidden");
		setTimeout(() => {
			modal.classList.add("opacity-100");
			modalBox.classList.remove("scale-0", "opacity-0");
			modalBox.classList.add("scale-100", "opacity-100");
		}, 10);

		// Close on outside click - remove existing listener and add new one
		const handleOutsideClick = (e) => {
			if (e.target === modal) {
				closeFn(modal, modalBox);
				modal.removeEventListener("click", handleOutsideClick);
			}
		};
		modal.addEventListener("click", handleOutsideClick);
	}

	// Use event delegation to handle dynamically added modal buttons
	document.addEventListener("click", function(event) {
		const target = event.target;
		if (!target) return;

		// Check if clicked element is an open modal button or inside one
		const openBtn = target.closest(".openModalBtn");
		if (openBtn) {
			event.preventDefault();
			event.stopPropagation();
			openModal(openBtn);
			return;
		}

		// Check if clicked element is a close modal button or inside one
		const closeBtn = target.closest(".closeModalBtn");
		if (closeBtn) {
			event.preventDefault();
			event.stopPropagation();
			const modal = closeBtn.closest(".sweet-modal");
			if (modal) {
				const modalBox = modal.querySelector(".modalBox");
				closeFn(modal, modalBox);
			}
			return;
		}
	});


	// =========================
	// Chat Drawer Functionality
	// =========================
	let chatDrawerInitialized = false;
	
	function openChatDrawer() {
		const chatDrawer = document.getElementById("chatDrawer");
		const chatDrawerOverlay = document.getElementById("chatDrawerOverlay");
		
		if (chatDrawer) {
			chatDrawer.classList.remove("translate-x-full");
		}
		if (chatDrawerOverlay) {
			chatDrawerOverlay.classList.remove("hidden");
		}
	}

	function closeChatDrawer() {
		const chatDrawer = document.getElementById("chatDrawer");
		const chatDrawerOverlay = document.getElementById("chatDrawerOverlay");
		
		if (chatDrawer) {
			chatDrawer.classList.add("translate-x-full");
		}
		if (chatDrawerOverlay) {
			chatDrawerOverlay.classList.add("hidden");
		}
	}

	function initializeChatDrawer() {
		// Only initialize once using event delegation
		// Event delegation automatically works for dynamically inserted elements
		if (chatDrawerInitialized) {
			return;
		}
		
		chatDrawerInitialized = true;
		
		// Use event delegation on document to handle dynamically inserted elements
		// This is more robust than attaching listeners directly to elements
		document.addEventListener("click", function(event) {
			const target = event.target;
			if (!target) return;
			
			// Check if clicked element is the profile image
			if (target.id === "chatProfileImg") {
				event.preventDefault();
				event.stopPropagation();
				openChatDrawer();
				return;
			}
			
			// Check if clicked element is inside the profile image
			const profileImg = target.closest("#chatProfileImg");
			if (profileImg) {
				event.preventDefault();
				event.stopPropagation();
				openChatDrawer();
				return;
			}
			
			// Check if clicked element is the close button
			if (target.id === "closeChatDrawer") {
				event.preventDefault();
				event.stopPropagation();
				closeChatDrawer();
				return;
			}
			
			// Check if clicked element is inside the close button
			const closeBtn = target.closest("#closeChatDrawer");
			if (closeBtn) {
				event.preventDefault();
				event.stopPropagation();
				closeChatDrawer();
				return;
			}
			
			// Check if clicked element is the overlay
			if (target.id === "chatDrawerOverlay") {
				event.preventDefault();
				event.stopPropagation();
				closeChatDrawer();
				return;
			}
		});
	}

	// Initialize on page load
	initializeChatDrawer();

	// Expose functions globally
	window.openChatDrawer = openChatDrawer;
	window.closeChatDrawer = closeChatDrawer;
	window.initializeChatDrawer = initializeChatDrawer;

});

$('.voice-type-dropdown').on("click", function(event) {
	event.stopPropagation();
	const $dropdownContent = $(this).closest('.relative').find('.voice-dropdown-content');
	$dropdownContent.slideToggle(200);
	$('.voice-dropdown-content').not($dropdownContent).slideUp(200);
	$('.dropdown-menu').addClass('!hidden');
});

$(document).on("click", function(event) {
	if (!$(event.target).closest('.voice-type-dropdown').length) {
		$('.voice-dropdown-content').slideUp(200);
		$('.dropdown-menu').removeClass('!hidden');
	}
});

const modalStates = new Map();
let initialized = false;

// Modal Utilities
const modalUtils = {
    openModal: function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
			// Clear any pending close timeout
            if (modalStates.has(modalId)) {
                clearTimeout(modalStates.get(modalId));
            }

            modal.classList.remove('hidden');
            const timeoutId = setTimeout(() => {
                modal.classList.add('opacity-100');
                const modalBox = modal.querySelector('.modalBox');
				if (modalBox) {
					modalBox.classList.add('opacity-100', 'scale-100');
				}
				modalStates.delete(modalId);
            }, 50);
			modalStates.set(modalId, timeoutId);
        }
    },

    closeModal: function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            // Clear any pending open timeout
            if (modalStates.has(modalId)) {
                clearTimeout(modalStates.get(modalId));
            }
            modal.classList.remove('opacity-100');
            const modalBox = modal.querySelector('.modalBox');
			if (modalBox) {
				modalBox.classList.remove('opacity-100', 'scale-100');
			}
            const timeoutId = setTimeout(() => {
                modal.classList.add('hidden');
				modalStates.delete(modalId);
            }, 300);
			modalStates.set(modalId, timeoutId);
        }
    },

    init: function() {
		// Prevent duplicate initialization
		if (initialized) return;
		initialized = true;
        
		// Use event delegation for open buttons
        document.addEventListener('click', (e) => {
            const button = e.target.closest('.openModalBtn');
            if (button) {
                e.preventDefault();
                const modalId = button.getAttribute('data-target');
                if (modalId) {
                    this.openModal(modalId);
                }
            }
        });

        // Use event delegation for close buttons
        document.addEventListener('click', (e) => {
            const button = e.target.closest('.closeModalBtn');
            if (button) {
                const modal = button.closest('.sweet-modal');
                if (modal) {
                    this.closeModal(modal.id);
                }
            }
        });

        // Use event delegation for outside clicks
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('sweet-modal')) {
                this.closeModal(e.target.id);
            }
        });

        // Close modal on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const visibleModal = document.querySelector('.sweet-modal:not(.hidden)');
                if (visibleModal) {
                    this.closeModal(visibleModal.id);
                }
            }
        });
    }
};

// Initialize modal functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    modalUtils.init();
});

// Export modal utilities globally
window.modalUtils = modalUtils;
window.closeModal = modalUtils.closeModal.bind(modalUtils);
window.openModal = modalUtils.openModal.bind(modalUtils);

