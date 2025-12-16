"use strict";

let selectedFiles = [];

// Global escapeHtml function for HTML escaping
function escapeHtml(str) {
    return String(str).replace(/[&<>"']/g, function (m) {
        return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[m]);
    });
}

$(document).on('submit', '#fetch-url-form', function (e) {
    e.preventDefault();

    const form = $(this);
    const submitButton = form.find('button[type="submit"]');
    submitButton.prop('disabled', true).text(jsLang('Fetching...'));

    let fetchUrlRoute = $(this).data('url');

    $.ajax({
        url: fetchUrlRoute,
        type: 'GET',
        data: form.serialize(),
        dataType: 'JSON',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
            submitButton.find('.loader-icon').removeClass('hidden');
        },
        success: function (response) {
            if (response.data) {
                var htmlContent = fetchUrlHtml(response.data);
                $('#fetched-links-list').html(htmlContent);
                $('.fetch-content').removeClass('hidden');
                $('.total-count').text(response.data.length);
                $('.current-count').text(0);

                submitButton.find('.loader-icon').addClass('hidden');
                submitButton.prop('disabled', false).text(jsLang('Fetch URL'));

                toastMixin.fire({
                    icon: 'success',
                    title: jsLang('URL fetched successfully!')
                });
            }
        },
        error: function (xhr) {
            submitButton.find('.loader-icon').addClass('hidden');
            submitButton.prop('disabled', false).text(jsLang('Fetch URL'));

            toastMixin.fire({
                icon: 'error',
                title: xhr.responseJSON?.error
            });
        }
    });
});


function fetchUrlHtml(data) {

    return data.map((item, index) => `
        <div class="flex items-start mb-[14px] px-7" onclick="updateCurrentCount()">
            <input
                id="url-${index}"
                name="urls[]"
                type="checkbox"
                value="${escapeHtml(item)}"
                class="mt-1 me-2 accent-purple border border-gray-1 cursor-pointer"
            />
            <label
                for="url-${index}"
                class="text-left text-sm text-color-14 dark:text-white cursor-pointer select-none"
            >
                ${escapeHtml(item)}
            </label>
        </div>
    `).join('');
}

function updateCurrentCount() {
    let checkedCount = $('input[name="urls[]"]:checked').length;
    $('.current-count').text(checkedCount);
}


$(document).on('click', '#url-checkbox-all', function () {
    let isChecked = $(this).is(':checked');
    $('input[name="urls[]"]').prop('checked', isChecked);
    let checkedCount = isChecked ? $('input[name="urls[]"]').length : 0;
    $('.current-count').text(checkedCount);
});

$(document).on('click', '.website-url-modal', function () {
    $('#fetched-links-list').empty();
    $('.fetch-content').addClass('hidden');
});

$(document).on('click', '#training-materials', function () {

    const button = $(this);
    button.prop('disabled', true).find('span').text(jsLang('Adding...'));
    let selectedUrls = [];

    $('input[name="urls[]"]:checked').each(function () {
        selectedUrls.push($(this).val());
    });

    let trainRoute = $(this).data('url');
    let type = $(this).data('type');

    if (selectedUrls.length === 0) {
        toastMixin.fire({
            icon: 'warning',
            title: jsLang('Please select at least one URL.')
        });
        button.prop('disabled', false).find('span').text(jsLang('Add Selected'));
        return;
    }

    $.ajax({
        url: trainRoute,
        type: 'POST',
        data: {
            urls: selectedUrls,
            type: type,
            _token: CSRF_TOKEN,
        },
        dataType: 'JSON',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
            button.find('.loader-icon').removeClass('hidden');
        },
        success: function (response) {
            button.prop('disabled', false).find('span').text(jsLang('Add Selected'));
            button.find('.loader-icon').addClass('hidden');

            if (response.data && response.data.length) {
                var tableContent = materialTableData(response.data);
                var $materialsBody = $('#materials-table-body');
                if ($materialsBody.find('[id^="material-row-"]').length === 0) {
                    $materialsBody.empty();
                }
                $materialsBody.append(tableContent);
            } else {
                var $materialsBody = $('#materials-table-body');
                if ($materialsBody.find('[id^="material-row-"]').length === 0) {
                    $materialsBody.html(emptyHtml());
                }
            }

            toastMixin.fire({
                icon: 'success',
                title: jsLang('Materials added successfully!')
            });

            closeModal('modal2');

            // Optional: clear previous selections and counts
            $('#url-checkbox-all').prop('checked', false);
            $('input[name="urls[]"]').prop('checked', false);
            $('.current-count').text(0);
        },
        error: function (xhr) {
            button.prop('disabled', false).find('span').text(jsLang('Add Selected'));
            button.find('.loader-icon').addClass('hidden');

            toastMixin.fire({
                icon: 'error',
                title: xhr.responseJSON?.error
            });
        }
    });
});


