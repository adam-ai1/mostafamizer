<?php

namespace Modules\MarketingBot\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\MarketingBot\Entities\Segment;

class SegmentListExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Segment::with('metas')->where('user_id', auth()->id())->orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Status',
        ];
    }

    public function map($segment): array
    {
        return [
            $segment->name,
            $segment->description,
            ucfirst((string) $segment->status),
        ];
    }
}
