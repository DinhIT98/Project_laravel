<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show_product(){
        $products=DB::table('dt_products')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->select('dt_products.id','product_name','price','status','warranty','path')
        ->limit(10)
        ->get();
        $category_1=DB::table('dt_categories')
        ->where('level',1)
        ->select('id','name')
        ->get();
        $category_2=DB::table('dt_categories')
        ->where('level',2)
        ->select('parent_id','name')
        ->get();
        $smartphone=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->select('dt_products.id','product_name','price','status','warranty','path')
        ->where('category_id',10)
        ->paginate(4);
        $laptop=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->select('dt_products.id','product_name','price','status','warranty','path')
        ->where('category_id',9)
        ->paginate(4);
        // $data=json_decode($products,true);
        // dd($products);
        return view('home',['laptop'=>$laptop,'smartphone'=>$smartphone,'products'=>$products,'category_1'=>$category_1,'category_2'=>$category_2]);
    }
    public function show_detail($id){
        $category_1=DB::table('dt_categories')
        ->where('level',1)
        ->select('id','name')
        ->get();
        $category_2=DB::table('dt_categories')
        ->where('level',2)
        ->select('parent_id','name')
        ->get();
        $product=DB::table('dt_products')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->where('dt_products.id',$id)
        ->select('dt_products.id','product_name','price','status','warranty','path','description')
        ->get();
        return view('detail',['product'=>$product,'category_1'=>$category_1,'category_2'=>$category_2]);
    }
    public function showProductByCategory($cate){
        $products=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->where('category_id',$cate)
        ->select('product_name')
        ->get();
        // dd($products);
        return "san pham thuoc category ${cate}";
    }
    public function showProductBySearch(){
        // use ajax
    }


}
