<button {{ $attributes->merge([
        'class' => 'btn btn-square btn-light f-w-600 btn-sm mb-0 ltr:me-1 rtl:ms-1',
        'type' => 'button',
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#animateModal',
        'data-pc-animate' => 'blur',
    ]) }}>
    <span class="{{ $iconClass ?? 'fa fa-plus' }}"> &nbsp;</span> {{ $label ?? __('Add New') }}
</button>