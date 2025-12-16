@php
    $hasHeader = false;
    $hasBody = false;
    $hasButtons = false;
    
    // First pass: Check if sections have variables
    foreach ($variables as $key => $variable) {
        $type = $variable['type'];
        $format = $variable['format'] ?? null;
        
        if ($type === 'HEADER') {
            if ($format === 'TEXT' && isset($variable['example']['header_text']) && !empty($variable['example']['header_text'])) {
                $hasHeader = true;
            } elseif (in_array($format, ['IMAGE', 'DOCUMENT', 'VIDEO'])) {
                $hasHeader = true;
            }
        } elseif ($type === 'BODY' && isset($variable['example']['body_text'][0]) && !empty($variable['example']['body_text'][0])) {
            $hasBody = true;
        } elseif ($type === 'BUTTONS' && isset($variable['buttons']) && !empty($variable['buttons'])) {
            // Check if any button has dynamic values
            foreach ($variable['buttons'] as $btn) {
                if (in_array($btn['type'], ['COPY_CODE', 'URL'])) {
                    $hasButtons = true;
                    break;
                }
            }
        }
    }
@endphp

@foreach ($variables as $key => $variable)
    @php
        $type = $variable['type'];
        $format = $variable['format'] ?? null;
    @endphp

    {{-- HEADER --}}
    @if ($type === 'HEADER' && $hasHeader)
        @php
            $headerHasContent = false;
            if ($format === 'TEXT' && isset($variable['example']['header_text']) && !empty($variable['example']['header_text'])) {
                $headerHasContent = true;
            } elseif (in_array($format, ['IMAGE', 'DOCUMENT', 'VIDEO'])) {
                $headerHasContent = true;
            }
        @endphp
        
        @if ($headerHasContent)
            @include('marketingbot::campaigns.partials.header', [
                'type' => $type, 
                'item' => 0
            ])

            @if ($format === 'TEXT' && isset($variable['example']['header_text']))
                @foreach ($variable['example']['header_text'] as $headerKey => $headerVal)
                    @include('marketingbot::campaigns.partials.input', [ 'event' => 'setPreviewValue(this, \'#' . strtolower($type) . '-variable-' . $headerKey . '-preview\')',  'type' => $type, 'item' => $headerKey, 'value' => $headerVal, 'name' => strtolower($type)  . '[' . $headerKey . ']'])
                @endforeach
            @endif

            @if (in_array($format, ['IMAGE', 'DOCUMENT', 'VIDEO']))
                @php
                    $acceptTypes = [ 'IMAGE' => 'image/*', 'DOCUMENT' => 'application/pdf', 'VIDEO' => 'video/*'];
                @endphp

                @include('marketingbot::campaigns.partials.file', ['event' => 'setPreviewValue(this, \'#' . strtolower($type) . '-variable-' . $key . '-preview\')',  'type' => $type, 'item' => $key, 'value' => $variable['example']['header_handle'][0] ?? null, 'accept' => $acceptTypes[$format], 'name' => strtolower($type)  . '[' . $key . ']'])
            @endif
        @endif
    @endif

    {{-- BODY --}}
    @if ($type === 'BODY' && $hasBody && isset($variable['example']['body_text'][0]) && !empty($variable['example']['body_text'][0]))
        @php
            $bodyIndex = 0;
        @endphp
        @foreach ($variable['example']['body_text'][0] as $itemKey => $val)
            @include('marketingbot::campaigns.partials.header', ['type' => $type, 'item' => $bodyIndex])

            @include('marketingbot::campaigns.partials.input', ['event' => 'setPreviewValue(this, \'#' . strtolower($type) . '-variable-' . $itemKey . '-preview\')',  'type' => $type, 'item' => $itemKey, 'value' => $val, 'name' => strtolower($type)  . '[' . $itemKey . ']'])
            @php
                $bodyIndex++;
            @endphp
        @endforeach
    @endif

    {{-- BUTTONS --}}
    @if ($type === 'BUTTONS' && $hasButtons && isset($variable['buttons']) && !empty($variable['buttons']))
        @php
            $buttonIndex = 0;
        @endphp
        @foreach ($variable['buttons'] as $keybtn => $item)
            @if (in_array($item['type'], ['COPY_CODE', 'URL']))
                @include('marketingbot::campaigns.partials.header', ['type' => $type, 'item' => $buttonIndex])

                @php
                    $inputValue = $item['type'] === 'COPY_CODE'  ? ($item['example'][0] ?? null): ($item['text'] ?? null);
                @endphp

                @include('marketingbot::campaigns.partials.input', ['event' => 'setPreviewValue(this, \'#' . strtolower($type) . '-variable-' . $keybtn . '-preview\')',  'type' => $type, 'item' => $keybtn, 'value' => $inputValue, 'name' => strtolower($type)  . '[' . $keybtn . ']'])
                @php
                    $buttonIndex++;
                @endphp
            @endif
        @endforeach
    @endif
@endforeach