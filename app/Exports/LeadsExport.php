<?php

namespace App\Exports;

use App\Lead;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromQuery, WithMapping, WithHeadings
{
    /**
     * @return Builder
     */
    public function query()
    {
        return Lead::orderBy('created_at', 'desc');
    }

    public function map($lead): array
    {
        return [
            $lead->name,
            $lead->phone,
            $lead->email,
            $lead->source,
            $lead->createdBy->name,
            $lead->created_at->format('d-m-Y'),
            $lead->status->name
        ];
    }

    public function headings(): array
    {
        return [
            'Lead Name',
            'Phone',
            'Email',
            'Source',
            'Created By',
            'Created At',
            'Status'
        ];
    }
}
