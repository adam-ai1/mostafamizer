"use strict";

function createCustomDropdown(dropdown) {
    const options = dropdown.querySelectorAll("option");
    const optionsArr = Array.prototype.slice.call(options);
    const customDropdown = document.createElement("div");
    customDropdown.classList.add("dropdown");
    dropdown.insertAdjacentElement("afterend", customDropdown);
    const selected = document.createElement("div");
    selected.classList.add("dropdown-select");
    const defaultOption = optionsArr.find(opt => opt.selected) || optionsArr[0];
    selected.textContent = defaultOption.textContent;
    customDropdown.appendChild(selected);
    const menu = document.createElement("div");
    menu.classList.add("dropdown-menu");
    customDropdown.appendChild(menu);
    selected.addEventListener("click", toggleDropdown.bind(menu));

    const search = document.createElement("input");
    search.placeholder = "Search...";
    search.type = "text";
    search.classList.add("dropdown-menu-search");
    menu.appendChild(search);
    const menuInnerWrapper = document.createElement("div");
    menuInnerWrapper.classList.add("dropdown-menu-inner");
    menuInnerWrapper.classList.add("sidebar-scrollbar");
    menuInnerWrapper.classList.add("voice-lists");
    menu.appendChild(menuInnerWrapper);

    optionsArr.forEach((option) => {
        const item = document.createElement("div");
        item.classList.add("dropdown-menu-item");
        item.dataset.value = option.value;
        item.dataset.audio = option.getAttribute("data-audio");
        item.textContent = option.textContent;
        menuInnerWrapper.appendChild(item);
        item.addEventListener("click", setSelected.bind(item, selected, dropdown, menu));
    });

    const selectedOption = optionsArr.find(opt => opt.selected);
    if (selectedOption) {
        const selectedIndex = optionsArr.indexOf(selectedOption);
        menuInnerWrapper.querySelectorAll("div")[selectedIndex].classList.add("is-select");
    }

    search.addEventListener("keyup", function () {
        debouncedSearch(this, '.voice-lists', 'voice');
    });

    document.addEventListener("click", closeIfClickedOutside.bind(customDropdown, menu));
    dropdown.style.display = "none";
}

function toggleDropdown() {
    this.style.display = this.offsetParent !== null ? "none" : "block";
    if (this.style.display === "block") {
        this.querySelector("input").focus();
    }
}

function setSelected(selected, dropdown, menu) {
    const value = this.dataset.value;
    const label = this.textContent;
    selected.textContent = label;
    dropdown.value = value;

    const event = new Event("change", { bubbles: true });
    dropdown.dispatchEvent(event);

    menu.style.display = "none";
    menu.querySelector("input").value = "";
    menu.querySelectorAll("div").forEach((div) => {
        div.classList.remove("is-select");
        if (div.offsetParent === null) {
            div.style.display = "block";
        }
    });
    this.classList.add("is-select");
}

function closeIfClickedOutside(menu, e) {
    if (e.target.closest(".dropdown") === null && e.target !== this && menu.offsetParent !== null) {
        menu.style.display = "none";
    }
}

// Audio Player Script
document.addEventListener("DOMContentLoaded", function () {
    const dropdowns = document.querySelectorAll(".dropdown");
    
    dropdowns.forEach((dropdown) => {
        createCustomDropdown(dropdown);
    });
    
    const select = document.querySelector(".select-audio");
    const audio = document.getElementById("audio4");
    const player = document.querySelector(".player");
    const playIcon = player.querySelector(".play");
    const pauseIcon = player.querySelector(".pause");

    function showPlayIcon() {
        if (playIcon && pauseIcon) {
            playIcon.classList.remove("!hidden");
            pauseIcon.classList.add("!hidden");
        }
    }

    function showPauseIcon() {
        if (playIcon && pauseIcon) {
            playIcon.classList.add("!hidden");
            pauseIcon.classList.remove("!hidden");
        }
    }

    function playAudio(src) {
        if (!src) {
            showPlayIcon();
            return;
        }
        audio.src = src;
        audio.load();
        audio.play().catch(() => {
            showPlayIcon();
        });
    }

    function updateAudioSource(src) {
        if (src) {
            audio.src = src;
            audio.load();
            showPlayIcon(); // Reset to play icon when source changes
        }
    }

    function initializeAudio() {
        const selectedOption = select.options[select.selectedIndex];
        const audioSrc = selectedOption?.getAttribute("data-audio");
        updateAudioSource(audioSrc);
    }

    if (select) {
        select.addEventListener("change", function () {
            const selectedOption = this.options[this.selectedIndex];
            const audioSrc = selectedOption.getAttribute("data-audio");
            updateAudioSource(audioSrc);
        });

        initializeAudio();
    }

    if (player) {
        player.addEventListener("click", function () {
            if (!audio.src || audio.src === window.location.href) {
                return;
            }
            if (audio.paused) {
                playAudio(audio.src);
            } else {
                audio.pause();
            }
        });
    }

    audio.addEventListener("play", showPauseIcon);
    audio.addEventListener("pause", showPlayIcon);
    audio.addEventListener("ended", showPlayIcon);
    audio.addEventListener("error", showPlayIcon);

    showPlayIcon();
});