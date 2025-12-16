<?php

namespace Modules\MarketingBot\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\MarketingBot\Entities\Segment;

class GroupExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Segment::with('metas')->where('user_id', auth()->id())->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Status',
        ];
    }

    public function map($group): array
    {
        return [
            ucfirst($group->name),
            $group->description ?? 'N/A',
            ucfirst((string) $group->status),
        ];
    }
}
