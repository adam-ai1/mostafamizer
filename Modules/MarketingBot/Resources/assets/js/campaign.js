"use strict";

// Toggle dropdown visibility
function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick*="toggleDropdown"]')) {
        const dropdowns = document.querySelectorAll('.campaign-dropdown, [id$="-dropdown"]');
        dropdowns.forEach(dropdown => {
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });
    }
});

$(document).on('submit', '#campaign-form', function(e) {
    e.preventDefault();
    const form = $(this);
    const data = new FormData(this);
    const submitButton = form.find('button[type="submit"]');

    // Helper function to reset submit button state
    function resetSubmitButton() {
        submitButton.prop('disabled', false)
            .find('span.button-name').text(jsLang('Start Campaign')).end()
            .find('.arrow-icon').removeClass('hidden').end()
            .find('.loader-icon').addClass('hidden');
    }
    $.ajax({
        url: route,
        type: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
            submitButton.prop('disabled', true)
                .find('.loader-icon').removeClass('hidden').end()
                .find('span.button-name').text(jsLang('Sending...')).end()
                .find('.arrow-icon').addClass('hidden');
        },
        success: function(response) {

            // Check if response indicates demo mode or info status
            if (response.status === 'info') {
                toastMixin.fire({
                    title: response.message,
                    icon: 'error',
                });
                resetSubmitButton();
                return;
            }

            resetSubmitButton();

            toastMixin.fire({
                title: response.message,
                icon: 'success',
            });
        },
        error: function(xhr, status, error) {
            resetSubmitButton();

            toastMixin.fire({
                title: xhr.responseJSON?.error,
                icon: 'error',
            });
        },
        complete: function() {
            resetSubmitButton();
        }
    });
});

$(document).on('click', '.openModalBtn', function() {
    $('.delete-campaign').attr('data-id', $(this).data('id'));
});

$(document).on('click', '.delete-campaign', function () {
    let id = $(this).attr("data-id");
    $(".loader").removeClass('hidden');
    $('.delete-campaign').attr('disabled');
    
    doAjaxprocess(
        SITE_URL + "/user/marketing-bot/campaigns/delete/" + id,
        {
            id : id,
            _token: CSRF_TOKEN
        },
        'delete',
        'json'
    ).done(function(response, textStatus, jqXHR) {
        // Check if response indicates demo mode or info status
        if (response.status === 'info') {
            toastMixin.fire({
                title: response.message,
                icon: 'error',
            });
            $(".loader").addClass('hidden');
            $('.delete-campaign').removeAttr('disabled');
            $('.closeModalBtn').click();
            return;
        }

        toastMixin.fire({
            title: response.message,
            icon: 'success',
        });
        $('#campaign-row-'+id).remove();
        $(".loader").addClass('hidden');
        $('.delete-campaign').removeAttr('disabled');
        $('.closeModalBtn').click();

    }).fail(function(jqXHR, textStatus, errorThrown) {
        toastMixin.fire({
            title: JSON.parse(jqXHR.responseText).error ,
            icon: textStatus,
        });
        $(".loader").addClass('hidden');
        $('.delete-campaign').removeAttr('disabled');
        $('.closeModalBtn').click();
    });
});

function selectTemplate(e) {
    let templateValue = $(e).data('val');
    let templateName = $(e).data('name');

    $('#template').val(templateValue);
    $('#template-name').text(templateName);
}
       
