<?php

namespace App\Exports;

use App\Services\ReportService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MovementsExport implements FromView
{
    public $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        return view('templates.xlsx.movements', [
            'movements' => ReportService::movements($this->filters)
        ]);
    }
}
