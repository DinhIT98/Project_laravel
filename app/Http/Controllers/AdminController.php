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
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));

        $image_path=new imageupload();
        $image_path->content_id=$id;
        $image_path->path=$image->getClientOriginalName();
        $image_path->save();
        echo "<script>alert('insert product success!')</script>";
        return redirect()->to('/home');

        // return "<script>alert('insert product success!')</script>";



    }
    public function storeImage (Request $request) {

        // if ($request->hasFile('image')) {
        //     //  Let's do everything here
        //     if ($request->file('image')->isValid()) {

        //         $validated = $request->validate([
        //             'name' => 'string|max:40',
        //             'image' => 'mimes:jpeg,png|max:1014',
        //         ]);
        //         $extension = $request->image->extension();
        //         dd($extension);
        //         $request->image->storeAs('/public', $validated['name'].".".$extension);
        //         $url = Storage::url($validated['name'].".".$extension);
        //         $file = File::create([
        //            'name' => $validated['name'],
        //             'url' => $url,
        //         ]);
        //         Session::flash('success', "Success!");
        //         return \Redirect::back();
        //     }
        // }
        // abort(500, 'Could not upload image :(');
        // $file =$request->file('image');
        // // dd($request->image);
        // $file->move(public_path().'/images/',$request->image);
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));

    }
    public function deleteProduct($id,$image_path){
        dt_products::where("id",$id)->delete();
        imageupload::where("content_id",$id)->delete();
        products_categories::where("product_id",$id)->delete();
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        return redirect()->to('/admin/products');

    }
    public function insertCategory(){
        return view('admin.insert_category');
    }
}
