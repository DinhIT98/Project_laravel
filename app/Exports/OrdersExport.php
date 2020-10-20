<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\Models\orders;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class OrdersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('orders')->join('order_detail','orders.id','=','order_detail.order_id')
        ->select('id','user_name','user_phone','user_email','user_address','total_price','status','order_date','product_name','product_price','product_qty')
        ->get();
        // dd($data);
    }
    public function headings() :array {
    	return ["id", "name", "phone_number", "email","address","total","status","order_date","product_name","product_price","product_qty"];
    }
}
