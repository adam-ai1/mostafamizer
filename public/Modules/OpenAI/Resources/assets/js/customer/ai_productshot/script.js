'use script';

$('.product-type-dropdown').on("click", function(event) {
    event.stopPropagation();
    $(".product-dropdown-content").slideToggle(200);
});
$(document).on("click", function() {
    $(".product-dropdown-content").hide();
});

let debounceTimer;

var spinner = `
    <div class="avatar-card flex flex-col gap-2 items-center justify-center rounded cursor-pointer hover:bg-[#f3f3f3] dark:hover:bg-color-43 p-2 fetch-skeleton">
        <div class="skeleton-loader w-full h-[92px] rounded"></div>
        <div class="skeleton-loader w-full h-[22px] rounded mt-2"></div>
    </div>
`;

function debouncedSearch(input, listClass) {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        searchItems(input, listClass);
    }, 500); // Wait 500ms after last keystroke
}

function searchItems(element, selector) {
    const searchText = $(element).val().toLowerCase();
    const parentDiv = $(selector);
    parentDiv.empty();

    for (let i = 0; i < 4; i++) {
        parentDiv.append(spinner);
    }

    doAjaxprocess(
        SITE_URL + '/' + 'user/ai-product-photography?name=' + searchText.trim(),
        {},
        'get',
        'json'
    ).done(function (response) {
        parentDiv.empty();
        pageNumber = 0;
        const items = response.items.data;
        renderSidebarAndOptions(parentDiv, items);

        if (items.length === 0) {
            parentDiv.append(`<p class="flex items-center justify-center col-span-2 h-40 text-center text-color-14 dark:text-white text-16 font-normal font-Figtree">${jsLang('No data found.')} </p>`);
        }
         
        pageNumber = response.nextPageUrl ? response.nextPageUrl.split("?page=")[1] : 0;
        var container ='.background-container';
        if (pageNumber === 0) {
            $(container).data('next-page-url', '');
        }
    });
}

var pageNumber = 0;
var checked = true;

function checkScrollIfAtEnd(contentContainer, listSelector) {
    var scrollHeight = contentContainer.scrollHeight;
    var clientHeight = contentContainer.clientHeight;
    var scrollPosition = contentContainer.scrollTop;

    var container = '.background-container';

    if (pageNumber == 0 && pageNumber !== null) {
        pageNumber = $(container).data('next-page-url') ? $(container).data('next-page-url').split("?page=")[1] : 0;
    }

    if ((scrollPosition + clientHeight >= scrollHeight) && pageNumber && pageNumber != 0 && pageNumber.length != 0 && checked) {
        checked = false;
        const parentDiv = $(listSelector);
        const childrenLength = parentDiv.children().length;
        const count = Math.ceil(childrenLength / 2);
        const loopCount = count % 2 === 0 ? 4 : 5;
        for (let i = 0; i < loopCount; i++) {
            parentDiv.append(spinner);
        }

        doAjaxprocess(
            SITE_URL + '/' + 'user/ai-product-photography?page=' + pageNumber,
            {},
            'get',
            'json'
        ).done(function (response) {
            const items = response.items.data;
            renderSidebarAndOptions(parentDiv, items);
            $('.fetch-skeleton').remove();
           
            pageNumber = response.nextPageUrl ? response.nextPageUrl.split("?page=")[1] : null;
            checked = true;
        });
    }
}

function renderSidebarAndOptions(parentDiv, items) {
    let sidebarHTML = '';

    items.forEach(item => {
        sidebarHTML += `
            <div class="avatar-card flex flex-col gap-2 items-center justify-center rounded cursor-pointer hover:bg-[#f3f3f3] dark:hover:bg-color-43 p-2" 
                data-name="${item.name}" data-id="${item.background_id}" data-image="${item.file_url}"
                onclick="selectBackground(this)">
                <img class="object-cover rounded w-full h-[92px]" src="${item.file_url}" alt="${jsLang('Image')}">
                <p class="dark:text-white font-medium text-[15px] p-1 leading-[22px] font-Figtree wrap-anywhere text-left line-clamp-single dept-name avatar-name">
                    ${item.name}
                </p>
            </div>
        `;
    });

    parentDiv.append(sidebarHTML);
    parentDiv.removeAttr('data-next-page-url');
}


