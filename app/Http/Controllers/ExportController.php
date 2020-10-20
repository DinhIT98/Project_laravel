<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\ProductsExport;
use App\Exports\OrdersExport;
class ExportController extends Controller
{
    public function fileExportUsers(){
        return Excel::download(new UsersExport, 'users-collection.csv');
    }
    public function fileExportProducts(){
        return Excel::download(new ProductsExport, 'product_export.csv');
    }
    public function fileExportOrders(){
        return Excel::download(new OrdersExport,'orders_export.csv');
    }
}
