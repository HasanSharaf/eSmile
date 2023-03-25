<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Modules\PriceList\Entities\PriceListProduct;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PricesImport implements ToModel, WithStartRow
{

    public $headers;

    public function startRow(): int
    {   
        return 2;
    }

    /**
     * @param array $row
     *
     * @return PriceListProduct|null
     */
    public function model(array $row)
    {
        if (!$this->headers) {
            $this->headers = $row;
            return null;
        }

        $data = array_combine($this->headers, $row);
        return new PriceListProduct($data);
    }
}