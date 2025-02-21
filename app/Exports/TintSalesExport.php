<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TintSalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $sale;

    public function __construct($sale)
    {
        $this->sale = $sale;
    }

    public function collection()
    {
        return $this->sale;
    }

    public function headings(): array
    {
        return ["Date", "Car Model", "Car Plate", "Product", "FWS", "RWS", "R1", "R2", "L1", "L2", "R3", "L3", "SRF","SRF 2","SRF Big",'TC','TRC','Created At'];
    }

    public function map($sale): array
    {
        return [
            $sale->sales_date,
            $sale->car_model,
            $sale->carplate,
            $sale->product,
            ($sale->fws_worker->username ?? '') . ' ' . ($sale->fws_remove_worker->username ?? ''),
            ($sale->rws_worker->username ?? '') . ' ' . ($sale->rws_remove_worker->username ?? ''),
            ($sale->r1_worker->username ?? '') . ' ' . ($sale->r1_remove_worker->username ?? ''),
            ($sale->r2_worker->username ?? '') . ' ' . ($sale->r2_remove_worker->username ?? ''),
            ($sale->l1_worker->username ?? '') . ' ' . ($sale->l1_remove_worker->username ?? ''),
            ($sale->l2_worker->username ?? '') . ' ' . ($sale->l2_remove_worker->username ?? ''),
            ($sale->r3_worker->username ?? '') . ' ' . ($sale->r3_remove_worker->username ?? ''),
            ($sale->l3_worker->username ?? '') . ' ' . ($sale->l3_remove_worker->username ?? ''),
            ($sale->srf_worker->username ?? '') . ' ' . ($sale->srf_remove_worker->username ?? ''),
            ($sale->srf2_worker->username ?? '') . ' ' . ($sale->srf2_remove_worker->username ?? ''),
            ($sale->srfbig_worker->username ?? '') . ' ' . ($sale->srfbig_remove_worker->username ?? ''),
            $sale->total??0,
            $sale->total_remove_commission??0,
            $sale->created_at->format('Y-m-d H:i:s'),
        ];
    }
}