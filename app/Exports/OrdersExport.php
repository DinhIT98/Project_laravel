<?php

namespace App\Exports;

use App\Models\orders;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data=orders::with('order_detail')->get();
        dd($data);
    }
}