function materialTableData(data) {
    return data.map(item => `
    <tr id="material-row-${item.id}" class="border-t border-color-89/10 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-purple-50/50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20">
      <td class="pl-3 pr-6 py-5 text-color-14 dark:text-white text-base">
        ${escapeHtml(item.original_name)}
      </td>
      <td class="px-6 py-5 text-color-14 dark:text-white text-base">
        ${escapeHtml(item.type)}
      </td>
      <td class="px-6 py-5 text-color-14 dark:text-white text-base">
        ${escapeHtml(String(item.meta?.words ?? ''))}
      </td>
      <td class="px-6 py-5 whitespace-nowrap text-color-14 dark:text-white text-base">
        ${escapeHtml(item.created_at)}
      </td>
      <td class="px-6 py-5 whitespace-nowrap text-base ${(item.meta?.state || '').toLowerCase() === 'trained' ? 'text-green-500' : 'text-red-500'}">
        ${escapeHtml(item.meta?.state ?? '')}
      </td>
      <td class="px-6 py-5 text-center">
        <div class="relative">
            <button class="table-dropdown-click">
                <a href="javascript: void(0)" class="cursor-pointer border p-2 border-color-89 rounded-lg flex justify-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M10.6875 14.625C10.6875 15.557 9.93198 16.3125 9 16.3125C8.06802 16.3125 7.3125 15.557 7.3125 14.625C7.3125 13.693 8.06802 12.9375 9 12.9375C9.93198 12.9375 10.6875 13.693 10.6875 14.625ZM10.6875 9C10.6875 9.93198 9.93198 10.6875 9 10.6875C8.06802 10.6875 7.3125 9.93198 7.3125 9C7.3125 8.06802 8.06802 7.3125 9 7.3125C9.93198 7.3125 10.6875 8.06802 10.6875 9ZM10.6875 3.375C10.6875 4.30698 9.93198 5.0625 9 5.0625C8.06802 5.0625 7.3125 4.30698 7.3125 3.375C7.3125 2.44302 8.06802 1.6875 9 1.6875C9.93198 1.6875 10.6875 2.44302 10.6875 3.375Z" fill="#898989"></path>
                    </svg>
                </a>
            </button>
            <div class="absolute right-0 mt-2 w-[201px] border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-[#333332] z-50 table-drop-body dropdown-shadow" style="display: none;">
                <div class="my-2">
                    <a 
                        onclick="train(this)" data-id="${escapeHtml(item.id)}" data-url="${escapeHtml(SITE_URL)}/user/marketing-bot/campaigns/train-materials/${escapeHtml(item.id)}"
                        href="javascript: void(0)" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-lg text-left">
                        <span class="w-4 h-4 train-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 3.31266L12.9407 5.78749L12.1823 6.16739C12.1743 6.17119 12.1663 6.17516 12.1585 6.17929L8 8.26232L3.84149 6.17929C3.83366 6.17516 3.82574 6.17119 3.81772 6.16738L3.05932 5.78749L8 3.31266ZM2.90909 7.13778L1.35177 6.35771C1.13618 6.24972 1 6.02897 1 5.78749C1 5.54602 1.13618 5.32527 1.35177 5.21728L7.48774 2.14372C7.49245 2.14136 7.49789 2.13858 7.50401 2.13545C7.56338 2.1051 7.68625 2.04229 7.82398 2.0164C7.94031 1.99453 8.05969 1.99453 8.17602 2.0164C8.31375 2.04229 8.43662 2.1051 8.49599 2.13545C8.50211 2.13858 8.50755 2.14136 8.51226 2.14372L14.6482 5.21728C14.8638 5.32527 15 5.54602 15 5.78749C15 6.02897 14.8638 6.24972 14.6482 6.35771L13.0909 7.13778V10.576C13.0909 10.5917 13.091 10.6078 13.091 10.6243C13.0917 10.8002 13.0925 11.0214 13.0213 11.2282C12.9598 11.4068 12.8594 11.5695 12.7274 11.7046C12.5747 11.8608 12.3768 11.959 12.2194 12.0371C12.2047 12.0444 12.1903 12.0516 12.1763 12.0586L8.73993 13.7799C8.72858 13.7855 8.71693 13.7914 8.70499 13.7975C8.57607 13.8625 8.4138 13.9445 8.23468 13.9781C8.07958 14.0073 7.92042 14.0073 7.76531 13.9781C7.5862 13.9445 7.42393 13.8625 7.29501 13.7975C7.28307 13.7914 7.27142 13.7855 7.26007 13.7799L3.8237 12.0586C3.80973 12.0516 3.79532 12.0444 3.78056 12.0371C3.62316 11.959 3.42532 11.8608 3.27256 11.7046C3.14056 11.5695 3.04017 11.4068 2.97865 11.2282C2.90746 11.0214 2.9083 10.8002 2.90897 10.6243C2.90903 10.6078 2.90909 10.5917 2.90909 10.576V7.13778ZM4.18182 7.7753V10.576C4.18182 10.6981 4.1821 10.7609 4.18493 10.8064C4.18502 10.8078 4.1851 10.8091 4.18519 10.8103C4.18626 10.8109 4.1874 10.8116 4.18858 10.8123C4.22789 10.8352 4.28384 10.8635 4.39288 10.9181L7.82925 12.6394C7.91854 12.6842 7.96374 12.7066 7.99732 12.7212C7.99825 12.7216 7.99914 12.722 8 12.7224C8.00086 12.722 8.00175 12.7216 8.00268 12.7212C8.03626 12.7066 8.08146 12.6842 8.17075 12.6394L11.6071 10.9181C11.7162 10.8635 11.7721 10.8352 11.8114 10.8123C11.8126 10.8116 11.8137 10.8109 11.8148 10.8103C11.8149 10.8091 11.815 10.8078 11.8151 10.8064C11.8179 10.7609 11.8182 10.6981 11.8182 10.576V7.7753L8.51226 9.43126C8.50755 9.43363 8.50211 9.43641 8.49599 9.43953C8.43663 9.46988 8.31375 9.5327 8.17602 9.55859C8.05969 9.58045 7.94031 9.58045 7.82398 9.55859C7.68625 9.5327 7.56338 9.46988 7.50401 9.43953C7.49789 9.43641 7.49245 9.43363 7.48774 9.43126L4.18182 7.7753ZM7.87439 8.32454C7.87425 8.3246 7.87426 8.3246 7.87439 8.32454V8.32454ZM8.12559 8.32453C8.12572 8.32459 8.12573 8.32459 8.12559 8.32453V8.32453Z" fill="currentColor"></path></svg>
                        </span>
                        <svg class="w-5 h-5 animate-spin text-purple-600 loader-icon hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    
                        <p>${jsLang('Train')}</p>
                    </a>
                    <a href="javascript: void(0)" data-id="${item.id}" data-target="modal4" class="openModalBtn flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-none rounded-b-lg  modal-toggle text-left">
                        <span class="w-4 h-3">
                            <svg class="w-3 h-3" width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.846154 0.8C0.378836 0.8 0 1.15817 0 1.6V2.4C0 2.84183 0.378836 3.2 0.846154 3.2H1.26923V10.4C1.26923 11.2837 2.0269 12 2.96154 12H8.03846C8.9731 12 9.73077 11.2837 9.73077 10.4V3.2H10.1538C10.6212 3.2 11 2.84183 11 2.4V1.6C11 1.15817 10.6212 0.8 10.1538 0.8H7.19231C7.19231 0.358172 6.81347 0 6.34615 0H4.65385C4.18653 0 3.80769 0.358172 3.80769 0.8H0.846154ZM3.38462 4C3.61827 4 3.80769 4.17909 3.80769 4.4V10C3.80769 10.2209 3.61827 10.4 3.38462 10.4C3.15096 10.4 2.96154 10.2209 2.96154 10L2.96154 4.4C2.96154 4.17909 3.15096 4 3.38462 4ZM5.5 4C5.73366 4 5.92308 4.17909 5.92308 4.4V10C5.92308 10.2209 5.73366 10.4 5.5 10.4C5.26634 10.4 5.07692 10.2209 5.07692 10V4.4C5.07692 4.17909 5.26634 4 5.5 4ZM8.03846 4.4V10C8.03846 10.2209 7.84904 10.4 7.61538 10.4C7.38173 10.4 7.19231 10.2209 7.19231 10V4.4C7.19231 4.17909 7.38173 4 7.61538 4C7.84904 4 8.03846 4.17909 8.03846 4.4Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        
                        <p>${jsLang('Delete')}</p>
                    </a>
                </div>
            </div>
        </div>
      </td>
    </tr>
  `).join('');
}


