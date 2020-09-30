<?php

namespace App\Http\Controllers;
use App\Models\users;
use App\Models\orders;
use Illuminate\Support\Facades\DB;
use App\Models\dt_categories;
use App\Models\dt_products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUser(){
        $data=users::all();
        // $data->all();
        return view('admin.index1',['users'=>$data]);

    }
    public function showOrder(){
        $data=orders::all();
        return view('admin.order',['orders'=>$data]);
    }
    public function showCate(){
        $data=dt_categories::all();
        return view('admin.category',["category"=>$data]);
    }
    public function showProducts(){
        $data=dt_products::select(DB::raw('GROUP_CONCAT(path) as path,product_name,price,status,dt_products.id,warranty'))
        ->join('imageupload','dt_products.id','=','imageupload.content_id')
        ->groupBy('imageupload.content_id')
        ->get();
        dd($data);
        // $data=dt_products::all();
        return view('admin.product',['products'=>$data]);
    }
}