$(document).on('click', '.step-button', function (e) {
    e.preventDefault();

    const btn = $(this);
    const isBack = btn.hasClass('back-button');
    let step = parseInt(btn.attr('data-step')) || 1;

    if (!isBack && step === 1) {

        let isValid = true;
        $('.campaign-form .form-control[required]').each(function() {
            if (!this.checkValidity()) {
                // Trigger the invalid event to show error messages
                $(this).trigger('invalid');
                isValid = false;
            }
        });
        
        if (!isValid) {
            return false;
        }

        // Fetch template data via AJAX
        const templateId = $('#template').val();
        
        $.ajax({
            url: SITE_URL + `/user/marketing-bot/campaigns/whatsapp/template/${templateId}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
            },
            success: function(response) {
                $('.variable-form').html(response.variableForm);
                $('.preview-section').html(response.previewForm);
                
                // Proceed to next step after successful AJAX
                proceedToStep(step + 1);
            },
            error: function(xhr, status, error) {
                toastMixin.fire({
                    title: error,
                    icon: 'error'
                });
            }
        });
        
        return; // Exit early, let AJAX success handler continue
    }

    // Handle back button or other steps
    const nextStep = isBack ? step - 1 : step + 1;
    proceedToStep(nextStep);
});

function proceedToStep(step) {
    // Clamp step between 1–3
    step = Math.max(1, Math.min(3, step));

    // Toggle form visibility
    $('.campaign-form').toggleClass('hidden', step !== 1);
    $('.variable-form').toggleClass('hidden', step !== 2);
    $('.final-form').toggleClass('hidden', step !== 3);

    // Back button visibility
    $('.back-button').toggleClass('hidden', step === 1);

    // Get the forward button (not back button)
    const $forwardButton = $('button[data-step]:not(.back-button)');
    
    // Update button label
    const buttonText = step === 3 ? jsLang('Start Campaign') : jsLang('Next');
    $('.button-name').text(buttonText);

    // Change forward button type and class
    const buttonType = step === 3 ? 'submit' : 'button';
    
    if (step === 3) {
        // Remove step-button class and change to submit
        $forwardButton.removeClass('step-button').prop('type', buttonType);
    } else {
        // Add step-button class back if it was removed and change to button
        $forwardButton.addClass('step-button').prop('type', buttonType);
    }

    // Update stepper visual state
    $('.StepperParent .Stepper').each(function (i) {
        const activeIndex = step - 1;
        const $emptyState = $(this).find('.empty-circle');
        const $fullState = $(this).find('.full-circle');

        if (i <= activeIndex) {
            $emptyState.addClass('hidden');
            $fullState.removeClass('hidden');
        } else {
            $emptyState.removeClass('hidden');
            $fullState.addClass('hidden');
        }
    });

    // Update step data attribute
    $('.step-button').attr('data-step', step).data('step', step);
    $forwardButton.attr('data-step', step).data('step', step);
}

function setPreviewValue(element, id) {
    const value = $(element).val();
    
    // Find the strong element
    const target = $('.template-container').find('strong' + id);
    
    if (target.length > 0) {
        target.text(value);
    }
}

// Handle file preview for all file types (IMAGE, DOCUMENT, VIDEO)
function handleFilePreview(input) {
    const file = input.files[0];
    if (!file) return;

    const $input = $(input);
    const previewId = $input.data('preview-id');
    const previewSectionId = $input.data('preview-section-id');
    const deleteBtnId = $input.data('delete-btn-id');
    const uploadLabelId = $input.data('upload-label-id');
    const previewContainerId = $input.data('preview-container-id');

    const $previewContainer = $('#' + previewContainerId);
    const $previewImg = $('#' + previewSectionId + '-img');
    const $previewVideo = $('#' + previewSectionId + '-video');
    const $previewDoc = $('#' + previewSectionId + '-doc');
    const $previewFilename = $('#' + previewSectionId + '-filename');
    const $deleteBtn = $('#' + deleteBtnId);
    const $uploadLabel = $('#' + uploadLabelId);

    const fileType = file.type;
    const isImage = fileType.startsWith('image/');
    const isVideo = fileType.startsWith('video/');
    const isDocument = fileType === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');

    // Hide all preview types first
    $previewImg.addClass('hidden');
    $previewVideo.addClass('hidden');
    $previewDoc.addClass('hidden');

    const reader = new FileReader();

    if (isImage) {
        reader.onload = function(e) {
            $previewImg.attr('src', e.target.result);
            $previewImg.removeClass('hidden');
            $previewContainer.removeClass('hidden');
            $uploadLabel.addClass('hidden');
            $deleteBtn.removeClass('hidden');

            // Update preview section
            updatePreviewSection(previewId, e.target.result, 'image');
        };
        reader.readAsDataURL(file);
    } else if (isVideo) {
        reader.onload = function(e) {
            $previewVideo.attr('src', e.target.result);
            $previewVideo.removeClass('hidden');
            $previewContainer.removeClass('hidden');
            $uploadLabel.addClass('hidden');
            $deleteBtn.removeClass('hidden');

            // Update preview section
            updatePreviewSection(previewId, e.target.result, 'video');
        };
        reader.readAsDataURL(file);
    } else if (isDocument) {
        $previewFilename.text(file.name);
        $previewDoc.removeClass('hidden');
        $previewContainer.removeClass('hidden');
        $uploadLabel.addClass('hidden');
        $deleteBtn.removeClass('hidden');

        // For PDF, try to create object URL for preview
        const objectUrl = URL.createObjectURL(file);
        updatePreviewSection(previewId, objectUrl, 'document', file.name);
    } else {
        // Fallback for other file types
        $previewFilename.text(file.name);
        $previewDoc.removeClass('hidden');
        $previewContainer.removeClass('hidden');
        $uploadLabel.addClass('hidden');
        $deleteBtn.removeClass('hidden');

        updatePreviewSection(previewId, '', 'document', file.name);
    }
}

// Store object URLs for cleanup
const objectUrlStore = {};

// Update preview section with uploaded file
function updatePreviewSection(previewId, fileUrl, fileType, fileName) {
    const $previewElement = $('.template-container').find('#' + previewId);
    
    if ($previewElement.length > 0) {
        // Clean up previous object URL if exists
        if (objectUrlStore[previewId]) {
            URL.revokeObjectURL(objectUrlStore[previewId]);
            delete objectUrlStore[previewId];
        }

        if (fileType === 'image') {
            // If it's an img element, update src
            if ($previewElement.is('img')) {
                $previewElement.attr('src', fileUrl);
            } else {
                // If it's a container, add/update img inside
                $previewElement.html('<img src="' + fileUrl + '" alt="preview" class="w-full h-auto rounded-lg" />');
            }
        } else if (fileType === 'video') {
            // Store object URL for cleanup
            if (fileUrl && fileUrl.startsWith('blob:')) {
                objectUrlStore[previewId] = fileUrl;
            }
            // If it's a video element, update src
            if ($previewElement.is('video')) {
                $previewElement.attr('src', fileUrl);
            } else {
                // If it's a container, add/update video inside
                $previewElement.html('<video src="' + fileUrl + '" controls class="w-full h-auto rounded-lg"></video>');
            }
        } else if (fileType === 'document') {
            // Store object URL for cleanup
            if (fileUrl && fileUrl.startsWith('blob:')) {
                objectUrlStore[previewId] = fileUrl;
            }
            // For documents, show file name or PDF preview
            if (fileUrl) {
                $previewElement.html('<iframe src="' + fileUrl + '" class="w-full h-64 rounded-lg" frameborder="0"></iframe>');
            } else {
                $previewElement.html('<div class="p-4 bg-gray-100 rounded-lg"><p class="text-sm text-gray-600">' + (fileName || 'Document') + '</p></div>');
            }
        }
    }
}

// Remove file preview
function removeFilePreview(inputId, previewId, previewSectionId, deleteBtnId, uploadLabelId, previewContainerId) {
    const $input = $('#' + inputId);
    const $previewContainer = $('#' + previewContainerId);
    const $previewImg = $('#' + previewSectionId + '-img');
    const $previewVideo = $('#' + previewSectionId + '-video');
    const $previewDoc = $('#' + previewSectionId + '-doc');
    const $deleteBtn = $('#' + deleteBtnId);
    const $uploadLabel = $('#' + uploadLabelId);
    const $previewElement = $('.template-container').find('#' + previewId);

    // Clear file input
    $input.val('');

    // Revoke object URLs if any
    const videoSrc = $previewVideo.attr('src');
    if (videoSrc && videoSrc.startsWith('blob:')) {
        URL.revokeObjectURL(videoSrc);
    }

    // Clean up stored object URL
    if (objectUrlStore[previewId]) {
        URL.revokeObjectURL(objectUrlStore[previewId]);
        delete objectUrlStore[previewId];
    }

    // Hide previews
    $previewImg.addClass('hidden').attr('src', '');
    $previewVideo.addClass('hidden').attr('src', '');
    $previewDoc.addClass('hidden');
    $previewContainer.addClass('hidden');
    $deleteBtn.addClass('hidden');
    $uploadLabel.removeClass('hidden');

    // Clear preview section
    if ($previewElement.length > 0) {
        $previewElement.empty();
    }
}

// Event delegation for file upload inputs
$(document).on('change', '.file-upload-input', function() {
    handleFilePreview(this);
});

// Event delegation for delete buttons
$(document).on('click', '[id$="-deleteBtn"]', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    const $btn = $(this);
    const inputId = $btn.data('input-id');
    const previewId = $btn.data('preview-id');
    const previewSectionId = $btn.data('preview-section-id');
    const deleteBtnId = $btn.data('delete-btn-id');
    const uploadLabelId = $btn.data('upload-label-id');
    const previewContainerId = $btn.data('preview-container-id');

    removeFilePreview(inputId, previewId, previewSectionId, deleteBtnId, uploadLabelId, previewContainerId);
});

$(document).on('change', '#chatProvider', function() {
    var selectedProvider = $(this).val();
    $('.ProviderOptions').addClass('hidden');
    $('.' + selectedProvider + '_div').removeClass('hidden');
});

$(document).on('change', '#embeddingProvider', function() {
    var selectedProvider = $(this).val();
    $('.EmbeddingProviderOptions').addClass('hidden');
    $('.' + selectedProvider + '_div').removeClass('hidden');
});
