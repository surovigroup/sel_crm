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
        return Lead::query();
    }

    public function map($lead): array
    {
        return [
            $lead->name,
            $lead->phone,
            $lead->email,
            $lead->createdBy->name,
            $lead->status->name
        ];
    }

    public function headings(): array
    {
        return [
            'Lead Name',
            'Phone',
            'Email',
            'Created By',
            'Status'
        ];
    }
}