function selectBackground(element) {
    const backgroundInput = $('#background');
    const backgroundName = $('.background-information .background-name');
    const backgroundImage = $('.background-image');

    const backgroundId = $(element).data('id');
    const currentBackgroundName = $(element).data('name');
    const imageUrl = $(element).data('image');

    const isAlreadySelected = $(element).hasClass('avatar-border-active');

    // Deselect
    if (isAlreadySelected) {
        backgroundInput.val('');
        backgroundName.text(`${(jsLang('All Backgrounds'))}`);
        backgroundImage.attr('src', '').addClass('hidden');
        $(element).removeClass('avatar-border-active');
        return;
    }

    // Select new background
    backgroundInput.val(backgroundId);
    backgroundName.text(currentBackgroundName);
    backgroundImage.attr('src', imageUrl).removeClass('hidden');

    $('.avatar-border-active').removeClass('avatar-border-active');
    $(element).addClass('avatar-border-active');
}

$('.background-container').on('scroll', function () {
    checkScrollIfAtEnd(this, '.background-list');
});

$(document).on('submit', '#productshot-form', function (e) {
    e.preventDefault();

    let isValid = true;
    
    // Reset all fields to avoid conflicts in validation
    $('[data-field]').find('input, textarea, select').each(function() {
        $(this).removeAttr('required'); // Remove any pre-existing required attributes
    });

    // Set required attribute only for visible fields
    $('[data-field]').each(function() {
        if ($(this).is(':visible')) {
            $(this).find('input, textarea, select').not('.search-input').prop('required', true); // Add required attribute for visible fields
        }
    });

    // Validate each field manually
    $('[data-field]').find('input, textarea, select').each(function() {
        // If the field is visible and invalid, trigger validation
        if ($(this).is(':visible') && !$(this)[0].checkValidity()) {
            $(this)[0].reportValidity(); // Show validation error message
            isValid = false; // Mark the form as invalid
            return false;
        }
    });

    // If form is valid, proceed with form data submission
    if (!isValid) {
        return false;
    }

    const formData = new FormData();
    const provider = $('#provider').val();

    $(this).serializeArray().forEach(function(field) {
        let name = field.name.trim();
        if (['prompt', 'provider'].includes(name)) {
            formData.append(name, field.value);
        } else if (name.startsWith(`${provider}[`)) {
            const dataName = name.match(/\[(.*?)\]/)[1];
            formData.append(`options[${dataName}]`, field.value);
        }
    });

    formData.append('options[file]', $('#file_input')[0].files[0]);

    let fileInput = $('input[name="' + provider + '_file"]');
        
        fileInput.each(function() {
            const name = $(this).data('name');
            const files = $(this).prop('files');

            if (files && files.length > 0) {
                Array.from(files).forEach(file => formData.append(`options[${name}]`, file));
            }
        });
    
    if ($('#background').val()) {
        formData.append('options[background_id]', $('#background').val());
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        url: PROMPT_URL,
        type: "POST",
        beforeSend: function (xhr) {
            $(".loader-video").removeClass('hidden');
            $('#product-shot-creation').attr('disabled', 'disabled');
            xhr.setRequestHeader('Authorization', 'Bearer ' + ACCESS_TOKEN);
        },
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        success: function(response) {
            if (response.message) {
                errorMessage(response.message, 'product-shot-creation');
                return true;
            }

            $("#productshot-form .loader").addClass('hidden');

            let credit = $('.productshot-image-left');
            
            if (!isNaN(credit.text()) && response.data.images != null && response.data.balance_reduce_type == 'subscription') {
                credit.text(credit.text() - response.data.images.length);
            }

            var gethtml = '';

            gethtml +='<div class="flex flex-wrap justify-center items-center md:gap-6 gap-5 mt-10 image-content1 9xl:mx-32 3xl:mx-16 2xl:mx-5">'
                $.each(response.data.images, function(key, image) {
                    gethtml +='<div class="relative md:w-[300px] md:h-[300px] w-[181px] h-[181px] download-image-container md:rounded-xl rounded-lg">'
                    gethtml += '<img class="m-auto md:w-[300px] md:h-[300px] w-[181px] h-[181px] cursor-pointer md:rounded-xl rounded-lg border border-color-DF dark:border-color-3A object-cover"src="'+ image.url +'" alt=""><div class="image-hover-overlay"></div>'
                    gethtml +='<div class=" flex gap-3 right-3 bottom-3 absolute">'
                    gethtml += '<div class="image-download-button"><a class="relative tooltips w-9 h-9 flex items-center m-auto justify-center" href="'+ image.slug_url +'">'
                    gethtml +=`<img class="w-[18px] h-[18px]" src="${SITE_URL}/Modules/OpenAI/Resources/assets/image/view-eye.svg" alt="">`
                    gethtml +='<span class="image-download-tooltip-text z-50 w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[138%] left-[50%] ml-[-22px]">View</span>'
                    gethtml += '</a>'
                    gethtml += '</div>'
                    gethtml += '<div class="image-download-button"><a class="file-need-download relative tooltips w-9 h-9 flex items-center m-auto justify-center" href="'+ image.url +'" download="'+ filterXSS(response.data.title) +'" Downlaod>'
                    gethtml +=`<img class="w-[18px] h-[18px]" src="${SITE_URL}/Modules/OpenAI/Resources/assets/image/file-download.svg" alt="">`
                    gethtml +='<span class="image-download-tooltip-text z-50 w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[138%] left-[50%] ml-[-38px]">Download</span>'
                    gethtml += '</a>'
                    gethtml += '</div>'
                    gethtml += '</div>'
                    gethtml += '</div>'

                });
                gethtml += '</div>';

                $('#productshot-gallery').prepend(gethtml);
                $(".loader").addClass('hidden');
                $('#image-creation').removeAttr('disabled');
            
            toastMixin.fire({
                title: jsLang('Image generated successfully.'),
                icon: 'success'
            });

        },
        complete: () => {
            $(".loader-video").addClass('hidden');
            $("#product-shot-creation").removeAttr('disabled');
        },
        error: function(response) {
            let jsonData;

            try {
                jsonData = JSON.parse(response.responseText);
            } catch (e) {
                errorMessage(jsLang('Invalid server response'), 'product-shot-creation');
                return true;
            }

            const message = 
                jsonData?.error ||
                jsonData?.message ||
                (jsonData?.records?.length === 0 && jsonData?.response?.status?.message) ||
                jsonData?.data?.response ||
                jsonData?.response?.status?.message;

            if (message) {
                errorMessage(message, 'product-shot-creation');
                return true;
            }
        }

    });
});

