@php
    $randomId = uniqid();
    $isHidden = $isHidden ?? false;
@endphp

@if ($meta['is_visible'])
    <div class="flex items-center text-color-14 dark:text-white text-14 font-medium font-Figtree gap-[9px]{{ $isHidden ? ' hidden' : '' }}">
        {!! $meta['status'] == 'Active' ? sprintf($activeIconSvg, $randomId, $randomId) : $inactiveIconSvg !!}
        @if ($meta['type'] != 'number')
            <span class="break-words"> {{ __($meta['title']) }} </span>
        @elseif ($meta['title_position'] == 'before')
            <span class="break-words"> {{ __($meta['title']) . ': ' }} {{ ($meta['value'] == -1) ? __('Unlimited') : $meta['value'] }} </span>
        @else
            <span class="break-words"> {{ ($meta['value'] == -1 ? __('Unlimited') : $meta['value']) }} {{ __($meta['title']) }} </span>
        @endif
    </div>
@endif
