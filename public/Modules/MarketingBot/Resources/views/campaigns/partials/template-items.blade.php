@forelse ($templates as $template)
    @php
        $selectedTemplateId = request()->old('template') ?? (isset($selectedTemplate) ? $selectedTemplate : '');
        $isSelected = $selectedTemplateId == $template->id;
    @endphp
    <div class="px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer {{ $isSelected ? 'bg-color-F6 dark:bg-color-3A font-medium' : '' }}" data-val="{{ $template->id }}" data-name="{{ ucfirst(str_replace(['_', '-'], ' ', $template->title)) }}" onclick="selectTemplate(this)">{{ ucfirst(str_replace(['_', '-'], ' ', $template->title)) }}</div>
@empty

    <div class="px-4 py-8 text-center">
        <svg class="mx-auto h-12 w-12 text-color-89 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-sm text-color-89 dark:text-gray-400">{{ __('No templates found') }}</p>
        <p class="text-xs text-color-89 dark:text-gray-500 mt-1">{{ __('Try adjusting your search terms') }}</p>
    </div>
    
@endforelse


