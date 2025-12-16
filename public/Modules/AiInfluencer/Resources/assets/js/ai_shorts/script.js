'use script';

$('.AdavanceOption').on('click', function() {
    if ($('#ProviderOptionDiv').attr('class') == 'hidden') {
        hideProviderOptions()
        $('.' + $('#provider option:selected').val() + '_div').removeClass('hidden');
        $('#ProviderOptionDiv').removeClass('hidden');
    } else {
        $('#ProviderOptionDiv').addClass('hidden');
    }
});


$('#provider').on('change', function() {
    hideProviderOptions();
    $('.' + $(this).val() + '_div').removeClass('hidden');
});


function hideProviderOptions() 
{
    $('.ProviderOptions').each(function() {
        $(this).addClass('hidden')
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const fileContainer = document.getElementById("imgFile-container");
    const fileUploadContainer = document.getElementById("file-upload-container");
    const errorMessage = document.getElementById("error-message");
    const fileInput = document.getElementById("file_input");

    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");

        dropZoneElement.addEventListener("click", () => inputElement.click());

        inputElement.addEventListener("change", () => handleFiles(inputElement.files));

        dropZoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZoneElement.classList.add("drop-zone--over");
        });

        ["dragleave", "dragend"].forEach(type => {
            dropZoneElement.addEventListener(type, () => dropZoneElement.classList.remove("drop-zone--over"));
        });

        dropZoneElement.addEventListener("drop", (e) => {
            e.preventDefault();
            dropZoneElement.classList.remove("drop-zone--over");

            if (e.dataTransfer.files.length) {
                handleFiles(e.dataTransfer.files);
                const fileList = new DataTransfer();
                for (let file of e.dataTransfer.files) {
                    fileList.items.add(file);
                }
                fileInput.files = fileList.files;
            }
        });
    });

    function handleFiles(files) {
        const validFiles = Array.from(files).filter((file) => {
            const ext = getFileExtension(file.name);
            return isAllowedExtension(ext);
        });

        if (validFiles.length === 0) {
            displayError(jsLang("Invalid file type. Only mp4, webm, ogg, avi, mov, wmv, flv and mkv are allowed."));
            return;
        }

        errorMessage.classList.add("hidden");

        validFiles.forEach(file => {
            const ext = getFileExtension(file.name);
            if (["mp4", "webm", "ogg", "avi", "mov", "wmv", "flv", "mkv"].includes(ext)) {
                addFileToContainer(file, 'video');
                fileUploadContainer.classList.add("hidden");
                const imgFileContainer = $('#imgFile-container');

                if (imgFileContainer && imgFileContainer.children.length > 0) {
                    $('#linkInput').attr('disabled', 'disabled');
                }
            }
        });
    }

    function addFileToContainer(file, type) {
        const fileDiv = document.createElement("div");
        fileDiv.classList.add("img-file-container");

        let mediaElement;
        const fileURL = URL.createObjectURL(file);

        if (type === 'image') {
            mediaElement = document.createElement("img");
            mediaElement.src = fileURL;
            mediaElement.classList.add("file-preview");
        } else if (type === 'video') {
            mediaElement = document.createElement("video");
            mediaElement.src = fileURL;
            mediaElement.controls = true;
            mediaElement.classList.add("file-preview");
        }

        const closeButton = document.createElement("button");
        closeButton.innerHTML = `<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2.25C6 1.83579 6.33579 1.5 6.75 1.5H11.25C11.6642 1.5 12 1.83579 12 2.25C12 2.66421 11.6642 3 11.25 3H6.75C6.33579 3 6 2.66421 6 2.25ZM3.74418 3.75H2.25C1.83579 3.75 1.5 4.08579 1.5 4.5C1.5 4.91421 1.83579 5.25 2.25 5.25H3.04834L3.52961 12.4691C3.56737 13.0357 3.59862 13.5045 3.65465 13.8862C3.71299 14.2835 3.80554 14.6466 3.99832 14.985C4.29842 15.5118 4.75109 15.9353 5.29667 16.1997C5.64714 16.3695 6.0156 16.4377 6.41594 16.4695C6.80046 16.5 7.27037 16.5 7.8382 16.5H10.1618C10.7296 16.5 11.1995 16.5 11.5841 16.4695C11.9844 16.4377 12.3529 16.3695 12.7033 16.1997C13.2489 15.9353 13.7016 15.5118 14.0017 14.985C14.1945 14.6466 14.287 14.2835 14.3453 13.8862C14.4014 13.5045 14.4326 13.0356 14.4704 12.469L14.9517 5.25H15.75C16.1642 5.25 16.5 4.91421 16.5 4.5C16.5 4.08579 16.1642 3.75 15.75 3.75H14.2558C14.2514 3.74996 14.2471 3.74996 14.2427 3.75H3.75731C3.75294 3.74996 3.74857 3.74996 3.74418 3.75ZM13.4483 5.25H4.55166L5.0243 12.3396C5.06455 12.9433 5.09238 13.3525 5.13874 13.6683C5.18377 13.9749 5.23878 14.1321 5.30166 14.2425C5.45171 14.5059 5.67804 14.7176 5.95083 14.8498C6.06513 14.9052 6.22564 14.9497 6.53464 14.9742C6.85277 14.9995 7.26289 15 7.86799 15H10.132C10.7371 15 11.1472 14.9995 11.4654 14.9742C11.7744 14.9497 11.9349 14.9052 12.0492 14.8498C12.322 14.7176 12.5483 14.5059 12.6983 14.2425C12.7612 14.1321 12.8162 13.9749 12.8613 13.6683C12.9076 13.3525 12.9354 12.9433 12.9757 12.3396L13.4483 5.25ZM7.5 7.125C7.91421 7.125 8.25 7.46079 8.25 7.875V11.625C8.25 12.0392 7.91421 12.375 7.5 12.375C7.08579 12.375 6.75 12.0392 6.75 11.625V7.875C6.75 7.46079 7.08579 7.125 7.5 7.125ZM10.5 7.125C10.9142 7.125 11.25 7.46079 11.25 7.875V11.625C11.25 12.0392 10.9142 12.375 10.5 12.375C10.0858 12.375 9.75 12.0392 9.75 11.625V7.875C9.75 7.46079 10.0858 7.125 10.5 7.125Z" fill="white"/>
            </svg>`;
        closeButton.classList.add("imgClose-button");

        closeButton.addEventListener("click", () => {
            fileDiv.remove();
            const newFileList = new DataTransfer();
            fileInput.files = newFileList.files;
            fileUploadContainer.classList.remove("hidden");
            $('#linkInput').removeAttr('disabled');
        });

        fileDiv.appendChild(mediaElement);
        fileDiv.appendChild(closeButton);
        fileContainer.appendChild(fileDiv);
    }

    function getFileExtension(fileName) {
        return fileName.split(".").pop().toLowerCase();
    }

    function isAllowedExtension(ext) {
        return ["mp4", "webm", "ogg", "avi", "mov", "wmv", "flv", "mkv"].includes(ext);
    }

    function displayError(message) {
        errorMessage.textContent = message;
        errorMessage.classList.remove("hidden");
    }
});