$(document).on('click', '#upload-materials', function () {
    const button = $(this);
    button.prop('disabled', true).find('span').text(jsLang('Adding...'));
    let trainRoute = $(this).data('url');
    let type = $(this).data('type');
    const normalizedFiles = selectedFiles
        .map(f => {
            if (f instanceof File) return f;
            if (Array.isArray(f) && f[0] instanceof File) return f[0];
            return null;
        })
        .filter(Boolean);

    var formData = new FormData();
    normalizedFiles.forEach(file => {
        formData.append('file[]', file);
    });

    formData.append('type', type);
    formData.append('_token', CSRF_TOKEN);

    $.ajax({
        url: trainRoute,
        type: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
            button.find('.loader-icon').removeClass('hidden');
        },
        success: function (response) {
            button.prop('disabled', false).find('span').text(jsLang('Add Selected'));
            button.find('.loader-icon').addClass('hidden');

            if (response.data) {
                var tableContent = materialTableData(response.data);
                var $materialsBody = $('#materials-table-body');
                if ($materialsBody.find('[id^="material-row-"]').length === 0) {
                    $materialsBody.empty();
                }
                $materialsBody.prepend(tableContent);
                $('#upload-files').find('.closeModalBtn').trigger('click');

            }

            toastMixin.fire({
                icon: 'success',
                title: jsLang('Materials added successfully!')
            });
        },
        error: function (xhr) {
            toastMixin.fire({
                icon: 'error',
                title: xhr.responseJSON?.error
            });
            button.find('.loader-icon').addClass('hidden');
            button.prop('disabled', false).find('span').text(jsLang('Add Selected'));
        }
    });
})


