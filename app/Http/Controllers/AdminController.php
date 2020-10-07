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
        $data=dt_products::with('imageupload','products_categories')->get();
        return view('admin.product',['products'=>$data]);
    }
    public function insertProduct(){
        $category=new dt_categories();
        $data=$category->getCategory_1();
        return view('admin.insert_product',["category"=>$data]);
    }
    public function storeProduct(request $request){
        $product=new dt_products();
        $product->insert($request->product_code,$request->product_name,$request->product_description,$request->price,$request->status,$request->warranty);
        $product_id=dt_products::selectRaw('max(id)')->get();
        $id=$product_id[0]['max(id)'];
        $products_categories= new products_categories();
        $products_categories->insert($id,$request->product_categorie);

        foreach($request->file('image') as $key=> $image){
            $image_path=new imageupload();
            $image_path->insert($id,$image->getClientOriginalName());
            Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));
        }

        return redirect()->to('/admin/products');
    }
    public function deleteProduct($id){
        dt_products::where("id",$id)->delete();
        $images=imageupload::selectRaw('GROUP_CONCAT(path) as path')
        ->where('content_id',$id)
        ->get();
        $images=json_decode($images,true);
        // $path=explode(",", $images[0]['path']);
        // foreach($path as $val){
        //     Storage::disk('public')->delete( $val);
        // }
        imageupload::where("content_id",$id)->delete();
        products_categories::where("product_id",$id)->delete();
        return redirect()->to('/admin/products');

    }
    public function insertCategory(){
        return view('admin.insert_category');
    }
    public function editProduct($id){

        $products=dt_products::with('imageupload','products_categories')->where('id',$id)->get();
        $category=new dt_categories();
        $cate=$category->getCategory_1();
        return view('admin.edit_product',['products'=>$products,'category'=>$cate]);
    }
    public function storeEditProduct(request $request){
        dt_products::where('id', $request->product_id)
        ->update(['product_code' => $request->product_code,'product_name'=>$request->product_name,'description'=>$request->product_description,'price'=>$request->price,'status'=>$request->status,'warranty'=>$request->warranty,'updated_at'=>now()]);
        products_categories::where('product_id',$request->product_id)
        ->update(['category_id'=>$request->product_categorie]);
        if($request->file('image')){
            foreach($request->file('image') as $key=> $image){
                $image_path=new imageupload();
                $image_path->insert($id,$image->getClientOriginalName());
                Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));
            }
        }
        return redirect()->to('/admin/products');
    }
    public function imageDelete(request $request){
        $path=$request->path;
        imageupload::where("path",$path)->delete();
        // Storage::disk('public')->delete($path);
        return redirect()->back();
    }
    public function updateStatusOrder($id){
        $order=orders::where('id',$id)
        ->select('status','id')
        ->get();
        $order=json_decode($order,true);
        return view('admin.update_order',['order'=>$order]);
    }
    public function storeStatusOrder(request $request){
        orders::where('id',$request->id)
        ->update(['status'=>$request->status]);
        return redirect()->to('/admin/order');
    }
    public function deleteUser($id){
        users::where('id',$id)->delete();
        return redirect()->back();
    }
    public function deleteCategory($id){
        $category=dt_categories::where('id',$id)
        ->select('level','parent_id')
        ->get();
        if($category[0]['level']==2){
            dt_categories::where('id',$id)->delete();
            return redirect()->back();
        }else{
            dt_categories::where('id',$id)->delete();
            dt_categories::where('parent_id',$id)->delete();
            return redirect()->back();
        }
    }
    public function editCategory($id){
        $category=dt_categories::where('id',$id)->get();
        $category_1=dt_categories::where('level',"1")->get();
        return view('admin.edit_category',['category'=>$category,'category_1'=>$category_1]);
    }
    public function storeEditCate(request $request){
        if(!$request->parent_id){
            dt_categories::where('id',$request->id)
            ->update(['name'=>$request->name,'level'=>$request->level]);
            return redirect()->to('/admin/category');
        }else{
            dt_categories::where('id',$request->id)
            ->update(['name'=>$request->name,'level'=>$request->level,'parent_id'=>$request->parent_id]);
            return redirect()->to('/admin/category');
        }

    }
    public function insertCate_2(){
        $category_1=dt_categories::where('level',"1")->get();
        return view('admin.insert_category_2',["category_1"=>$category_1]);
    }
    public function insertCate_1(){
        return view('admin.insert_category_1');
    }
    public function storeInsertCate_1(request $request){
        if($request){
            $category=new dt_categories();
            $category->insert($request->name,$request->level,$request->parent_id);
            return redirect()->to('/admin/category');
        }
    }
    public function storeInsertCate_2(request $request){
        if($request){
            $category=new dt_categories();
            $category->insert($request->name,$request->level,$request->parent_id);
            return redirect()->to('/admin/category');
        }
    }
}
