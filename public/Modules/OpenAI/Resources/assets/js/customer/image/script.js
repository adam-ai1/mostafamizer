'use strict';

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
    const imageDescriptionParent = $("#image-description").parent();
    
    if (imageDescriptionParent.is(":hidden")) {
        imageDescriptionParent.show();
        $("#image-description").attr('required', true);
    }
    
    // Always show the image description parent
    imageDescriptionParent.show();
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
            field.find('input, textarea, select').prop('required', show);
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


    $(document).on('click', '#image-creation', function(e) {
        var gethtml = '';
        e.preventDefault(); // Prevent default form submission

        let isValid = true;
    
        // Reset all fields to avoid conflicts in validation
        $('[data-field]').find('input, textarea, select').each(function() {
            $(this).removeAttr('required'); // Remove any pre-existing required attributes
        });
    
        // Set required attribute only for visible fields
        $('[data-field]').each(function() {
            if ($(this).is(':visible')) {
                $(this).find('input, textarea, select').prop('required', true); // Add required attribute for visible fields
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
    
        const form = $('#ImageForm');
        const provider = $('#provider').val();
        const model = $(`[name="${provider}[model]"]`).val();
        const service = $(`[name="${provider}[service]"]`).val() || null;
    
        const formData = new FormData();
        const serializedArray = form.serializeArray();
        const seen = new Set();

        let fileInput = $('input[name="' + provider + '_file"]');
        
        fileInput.each(function() {
            const name = $(this).data('name');
            const files = $(this).prop('files');

            if (files && files.length > 0) {
                Array.from(files).forEach(file => formData.append(`options[${name}]`, file));
            }
        });
        
        serializedArray.forEach(({ name, value }) => {
            value = value.trim();
            if (!value || seen.has(name)) return;
            
            if (!name.includes('[')) {
                seen.add(name);
                formData.append(name, value);
            } else if (name.startsWith(`${provider}[`) && name.includes(`[${model}]`)) {
                const dataName = name.match(/\[(.*?)\]/)[1];
                seen.add(dataName);
                formData.append(`options[${dataName}]`, value);
            } else if (name.startsWith(`${provider}[`) && !$(`[name="${name}"]`).parent().hasClass('hidden')) {
                const dataName = name.match(/\[(.*?)\]/)[1];
                seen.add(dataName);
                formData.append(`options[${dataName}]`, value);
            }
        });
        
        formData.append(`options[model]`, model);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            method: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(xhr) {
                $("#ImageForm .loader").removeClass('hidden');
                $('#image-creation').attr('disabled', 'disabled');
                xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
            },
            complete: function() {
                
            },
            success: function(response, textStatus, jqXHR) {

                if (textStatus == 'success' && jqXHR.status == 201) {
                    $("#ImageForm .loader").addClass('hidden');

                    $(".static-image-text").addClass('hidden');
                    let credit = $('.image-credit-remaining');
                    
                    // Image creadit balance update
                    if (!isNaN(credit.text()) && response.data.images != null && response.data.balance_reduce_type == 'subscription') {
                        credit.text(credit.text() - response.data.images.length);
                    }

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

                        $('#image-content').prepend(gethtml);
                        $(".loader").addClass('hidden');
                        $('#image-creation').removeAttr('disabled');
                    
                    toastMixin.fire({
                        title: jsLang('Image generated successfully.'),
                        icon: 'success'
                    });
                } else if (response.status == 'info') {
                    errorMessage(response.message, 'image-creation');
                } else {
                    errorMessage(jsLang('Something went wrong'), 'image-creation');
                }
            },
            error: function(error) {
                let message = error.responseJSON.message ? error.responseJSON.message : error.responseJSON.error
                errorMessage(message, 'image-creation');
            },
        });
})

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
