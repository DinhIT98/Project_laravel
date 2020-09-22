<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show_product(){
        $products=DB::table('dt_products')
        ->select('product_name','price','status','warranty')
        ->get();
        $category_1=DB::table('dt_categories')
        ->where('level',1)
        ->select('id','name')
        ->get();
        $category_2=DB::table('dt_categories')
        ->where('level',2)
        ->select('parent_id','name')
        ->get();
        // $data=json_decode($data,true);
        return view('home',['products'=>$products,'category_1'=>$category_1,'category_2'=>$category_2]);
    }
    public function showProductByCategory($cate){
        $products=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->where('category_id',$cate)
        ->select('product_name')
        ->get();
        dd($products);
        return "san pham thuoc category ${cate}";
    }
    public function showProductBySearch(){
        // use ajax
    }

}
