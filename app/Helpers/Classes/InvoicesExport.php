<?php 

namespace App\Helpers\Classes;

use App\Helpers\Classes;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromArray, WithHeadings
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        return $this->invoices;

    }

    public function headings() :array
    {
        return [
            "Name",

        ];
    }
}