let activeProvider = $('#provider option:selected').val();
let model = $("select[name='" + activeProvider + "[model]'] option:selected").val();
let dataAttrValues = {};
let attrValue;

function hideProviderOptions() 
{
    $('.ProviderOptions').each(function() {
        $(this).addClass('hidden')
    });
}

function updateDataAttr()
{
    for (let key in dataAttrValues) {
        if (dataAttrValues.hasOwnProperty(key)) {
            let value = dataAttrValues[key];
            let elem = $('[data-attr="' + value + '"]');
            
            if (model === value) {
                elem.removeClass('hidden');
                elem.each(function () {
                    if ($(this).find('select').length > 0) {
                        $(this).find('select option').length <=1 ? $(this).addClass('hidden') : '';
                    }
                });
            } else {
                elem.addClass('hidden');
            }
        }
    }
}

function storeAttrObject()
{
    $('[data-attr]').each(function() {
        attrValue = $(this).data('attr');
        dataAttrValues[$(this).attr('data-attr')] = attrValue;
    });
}


$('.AdavanceOption').on('click', function() {
    var className = $('#ProviderOptionDiv').attr('class');
    if (className == 'hidden') {
        hideProviderOptions()
        let activeProvider = $('#provider option:selected').val();

        $('.' + activeProvider + '_div').removeClass('hidden');
        $('#ProviderOptionDiv').removeClass('hidden');
    } else {
        $('#ProviderOptionDiv').addClass('hidden');
    }
});