$(function () {
    var fileInput = $('#fileUpload');
    var uploadList = $('#upload-files-list');
    var uploadFilesWrapper = $('.upload-files');
    var dropZone = $('label[for="fileUpload"]');

    // allow multiple selection (helps when dragging multiple files)
    fileInput.prop('multiple', true);

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        var k = 1024;
        var sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        var i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function syncInputFiles() {
        var dt = new DataTransfer();
        selectedFiles.forEach(function (f) { dt.items.add(f); });
        // DOM element required to set .files
        fileInput[0].files = dt.files;
    }

    function renderFiles() {
        uploadList.empty();

        if (selectedFiles.length === 0) {
            uploadFilesWrapper.addClass('hidden');
            return;
        }

        uploadFilesWrapper.removeClass('hidden');

        selectedFiles.forEach(function (file, idx) {
            // build the row similar to your markup
            var row = $(
                `<div data-index="${idx}" class="mb-2 flex items-center justify-between border border-color-F3 dark:border-color-47 rounded-lg py-1 px-2">
                    <div class="flex items-center">
                        <svg class='text-color-47 dark:text-color-DF' xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="m433.798 106.268-96.423-91.222C327.119 5.343 313.695 0 299.577 0H116C85.673 0 61 24.673 61 55v402c0 30.327 24.673 55 55 55h280c30.327 0 55-24.673 55-55V146.222c0-15.049-6.27-29.612-17.202-39.954zM404.661 120H330c-2.757 0-5-2.243-5-5V44.636zM396 482H116c-13.785 0-25-11.215-25-25V55c0-13.785 11.215-25 25-25h179v85c0 19.299 15.701 35 35 35h91v307c0 13.785-11.215 25-25 25z" fill="currentColor" opacity="1" class=""></path><path d="M363 200H143c-8.284 0-15 6.716-15 15s6.716 15 15 15h220c8.284 0 15-6.716 15-15s-6.716-15-15-15zM363 280H143c-8.284 0-15 6.716-15 15s6.716 15 15 15h220c8.284 0 15-6.716 15-15s-6.716-15-15-15zM215.72 360H143c-8.284 0-15 6.716-15 15s6.716 15 15 15h72.72c8.284 0 15-6.716 15-15s-6.716-15-15-15z" fill="currentColor" opacity="1" class=""></path></g></svg>
                        <div class="ms-2">
                            <h6 class="text-left text-sm text-dark-1 dark:text-white font-medium text-nowrap file_name">${escapeHtml(file.name)}</h6>
                            <p class="text-left text-xs text-color-89 font-medium file_size">${formatBytes(file.size)}</p>
                        </div>
                    </div>
                    <button class="text-red-500 mr-2 remove-file-btn" data-index="${idx}">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 16 16"
                            fill="none"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.32812 1.99967C5.32812 1.63148 5.6266 1.33301 5.99479 1.33301H9.99479C10.363 1.33301 10.6615 1.63148 10.6615 1.99967C10.6615 2.36786 10.363 2.66634 9.99479 2.66634H5.99479C5.6266 2.66634 5.32812 2.36786 5.32812 1.99967ZM3.32295 3.33301H1.99479C1.6266 3.33301 1.32812 3.63148 1.32812 3.99967C1.32812 4.36786 1.6266 4.66634 1.99479 4.66634H2.70442L3.13222 11.0833C3.16579 11.5869 3.19356 12.0037 3.24337 12.3429C3.29523 12.6961 3.37749 13.0189 3.54885 13.3197C3.81561 13.7879 4.21798 14.1644 4.70294 14.3994C5.01447 14.5504 5.34199 14.611 5.69785 14.6392C6.03965 14.6664 6.45734 14.6664 6.96208 14.6663H9.0275C9.53224 14.6664 9.94994 14.6664 10.2917 14.6392C10.6476 14.611 10.9751 14.5504 11.2866 14.3994C11.7716 14.1644 12.174 13.7879 12.4407 13.3197C12.6121 13.0189 12.6944 12.6961 12.7462 12.3429C12.796 12.0037 12.8238 11.5869 12.8574 11.0832L13.2852 4.66634H13.9948C14.363 4.66634 14.6615 4.36786 14.6615 3.99967C14.6615 3.63148 14.363 3.33301 13.9948 3.33301H12.6666C12.6627 3.33297 12.6588 3.33297 12.655 3.33301H3.33462C3.33074 3.33297 3.32685 3.33297 3.32295 3.33301ZM11.9489 4.66634H4.04072L4.46084 10.9682C4.49662 11.5049 4.52135 11.8686 4.56256 12.1492C4.60259 12.4218 4.65149 12.5616 4.70738 12.6597C4.84076 12.8938 5.04194 13.082 5.28442 13.1995C5.38602 13.2488 5.5287 13.2883 5.80336 13.3101C6.08614 13.3325 6.45069 13.333 6.98856 13.333H9.00102C9.53889 13.333 9.90344 13.3325 10.1862 13.3101C10.4609 13.2883 10.6036 13.2488 10.7052 13.1995C10.9476 13.082 11.1488 12.8938 11.2822 12.6597C11.3381 12.5616 11.387 12.4218 11.427 12.1492C11.4682 11.8686 11.493 11.5049 11.5287 10.9682L11.9489 4.66634ZM6.66146 6.33301C7.02965 6.33301 7.32812 6.63148 7.32812 6.99967V10.333C7.32812 10.7012 7.02965 10.9997 6.66146 10.9997C6.29327 10.9997 5.99479 10.7012 5.99479 10.333V6.99967C5.99479 6.63148 6.29327 6.33301 6.66146 6.33301ZM9.32812 6.33301C9.69632 6.33301 9.99479 6.63148 9.99479 6.99967V10.333C9.99479 10.7012 9.69632 10.9997 9.32812 10.9997C8.95994 10.9997 8.66146 10.7012 8.66146 10.333V6.99967C8.66146 6.63148 8.95994 6.33301 9.32812 6.33301Z"
                                fill="currentColor"
                            ></path>
                        </svg>
                    </button>
                </div>`
            );

            uploadList.append(row);
        });
    }

    function addFiles(fileList) {
        // avoid exact duplicates (same name,size,type)
        $.each(fileList, function (_, f) {
            var exists = selectedFiles.some(function (sf) {
                return sf.name === f.name && sf.size === f.size && sf.type === f.type;
            });
            if (!exists) selectedFiles.push(f);
        });
        syncInputFiles();
        renderFiles();
    }

    // File input change (file dialog)
    fileInput.on('change', function (e) {
        if (e.target.files && e.target.files.length) {
            addFiles(e.target.files);
        }
    });

    // Delegate remove button
    uploadList.on('click', '.remove-file-btn', function () {
        var idx = parseInt($(this).attr('data-index'), 10);
        if (!isNaN(idx)) {
            selectedFiles.splice(idx, 1);
            syncInputFiles();
            renderFiles();
        }
    });

    // Drag & drop handlers on the label
    dropZone.on('dragenter dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('drag-over'); // optional CSS hook
    });

    dropZone.on('dragleave drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('drag-over');
    });

    dropZone.on('drop', function (e) {
        var dt = e.originalEvent.dataTransfer;
        if (dt && dt.files && dt.files.length) {
            addFiles(dt.files);
        }
    });

    // optional: if you want a Cancel/Add files button behavior,
    // wire them here (they exist in your HTML).
    $('#upload-files .closeModalBtn').on('click', function () {
        // example: clear files and hide list
        selectedFiles = [];
        syncInputFiles();
        renderFiles();
        // close modal logic if any...
    });

    // initialize hidden state
    renderFiles();

    // Show skeleton immediately on page load
    window.materialsSkeleton.show();

    // Load initial materials data on page load
    loadInitialMaterials();
});