$('#linkInput').on('input', function () {
    const inputValue = $(this).val().trim();

    if (inputValue !== '') {
        // Disable file input
        $('#file_input').prop('disabled', true);
        $('.drop-zone').addClass('opacity-50 pointer-events-none');
    } else {
        // Enable file input
        $('#file_input').prop('disabled', false);
        $('.drop-zone').removeClass('opacity-50 pointer-events-none');
    }
});

$(document).on("click", ".modal-toggle", function (e) {
  e.preventDefault();
  $('.index-modal').toggleClass('is-visibl');
});

document.querySelectorAll('.inputProgress').forEach(progressBar => {
    const container = progressBar.closest('.progress-container');
    const spanElement = container.querySelector('.img-strength');

    if (!spanElement) return; // Skip if no span found

    const min = parseFloat(progressBar.min);
    const max = parseFloat(progressBar.max);

    function updateUI(value) {
        const percentage = ((value - min) / (max - min)) * 100;
        progressBar.style.background = `linear-gradient(to right, #763CD4 0%, #763CD4 ${percentage}%, #DFDFDF ${percentage}%, #DFDFDF 100%)`;
        spanElement.textContent = value.toFixed(1);
    }

    // Initial update
    updateUI(parseFloat(progressBar.value));

    // On input
    progressBar.addEventListener('input', () => {
        updateUI(parseFloat(progressBar.value));
    });
});


