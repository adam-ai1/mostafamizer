@php
    $typeLower = strtolower($type);
    $inputId = $typeLower . '-variable-' . $item . '-fileInput';
    $previewId = $typeLower . '-variable-' . $item . '-preview';
    $previewSectionId = $typeLower . '-variable-' . $item . '-previewSection';
    $deleteBtnId = $typeLower . '-variable-' . $item . '-deleteBtn';
    $uploadLabelId = $typeLower . '-variable-' . $item . '-uploadLabel';
    $previewContainerId = $typeLower . '-variable-' . $item . '-previewContainer';
@endphp

<div class="space-y-1.5 mt-4">
    <label class="flex items-center gap-2 text-sm text-color-14 dark:text-white">
        {{ __('Variable :x' , ['x' => $item + 1]) }}
        <svg
            class="w-4 h-4 text-color-89 mb-0.5"
            fill="currentColor"
            viewBox="0 0 20 20">
            <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"
            />
        </svg>
    </label>
    <div class="relative w-full h-32 border-2 border-dashed border-color-DF dark:border-color-47 rounded-xl cursor-pointer hover:border-[#25D366] dark:hover:border-[#25D366] transition-all duration-300 bg-white dark:bg-color-33 group overflow-hidden">

        <!-- Hidden File Input -->
        <input 
            class="hidden file-upload-input" 
            type="file" 
            id="{{ $inputId }}" 
            name="{{ $name }}"
            accept="{{ $accept }}" 
            data-preview-id="{{ $previewId }}"
            data-preview-section-id="{{ $previewSectionId }}"
            data-delete-btn-id="{{ $deleteBtnId }}"
            data-upload-label-id="{{ $uploadLabelId }}"
            data-preview-container-id="{{ $previewContainerId }}"
            data-type="{{ $typeLower }}"
            data-item="{{ $item }}"
        />

        <!-- Label (Click to Upload) -->
        <label for="{{ $inputId }}" id="{{ $uploadLabelId }}" class="flex items-center justify-center w-full h-full text-center cursor-pointer">
            <div>
                <svg class="w-8 h-8 mx-auto mb-2 text-gray-400 group-hover:text-whatsapp transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                <p class="text-sm text-color-89">
                    <span class="font-semibold text-[#25D366]">{{ __('Choose File') }}</span>
                    {{ __('or drag it here') }} <br />
                    {{ __('(Max file size: :x MB)', ['x' => preference('file_size')]) }}
                </p>
            </div>
        </label>

        <!-- Preview Container -->
        <div id="{{ $previewContainerId }}" class="absolute inset-0 w-full h-full hidden">
            <!-- Image/Video Preview -->
            <img id="{{ $previewSectionId }}-img" class="absolute inset-0 w-full h-full object-cover hidden rounded-xl" />
            <video id="{{ $previewSectionId }}-video" class="absolute inset-0 w-full h-full object-cover hidden rounded-xl" controls></video>
            <!-- Document Preview -->
            <div id="{{ $previewSectionId }}-doc" class="absolute inset-0 w-full h-full flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-700 hidden rounded-xl p-2">
                <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <p id="{{ $previewSectionId }}-filename" class="text-xs text-gray-600 dark:text-gray-300 text-center break-all px-2"></p>
            </div>
        </div>

        <!-- Delete Button -->
        <button 
            type="button"
            id="{{ $deleteBtnId }}" 
            class="absolute top-2 right-2 bg-black/60 text-white p-1 rounded-full hidden z-10"
            data-input-id="{{ $inputId }}"
            data-preview-id="{{ $previewId }}"
            data-preview-section-id="{{ $previewSectionId }}"
            data-delete-btn-id="{{ $deleteBtnId }}"
            data-upload-label-id="{{ $uploadLabelId }}"
            data-preview-container-id="{{ $previewContainerId }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>