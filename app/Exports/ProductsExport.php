<?php

namespace App\Exports;
use App\Models\dt_products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return dt_products::select("id", "product_code", "product_name", "price","status","warranty","created_at","updated_at")->get();
    }
    public function headings() :array {
    	return ["id", "product_code", "product_name", "price","status","warranty","created_at","updated_at"];
    }
}