$('#provider').on('change', function() {
    hideProviderOptions();
    $('.' + $(this).val() + '_div').removeClass('hidden');
})

$(document).on('submit', '#aishorts-form', function (e) {
    e.preventDefault();

    const formData = new FormData();
    const provider = $('#provider').val();

    $(this).serializeArray().forEach(function(field) {
        let name = field.name.trim();
        if (['prompt', 'provider'].includes(name)) {
            formData.append(name, field.value);
        } else if (name.startsWith(`${provider}[`)) {
            const matches = name.match(new RegExp(`^${provider}\\[(.+?)\\](\\[\\])?$`));
            if (matches) {
                const key = matches[1];
                const isArray = !!matches[2];
                formData.append(`options[${key}]${isArray ? '[]' : ''}`, field.value);
            }
        }
    });

    const file = $('#file_input')[0].files[0];
    const url = $('#linkInput').val();

    if (file) formData.append('options[file]', file);
    if (url) formData.append('options[url]', url);


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        url: PROMPT_URL,
        type: "POST",
        beforeSend: function (xhr) {
            $(".loader-video").removeClass('hidden');
            $('#aishorts-creation').attr('disabled', 'disabled');
            xhr.setRequestHeader('Authorization', 'Bearer ' + ACCESS_TOKEN);
        },
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        success: function(response) {
            if (response.message) {
                errorMessage(response.message, 'aishorts-creation');
                return true;
            }

            $("#aishorts-form .loader").addClass('hidden');

            
            $(".loader").addClass('hidden');
            $('#aishorts-creation').removeAttr('disabled');

            var video = '';

            $.each(response.data.videos, function(key, value) {
                video += 
                `<div class="cursor-pointer mb-1" id="image_${value.id}">
                    <div class="relative">
                        <div class="video-container videos-container">
                            <video class="object-cover rounded-lg myVideo">
                                    <source src="${value.file_name}" type="video/mp4">
                            </video>
                            <div class="custom-controls">
                                <button class="custom-play-pause playPauseBtn md:p-5 p-2">
                                    <!-- Play SVG Icon -->
                                    <svg class="playIcon neg-transition-scale w-[30px] h-[30px]" width="40" height="40"
                                        viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.44906 7.93287C9.49374 7.55428 9.62621 7.19135 9.83592 6.873C10.0456 6.55464 10.3268 6.28965 10.657 6.09914C10.9872 5.90863 11.3573 5.79786 11.7379 5.77564C12.1184 5.75343 12.4989 5.8204 12.8491 5.9712C14.6191 6.72787 18.5857 8.5262 23.6191 11.4312C28.6541 14.3379 32.1957 16.8762 33.7341 18.0279C35.0474 19.0129 35.0507 20.9662 33.7357 21.9545C32.2124 23.0995 28.7141 25.6045 23.6191 28.5479C18.5191 31.4912 14.5991 33.2679 12.8457 34.0145C11.3357 34.6595 9.64573 33.6812 9.44906 32.0529C9.21906 30.1495 8.78906 25.8279 8.78906 19.9912C8.78906 14.1579 9.2174 9.83787 9.44906 7.93287Z"
                                            fill="white" />
                                    </svg>
                                    <!-- Pause SVG Icon -->
                                    <svg class="pauseIcon neg-transition-scale w-[30px] h-[30px]" width="40" height="40"
                                        viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        style="display: none;">
                                        <path
                                            d="M13.334 4.16699H10.0007C7.69946 4.16699 5.83398 6.03247 5.83398 8.33366V31.667C5.83398 33.9682 7.69946 35.8337 10.0007 35.8337H13.334C15.6352 35.8337 17.5007 33.9682 17.5007 31.667V8.33366C17.5007 6.03247 15.6352 4.16699 13.334 4.16699Z"
                                            fill="white" />
                                        <path
                                            d="M30 4.16699H26.6667C24.3655 4.16699 22.5 6.03247 22.5 8.33366V31.667C22.5 33.9682 24.3655 35.8337 26.6667 35.8337H30C32.3012 35.8337 34.1667 33.9682 34.1667 31.667V8.33366C34.1667 6.03247 32.3012 4.16699 30 4.16699Z"
                                            fill="white" />
                                    </svg>
                                </button>
                            </div>
                            <div class="progress-container" id="progressContainer">
                                <div class="progress-video-bar" id="progressBar"></div>
                            </div>
                        </div>
                        <div class="absolute top-0">
                            <a href="javascript: void(0)" id="${value.id}" type="aishorts"
                                class="mt-3 ltr:ml-3 rounded-lg rtl:mr-3 relative w-[34px] h-[34px] flex items-center m-auto justify-center delete-image-bg border border-color-47 modal-toggle image-tooltip-delete gallery-dlt">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5 1.25C5 0.835786 5.33579 0.5 5.75 0.5H10.25C10.6642 0.5 11 0.835786 11 1.25C11 1.66421 10.6642 2 10.25 2H5.75C5.33579 2 5 1.66421 5 1.25ZM2.74418 2.75H1.25C0.835786 2.75 0.5 3.08579 0.5 3.5C0.5 3.91421 0.835786 4.25 1.25 4.25H2.04834L2.52961 11.4691C2.56737 12.0357 2.59862 12.5045 2.65465 12.8862C2.71299 13.2835 2.80554 13.6466 2.99832 13.985C3.29842 14.5118 3.75109 14.9353 4.29667 15.1997C4.64714 15.3695 5.0156 15.4377 5.41594 15.4695C5.80046 15.5 6.27037 15.5 6.8382 15.5H9.1618C9.72963 15.5 10.1995 15.5 10.5841 15.4695C10.9844 15.4377 11.3529 15.3695 11.7033 15.1997C12.2489 14.9353 12.7016 14.5118 13.0017 13.985C13.1945 13.6466 13.287 13.2835 13.3453 12.8862C13.4014 12.5045 13.4326 12.0356 13.4704 11.469L13.9517 4.25H14.75C15.1642 4.25 15.5 3.91421 15.5 3.5C15.5 3.08579 15.1642 2.75 14.75 2.75H13.2558C13.2514 2.74996 13.2471 2.74996 13.2427 2.75H2.75731C2.75294 2.74996 2.74857 2.74996 2.74418 2.75ZM12.4483 4.25H3.55166L4.0243 11.3396C4.06455 11.9433 4.09238 12.3525 4.13874 12.6683C4.18377 12.9749 4.23878 13.1321 4.30166 13.2425C4.45171 13.5059 4.67804 13.7176 4.95083 13.8498C5.06513 13.9052 5.22564 13.9497 5.53464 13.9742C5.85277 13.9995 6.26289 14 6.86799 14H9.13201C9.73711 14 10.1472 13.9995 10.4654 13.9742C10.7744 13.9497 10.9349 13.9052 11.0492 13.8498C11.322 13.7176 11.5483 13.5059 11.6983 13.2425C11.7612 13.1321 11.8162 12.9749 11.8613 12.6683C11.9076 12.3525 11.9354 11.9433 11.9757 11.3396L12.4483 4.25ZM6.5 6.125C6.91421 6.125 7.25 6.46079 7.25 6.875V10.625C7.25 11.0392 6.91421 11.375 6.5 11.375C6.08579 11.375 5.75 11.0392 5.75 10.625V6.875C5.75 6.46079 6.08579 6.125 6.5 6.125ZM9.5 6.125C9.91421 6.125 10.25 6.46079 10.25 6.875V10.625C10.25 11.0392 9.91421 11.375 9.5 11.375C9.08579 11.375 8.75 11.0392 8.75 10.625V6.875C8.75 6.46079 9.08579 6.125 9.5 6.125Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </div>
                        <div class="absolute top-0 ltr:right-3 rtl:left-3">
                            <div class="flex justify-end items-center gap-2 mt-3 ltr:ml-3 rtl:mr-3">
                                <a class="file-need-download relative w-[34px] h-[34px] flex items-center m-auto justify-center rounded-lg border border-color-47 image-tooltip-download delete-image-bg"
                                    href="${value.file_name}" download="${value.title}">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9 2.25C9.41421 2.25 9.75 2.58579 9.75 3V10.1893L12.2197 7.71967C12.5126 7.42678 12.9874 7.42678 13.2803 7.71967C13.5732 8.01256 13.5732 8.48744 13.2803 8.78033L9.53033 12.5303C9.23744 12.8232 8.76256 12.8232 8.46967 12.5303L4.71967 8.78033C4.42678 8.48744 4.42678 8.01256 4.71967 7.71967C5.01256 7.42678 5.48744 7.42678 5.78033 7.71967L8.25 10.1893V3C8.25 2.58579 8.58579 2.25 9 2.25ZM3 12C3.41421 12 3.75 12.3358 3.75 12.75V14.25C3.75 14.4489 3.82902 14.6397 3.96967 14.7803C4.11032 14.921 4.30109 15 4.5 15H13.5C13.6989 15 13.8897 14.921 14.0303 14.7803C14.171 14.6397 14.25 14.4489 14.25 14.25V12.75C14.25 12.3358 14.5858 12 15 12C15.4142 12 15.75 12.3358 15.75 12.75V14.25C15.75 14.8467 15.5129 15.419 15.091 15.841C14.669 16.2629 14.0967 16.5 13.5 16.5H4.5C3.90326 16.5 3.33097 16.2629 2.90901 15.841C2.48705 15.419 2.25 14.8467 2.25 14.25V12.75C2.25 12.3358 2.58579 12 3 12Z"
                                            fill="#F3F3F3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
            });

            $('#ai-shorts-gallery').prepend(video);

            var credit = $('.video-credit-remaining');
            
            if (!isNaN(credit.text()) && response.data.subscription.reduce == 'subscription') {
                credit.text(response.data.subscription.remain);
            }

            const newVideos = $('#ai-shorts-gallery .cursor-pointer')
                .slice(0, response.data.videos.length)
                .find('.myVideo')
                .toArray();

            if (newVideos.length) {
                initializeCustomVideoPlayer(newVideos);
            }
            
            toastMixin.fire({
                title: jsLang('Video generated successfully.'),
                icon: 'success'
            });

        },
        complete: () => {
            $(".loader-video").addClass('hidden');
            $("#aishorts-creation").removeAttr('disabled');
        },
        error: function(response) {
            let jsonData;

            try {
                jsonData = JSON.parse(response.responseText);
            } catch (e) {
                errorMessage(jsLang('Invalid server response'), 'aishorts-creation');
                return true;
            }

            const message = 
                jsonData?.error ||
                jsonData?.message ||
                (jsonData?.records?.length === 0 && jsonData?.response?.status?.message) ||
                jsonData?.data?.response ||
                jsonData?.response?.status?.message;

            if (message) {
                errorMessage(message, 'aishorts-creation');
                return true;
            }
        }

    });
});

let currentlyPlayingVideo = null;
function initializeCustomVideoPlayer(videos) {
    videos.forEach(video => {
        const playPauseBtn = video.parentNode.querySelector('.playPauseBtn');
        const playIcon = video.parentNode.querySelector('.playIcon');
        const pauseIcon = video.parentNode.querySelector('.pauseIcon');
        const progressBar = video.parentNode.querySelector('.progress-video-bar');
        const gallery = document.getElementById('ai-shorts-gallery');
        const progressContainer = video.parentNode.querySelector('.progress-container');
        const progressBars = document.getElementById('progressInput');
        
        function updateColumnCount() {
            const progressValue = parseInt(progressBars.value);
            const minColumns = 3;
            const maxColumns = 8;
            const numColumns = Math.round(minColumns + (progressValue / 100) * (maxColumns - minColumns));
            gallery.style.setProperty('--num-columns', numColumns);

            videos.forEach(video => {
                const btn = video.parentNode.querySelector('.playPauseBtn');
                if (numColumns > 4) {
                    btn.style.display = 'none';
                    video.style.cursor = 'pointer';
                } else {
                   
                    btn.style.display = 'block';
                    video.style.cursor = 'default';
                }
            });
        }

        if (progressBars) {
            progressBars.addEventListener('input', updateColumnCount);
            function updateSliderBackground() {
                const min = parseFloat(progressBars.min);
                const max = parseFloat(progressBars.max);
                const value = parseFloat(progressBars.value);
                const percentage = ((value - min) / (max - min) * 100).toFixed(2);
                progressBars.style.background = `linear-gradient(to right, #898989 0%, #898989 ${percentage}%, #DFDFDF ${percentage}%, #DFDFDF 100%)`;
            }

            updateSliderBackground();
            progressBars.oninput = function () {
                updateSliderBackground();
                updateColumnCount();
            };
        }
        playPauseBtn.addEventListener('click', () => {
            if (currentlyPlayingVideo && currentlyPlayingVideo !== video) {
                currentlyPlayingVideo.pause();
                currentlyPlayingVideo.parentNode.querySelector('.playIcon').style.display = 'block';
                currentlyPlayingVideo.parentNode.querySelector('.pauseIcon').style.display = 'none';
            }

            if (video.paused) {
                video.play();
                playIcon.style.display = 'none';
                pauseIcon.style.display = 'block';
                currentlyPlayingVideo = video;
            } else {
                video.pause();
                playIcon.style.display = 'block';
                pauseIcon.style.display = 'none';
                currentlyPlayingVideo = null;
            }
        });
        video.addEventListener('timeupdate', () => {
            const progress = (video.currentTime / video.duration) * 100;
            progressBar.style.width = `${progress}%`;
        });
        progressContainer.addEventListener('click', (event) => {
            const rect = progressContainer.getBoundingClientRect();
            const offsetX = event.clientX - rect.left;
        
            if (rect.width > 0 && !isNaN(video.duration)) {
                const newTime = (offsetX / rect.width) * video.duration;
                video.currentTime = Math.min(Math.max(newTime, 0), video.duration);
            }
        });
        
        video.addEventListener('ended', () => {
            playIcon.style.display = 'block';
            pauseIcon.style.display = 'none';
            currentlyPlayingVideo = null;
        });
        video.addEventListener('click', function() {
            if (parseInt(gallery.style.getPropertyValue('--num-columns')) > 4) {
                if (video.paused) {
                    videos.forEach(v => {
                        v.pause();
                        v.parentNode.querySelector('.playIcon').style.display = 'block';
                        v.parentNode.querySelector('.pauseIcon').style.display = 'none';
                    });
                    video.play();
                    playIcon.style.display = 'none';
                    pauseIcon.style.display = 'block';
                } else {
                    video.pause();
                    playIcon.style.display = 'block';
                    pauseIcon.style.display = 'none';
                }
            }
        });

    });
}