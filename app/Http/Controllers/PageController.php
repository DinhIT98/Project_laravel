<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show_product(){
        $products=DB::table('dt_products')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,GROUP_CONCAT(path) as path'))
        // ->select('dt_products.id','product_name','price','status','warranty','path')
        ->groupBy('imageupload.content_id')
        // ->limit(10)
        ->inRandomOrder(10)
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
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,GROUP_CONCAT(path) as path'))
        ->where('category_id',10)
        // ->select('dt_products.id','product_name','price','status','warranty','path')
        ->groupBy('imageupload.content_id')
        ->limit(4)
        ->get();
        $laptop=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->select('dt_products.id','product_name','price','status','warranty','path')
        ->where('category_id',9)
        ->paginate(4);
        // $data=json_decode($images,true);
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
        // $product=DB::table('dt_products')
        // ->join('imageupload','imageupload.content_id','=','dt_products.id')
        // ->where('dt_products.id',$id)
        // ->select('dt_products.id','product_name','price','status','warranty','path','description')
        // ->get();
        $product=DB::table('dt_products')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->where('dt_products.id',$id)
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,description,GROUP_CONCAT(path) as path'))
        ->groupBy('imageupload.content_id')
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
    public function checkout($id){
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
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,description,GROUP_CONCAT(path) as path'))
        ->groupBy('imageupload.content_id')
        ->get();
        return view('checkout',['product'=>$product,'category_1'=>$category_1,'category_2'=>$category_2]);

    }
    public function cart(){
        $category_1=DB::table('dt_categories')
        ->where('level',1)
        ->select('id','name')
        ->get();
        $category_2=DB::table('dt_categories')
        ->where('level',2)
        ->select('parent_id','name')
        ->get();
        return view('cart',['category_1'=>$category_1,'category_2'=>$category_2]);

    }


}