let debounceTimer;

function searchTrainingMaterials(e) {
    const url = buildUrl({ search: $(e).val().trim().toLowerCase() });

    getMaterials(url);
}

function filterTrainingMaterials(e, category) {
    const value = $(e).text().trim().toLowerCase();
    const url = buildUrl({ [category]: value });

    getMaterials(url);
}

function getFilters() {
    return {
        type: $('.custom-select .selected-option.filter-type').text().trim().toLowerCase(),
        state: $('.custom-select .selected-option.filter-state').text().trim().toLowerCase(),
        search: $('#material-search').val().trim().toLowerCase()
    };
}

function buildUrl(extra = {}) {
    const base = window.route;
    const filters = { ...getFilters(), ...extra };
    const query = Object.entries(filters)
        .filter(([_, v]) => v && v !== 'all')
        .map(([k, v]) => `${k}=${encodeURIComponent(v)}`)
        .join('&');
    return `${base}?${query}`;
}

// Materials skeleton management
window.materialsSkeleton = {
    show: function () {
        // Hide the entire materials table first
        $('.materials-table').addClass('hidden');
        // Then show skeleton (using both ID and class for reliability)
        $('#materials-table-skeleton, .table-skeleton').removeClass('hidden');
    },
    hide: function () {
        // Hide skeleton first
        $('#materials-table-skeleton, .table-skeleton').addClass('hidden');
        // Then show the entire materials table
        $('.materials-table').removeClass('hidden');
    }
};

