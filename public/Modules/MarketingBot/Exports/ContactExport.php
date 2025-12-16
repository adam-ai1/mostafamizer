<?php

namespace Modules\MarketingBot\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\MarketingBot\Entities\Contact;

class ContactExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Contact::with('metas')->where([
            ['user_id', Auth::id()],
        ])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone',
            'Country Code',
            'Channel',
            'Status',
        ];
    }

    public function map($contacts): array
    {
        return [
            $contacts->name,
            $contacts->phone,
            $contacts->country_code,
            $contacts->channel,
            $contacts->status,
        ];
    }
}
