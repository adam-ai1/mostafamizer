<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $presentation->topic }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .slide { page-break-after: always; background: #0f172a; color: #e5e7eb; padding: 28px; margin: 12px; border-radius: 12px; border: 1px solid #1f2937; }
        .slide h2 { margin: 0 0 12px 0; font-size: 20px; color: #a78bfa; }
        .meta { font-size: 12px; color: #9ca3af; margin-bottom: 10px; }
        ul { padding-left: 18px; margin: 0 0 12px 0; }
        li { margin-bottom: 6px; }
        .box { background: #111827; border: 1px solid #1f2937; padding: 10px; border-radius: 8px; color: #cbd5e1; }
        .title-slide { text-align: center; padding: 60px 30px; }
        .title-slide h1 { color: #a78bfa; margin-bottom: 12px; }
        .footer { font-size: 11px; color: #6b7280; text-align: right; margin-top: 12px; }
    </style>
</head>
<body>
    @foreach($slides as $slide)
        <div class="slide">
            @if($loop->first)
                <div class="title-slide">
                    <h1>{{ $presentation->topic }}</h1>
                    <p class="meta">{{ __('Style') }}: {{ $presentation->style }} | {{ __('Slides') }}: {{ $presentation->slides_count }}</p>
                </div>
            @endif
            <h2>{{ $slide['slide_number'] ?? $loop->iteration }}. {{ $slide['title'] ?? '' }}</h2>
            @if(!empty($slide['content']) && is_array($slide['content']))
                <ul>
                    @foreach($slide['content'] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            @endif
            @if(!empty($slide['visual_suggestion']))
                <div class="box" style="margin-bottom:8px;">
                    <strong>{{ __('Visual Suggestion:') }}</strong><br>
                    {{ $slide['visual_suggestion'] }}
                </div>
            @endif
            @if(!empty($slide['speaker_notes']))
                <div class="box">
                    <strong>{{ __('Speaker Notes:') }}</strong><br>
                    {{ $slide['speaker_notes'] }}
                </div>
            @endif
            <div class="footer">{{ __('Generated presentation') }} • {{ now()->format('Y-m-d H:i') }}</div>
        </div>
    @endforeach
</body>
</html>