// Load initial materials data
function loadInitialMaterials() {
    const url = window.route + '?orderBy=newest';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response && response.items) {
                $('#materials-table-body').html(response.items);
            } else {
                $('#materials-table-body').html(emptyHtml());
            }
            window.materialsSkeleton.hide();
        },
        error: function (xhr, status, error) {
            // Hide skeleton loader on error
            if (window.materialsSkeleton && typeof window.materialsSkeleton.hide === 'function') {
                window.materialsSkeleton.hide();
            } else {
                // Fallback if skeleton functions not available
                $('#materials-table-skeleton, .table-skeleton').addClass('hidden');
                $('.materials-table-content').removeClass('hidden');
            }

            toastMixin.fire({
                icon: 'error',
                title: jsLang('Failed to load materials. Please try again.')
            });
        }
    });
}

function getMaterials(url) {
    // Show skeleton immediately when search/filter is triggered
    window.materialsSkeleton.show();

    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        $.ajax({
            url: url,
            type: 'GET',
            data: {},
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (response) {
                if (response && response.items) {
                    // Response now contains only table rows (tr elements), no thead or tbody wrapper
                    $('#materials-table-body').html(response.items);
                } else {
                    $('#materials-table-body').html(emptyHtml());
                }
                window.materialsSkeleton.hide();
            },
            error: function (xhr, status, error) {
                // Hide skeleton loader on error
                window.materialsSkeleton.hide();

                toastMixin.fire({
                    icon: 'error',
                    title: jsLang('Failed to load materials. Please try again.')
                });
            }
        });
    }, 1000);
}

