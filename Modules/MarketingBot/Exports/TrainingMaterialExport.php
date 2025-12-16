<?php

namespace Modules\MarketingBot\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\OpenAI\Entities\EmbededResource;

class TrainingMaterialExport implements FromCollection, WithHeadings, WithMapping
{
    protected int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function collection(): Collection
    {
        return EmbededResource::where([
            ['user_id', $this->userId],
            ['category', 'campaign'],
        ])
            ->orderBy('id', 'desc')
            ->get(['name', 'type']);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Type',
        ];
    }

    public function map($materials): array
    {
        return [
            $materials->name,
            $materials->type,
        ];
    }
}
