<?php

namespace Modules\MarketingBot\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\MarketingBot\Entities\Contact;

class SubscriberExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Contact::with('metas')->where('user_id', auth()->id())->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone',
            'Channel',
            'Status',
        ];
    }

    public function map($contact): array
    {
        return [
            $contact->name,
            $contact->phone ?? 'N/A',
            $contact->channel,
            ucfirst((string) $contact->status),
        ];
    }
}