$(document).on('submit', '#plain-text-form', function (e) {
    e.preventDefault();
    var form = $(this);
    var button = form.find('button[type="submit"]');

    button.prop('disabled', true).find('span').text(jsLang('Adding...'));

    var type = button.data('type');
    var trainRoute = button.data('url');

    $.ajax({
        url: trainRoute,
        type: 'POST',
        data: {
            text: form.find('textarea[name="text"]').val(),
            type: type,
            _token: CSRF_TOKEN,
        },
        dataType: 'JSON',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
            button.find('.loader-icon').removeClass('hidden');
        },
        success: function (response) {
            button.find('.loader-icon').addClass('hidden');
            button.prop('disabled', false).find('span').text(jsLang('Add for training'));

            if (response.data && response.data.length) {
                var tableContent = materialTableData(response.data);
                var $materialsBody = $('#materials-table-body');
                if ($materialsBody.find('[id^="material-row-"]').length === 0) {
                    $materialsBody.empty();
                }
                $materialsBody.append(tableContent);
            } else {
                var $materialsBody = $('#materials-table-body');
                if ($materialsBody.find('[id^="material-row-"]').length === 0) {
                    $materialsBody.html(emptyHtml());
                }
            }

            toastMixin.fire({
                icon: 'success',
                title: jsLang('Materials added successfully!')
            });

            closeModal('modal3');
        },
        error: function (xhr) {
            button.prop('disabled', false).find('span').text(jsLang('Add for training'));
            button.find('.loader-icon').addClass('hidden');

            toastMixin.fire({
                icon: 'error',
                title: xhr.responseJSON?.error
            });
        }
    });
});

