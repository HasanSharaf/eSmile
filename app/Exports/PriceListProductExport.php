<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\PriceList\Entities\PriceListProduct;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PriceListProductExport implements FromCollection , WithHeadings
{


    protected $PriceListProducts;

    public function __construct($PriceListProducts)
    {
        $this->PriceListProducts = $PriceListProducts;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->PriceListProducts;
    }



    public function headings() :array
    {
        return [
            'id',
            'client_name',
            'price_list_id',
            'price_list_code',
            'name',
            'product_code',
            'price',
            'unit',
            'iva',
        ];
    }
}
