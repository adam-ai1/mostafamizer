<?php

namespace Modules\MarketingBot\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\MarketingBot\Entities\MarketingCampaign;

class CampaignExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return MarketingCampaign::with('metas')
            ->where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Title',
            'Content',
            'Channel',
            'Status',
        ];
    }

    public function map($campaign): array
    {
        return [
            $campaign->title,
            $campaign->content,
            $campaign->channel,
            ucfirst((string) $campaign->status),
        ];
    }
}