function train(e) {

    const $link = $(e);
    if ($link.data('busy')) {
        return;
    }
    const trainRoute = $link.data('url');

    $.ajax({
        url: trainRoute,
        type: 'POST',
        data: {
            id: $link.data('id'),
            _token: CSRF_TOKEN,
        },
        dataType: 'JSON',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
            $link.find('.loader-icon').removeClass('hidden');
            $link.find('.train-icon').addClass('hidden');
            $link.prop('disabled', true);
            $link.data('busy', true);
        },
        success: function (response) {

            if (response.data && response.data.length) {
                $link.find('.loader-icon').addClass('hidden');
                $link.find('.train-icon').removeClass('hidden');
                $('#material-row-' + $link.data('id')).remove();
                var tableContent = materialTableData(response.data);
                $('#materials-table-body').prepend(tableContent);
            } else {
                $('#material-row-' + $link.data('id')).remove();
                var $materialsBody = $('#materials-table-body');
                if ($materialsBody.find('[id^="material-row-"]').length === 0) {
                    $materialsBody.html(emptyHtml());
                }
            }

            toastMixin.fire({
                icon: 'success',
                title: jsLang('Materials trained successfully!')
            });
            $link.data('busy', false);
        },
        error: function (xhr) {
            toastMixin.fire({
                icon: 'error',
                title: xhr.responseJSON?.error
            });
            $link.find('.loader-icon').addClass('hidden');
            $link.find('.train-icon').removeClass('hidden');
            $link.data('busy', false);
        },
    })
}

$(document).on('click', '.openModalBtn', function () {
    $('.delete-material').attr('data-id', $(this).data('id'));
});

$(document).on('click', '.delete-material', function () {
    let id = $(this).attr("data-id");
    const btn = $(this);
    $(".loader").removeClass('hidden');
    btn.prop('disabled', true);

    doAjaxprocess(
        SITE_URL + "/user/marketing-bot/campaigns/materials/delete",
        {
            id: id,
            _token: CSRF_TOKEN
        },
        'delete',
        'json'
    ).done(function (response, textStatus, jqXHR) {
        toastMixin.fire({
            title: response.message,
            icon: textStatus,
        });
        $('#material-row-' + id).remove();
        var $materialsBody = $('#materials-table-body');
        if ($materialsBody.find('[id^="material-row-"]').length === 0) {
            var emptyRowHtml = emptyHtml();
            $materialsBody.html(emptyRowHtml);
        }
        $(".loader").addClass('hidden');
        btn.prop('disabled', false);
        $('.closeModalBtn').click();

    }).fail(function (jqXHR, textStatus, errorThrown) {
        let message = jqXHR.responseJSON?.error;
        if (!message) {
            try {
                const parsed = JSON.parse(jqXHR.responseText || '{}');
                message = parsed.error || textStatus;
            } catch (_) {
                message = textStatus;
            }
        }
        toastMixin.fire({
            title: message,
            icon: 'error',
        });
        $(".loader").addClass('hidden');
        btn.prop('disabled', false);
        $('.closeModalBtn').click();
    });
});


function emptyHtml() {
    return `
        <tr>
            <td colspan="6">
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
    `;
}