function clear() {
    const backgroundDescriptionParent = $("#background").closest("[data-field='background']");
    
    if (backgroundDescriptionParent.is(":hidden")) {
        backgroundDescriptionParent.show();
        $("#background").attr('required', true);
    }
    
    // Always show the image description parent
    backgroundDescriptionParent.show();
    $('.AdavanceOption').removeClass('hidden');
}

$('#provider').on('change', function() {
    clear()
    hideProviderOptions();
    activeProvider = $(this).val();
    $('.' + activeProvider + '_div').removeClass('hidden');
    model = $("select[name='" + activeProvider + "[model]'] option:selected").val(); 
    storeAttrObject();

    handleServiceClassChange($(`.custom-dropdown-arrow[data-attr="${model}"]`).find('select.service-class'));
    hideSingleData();
});

$(document).ready(function() {
    $('#provider').trigger('change');
})

$(document).on('change', '.model-class', function() {
    model = $(this).val();
    handleServiceClassChange($(`.custom-dropdown-arrow[data-attr="${model}"]`).find('select.service-class'));
});

// Service class change event handler
$(document).on('change', '.service-class', function() {
    handleServiceClassChange($(this));
});

// Separate function to handle service class logic
function handleServiceClassChange($serviceClass) {
    updateDataAttr();

    // Only get data attributes if this was triggered by direct service class change
    const selectedOption = $serviceClass.find('option:selected');
    const dataAttributes = selectedOption.length ? selectedOption.data() : {};

    // Process each data attribute
    $.each(dataAttributes, function(key, value) {
        const show = Boolean(value);
        const field = $(`.${activeProvider}_div [data-field="${key}"]`).length
            ? $(`.${activeProvider}_div [data-field="${key}"]`)
            : $(`[data-field="${key}"]`);
        
        if (field.length) {
            // Toggle field visibility
            field.toggleClass('hidden', !show);
            field.removeAttr('style');
            
            // Update required attributes
            field.find('input, textarea, select').not('.search-input').prop('required', show);
        } else {
            // Toggle model-specific fields
            const baseName = `${activeProvider}[${key}]`;
            const selector = typeof model !== 'undefined'
                ? `select[name='${baseName}[${model}]'], select[name='${baseName}']` 
                : `select[name='${baseName}']`;

            const inputSelector = document.querySelectorAll(`input[name='${baseName}[${model}]'], input[name='${baseName}']`);
            const textareaSelector = document.querySelectorAll(`textarea[name='${baseName}'], textarea[name='${baseName}[${model}]']`);

            const toggleElements = (elements, isHidden) => {
                if (!elements || elements.length === 0) return;
                
                // Convert NodeList to Array if needed and toggle class
                (elements.length ? Array.from(elements) : [elements]).forEach(el => {
                    $(el.parentElement).attr('hidden', isHidden ? null : 'hidden');
                    el.parentElement.classList.toggle('hidden', !isHidden);
                });
            };

            toggleElements(document.querySelectorAll(selector), show);
            toggleElements(inputSelector.length > 0 ? inputSelector : null, show);
            toggleElements(textareaSelector.length > 0 ? textareaSelector : null, show);
        }
    });

    hideSingleData();
}

function hideSingleData () {
    let $providerDiv = $('.' + activeProvider + '_div');
    let $children = $providerDiv.children();

    $children.each(function() {
        let current = $(this);

        if (current.data('field')) {
            return;
        }

        if (current.find('select').length > 0) {
            current.find('select option').length <= 1 ? current.addClass('hidden') : '';
        }
    });
    
    if ($children.length === $children.filter('.hidden').length) {
        $('.AdavanceOption').addClass('hidden');
    }
}