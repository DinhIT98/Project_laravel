<?php

namespace App\Http\Controllers;
use App\Models\users;
use App\Models\orders;
use Illuminate\Support\Facades\DB;
use App\Models\dt_categories;
use App\Models\dt_products;
use App\Models\imageupload;
use App\Models\products_categories;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        // dd($data);
        // $data=dt_products::all();
        return view('admin.product',['products'=>$data]);
    }
    public function insertProduct(){
        $category=dt_categories::select('id','name')
        ->where('level',1)
        ->get();
        return view('admin.insert_product',["category"=>$category]);
    }
    public function storeProduct(request $request){
        // $data=[$request->file('image'),$request->product_code,$request->product_name,$request->product_categorie,$request->product_description,$request->price,$request->status,$request->warranty,$request->image];
        // dd($data);
        $product=new dt_products();
        $product->product_code=$request->product_code;
        $product->product_name=$request->product_name;
        $product->description=$request->product_description;
        $product->price=$request->price;
        $product->status=$request->status;
        $product->warranty=$request->warranty;
        $product->save();
        $product_id=dt_products::selectRaw('max(id)')->get();
        $id=$product_id[0]['max(id)'];

        $products_categories= new products_categories();
        $products_categories->product_id=$id;
        $products_categories->category_id=$request->product_categorie;
        $products_categories->save();
        foreach($request->file('image') as $key=> $image){
            $image_path=new imageupload();
            $image_path->content_id=$id;
            $image_path->path=$image->getClientOriginalName();
            $image_path->save();
            // $image = $request->file('image');
            // $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));
        }


        echo "<script>alert('insert product success!')</script>";
        return redirect()->to('/admin/products');

        // return "<script>alert('insert product success!')</script>";



    }
    public function deleteProduct($id){
        dt_products::where("id",$id)->delete();
        $images=imageupload::selectRaw('GROUP_CONCAT(path) as path')
        ->where('content_id',$id)
        ->get();
        $images=json_decode($images,true);
        $path=explode(",", $images[0]['path']);
        foreach($path as $val){
            Storage::disk('public')->delete( $val);
        }
        imageupload::where("content_id",$id)->delete();
        products_categories::where("product_id",$id)->delete();
        return redirect()->to('/admin/products');

    }
    public function insertCategory(){
        return view('admin.insert_category');
    }
    public function editProduct($id){
        $products=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->where('dt_products.id',$id)
        ->select(DB::raw('dt_products.id,category_id,product_name,product_code,description,price,status,warranty,GROUP_CONCAT(path) as path'))
        ->groupBy('imageupload.content_id')
        ->get();
        $category=dt_categories::select('id','name')
        ->where('level',1)
        ->get();

        return view('admin.edit_product',['products'=>$products,'category'=>$category]);
    }
    public function storeEditProduct(request $request){
        // $data=[$request->product_id,$request->product_code,$request->product_name,$request->product_description,$request->price,$request->status,$request->warranty];
        // dd($data);


        dt_products::where('id', $request->product_id)
        ->update(['product_code' => $request->product_code,'product_name'=>$request->product_name,'description'=>$request->product_description,'price'=>$request->price,'status'=>$request->status,'warranty'=>$request->warranty]);

        products_categories::where('product_id',$request->product_id)
        ->update(['category_id'=>$request->product_categorie]);
        // dd($request->file('image'));
        foreach($request->file('image') as $key=> $image){

            $image_path=new imageupload();
            $image_path->content_id=$request->product_id;
            $image_path->path=$image->getClientOriginalName();
            $image_path->save();
                // $image = $request->file('image');
                // $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));
        }


        return redirect()->to('/admin/products');
    }
    public function imageDelete(request $request){
        $path=$request->path;
        imageupload::where("path",$path)->delete();
        Storage::disk('public')->delete($path);
        return redirect()->back();
    }
}
