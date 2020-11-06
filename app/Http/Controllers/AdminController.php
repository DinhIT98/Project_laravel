<?php

namespace App\Http\Controllers;
use ZipArchive;
use App\Models\users;
use App\Models\orders;
use Illuminate\Support\Facades\DB;
use App\Models\dt_categories;
use App\Models\dt_products;
use App\Models\news;
use App\Models\order_detail;
use App\Models\imageupload;
use App\Models\products_categories;
use Illuminate\Http\Request;
use Auth;
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
        return redirect()->to('/admin/products')->with('success','insert product success!');
    }
    public function deleteProduct(request $request){
        dt_products::where("id",$request->id)->delete();
        $images=imageupload::selectRaw('GROUP_CONCAT(path) as path')
        ->where('content_id',$request->id)
        ->get();
        $images=json_decode($images,true);
        // $path=explode(",", $images[0]['path']);
        // foreach($path as $val){
        //     Storage::disk('public')->delete( $val);
        // }
        imageupload::where("content_id",$request->id)->delete();
        products_categories::where("product_id",$request->id)->delete();
        // return redirect()->to('/admin/products');
        return response()->json(['success'=>'remove product success!']);

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
        // dd($request->price);
        $request->validate([

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data=str_replace(",", "", $request->price);
        $price=str_replace("đ", "", $data);
        // dd($price);
        dt_products::where('id', $request->product_id)
        ->update(['product_code' => $request->product_code,'product_name'=>$request->product_name,'description'=>$request->product_description,'price'=>$price,'status'=>$request->status,'warranty'=>$request->warranty,'updated_at'=>now()]);
        products_categories::where('product_id',$request->product_id)
        ->update(['category_id'=>$request->product_categorie]);
        if($request->file('image')){
            foreach($request->file('image') as $key=> $image){
                $image_path=new imageupload();
                $image_path->insert($request->product_id,$image->getClientOriginalName());
                Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));
            }
        }
        return redirect()->to('/admin/products');
    }
    public function imageDelete(request $request){
        $path=$request->path;
        imageupload::where("path",$path)->delete();
        // Storage::disk('public')->delete($path);
        return response()->json(['success'=>"remove image success!"]);
        // return redirect()->back();
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
        return redirect()->back()->with("success","Delete user successfully!");
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
    public function showNews(){
        // dd('nguyen huu dinh');
        $news=news::all();
        return view('admin.news',['news'=>$news]);
    }
    public function insertNew(){
        return view('admin.insert_new');
    }
    public function storeInsertNew(request $request){
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $author= Auth::user()->id;
        $image=$request->file('image');
        $data=[$image,$request->title,$request->content,$author,$request->summary];
        // dd($data);
        $news=new news();
        $news->author=$author;
        $news->summary=$request->summary;
        $news->title=$request->title;
        $news->content=$request->content;
        $news->image=$image->getClientOriginalName();
        $news->save();
        Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));
        return redirect()->back();


    }
    public function deleteNew(request $request){
        news::where('id',$request->id)->delete();
        return response()->json(['success'=>"remove new success!"]);
    }
    public function editNews($id){
        $data=news::where('id',$id)->get();
        return view('admin.edit_news',['data'=>$data]);
    }
    public function storeEditNews(request $request){
        $data=[$request->id,$request->title,$request->summary,$request->content,$request->file('image')];
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $image=$request->file('image');
        news::where('id',$request->id)
        ->update(['title'=>$request->title,'summary'=>$request->summary,'content'=>$request->content,'image'=>$image->getClientOriginalName(),'updated_at'=>now()]);
        Storage::disk('public')->put($image->getClientOriginalName(),  File::get($image));
        return redirect()->to('/admin/news');
    }
    public function deleteImageNews(request $request){

        // dd($request->path);
        news::where('image',$request->path)->update(['image'=>null]);
        Storage::disk('public')->delete($request->path);
    }
    public function import(){
        return view('admin.import');
    }
    public function detailOrder($id){
        $user_data=orders::where('id',$id)->get();
        $detail=order_detail::where('order_id',$id)->get();
        return view('admin.detail_order',['data'=>$detail,'user_data'=>$user_data]);
    }
    public function storeEditDetailOrder(request $request){
        order_detail::where('product_code',$request->id)
        ->where('order_id',$request->order_id)
        ->update(['product_qty'=>$request->quantity]);
        return response()->json(['message'=>'Modify quantity success!']);
    }
    public function deleteDetailOrder(request $request){
        $count=order_detail::where('order_id',$request->order_id)->count();
        if($count==1){
            orders::where('id',$request->order_id)->delete();
            order_detail::where('product_code',$request->id)
        ->where('order_id',$request->order_id)
        ->delete();
        }else{
            order_detail::where('product_code',$request->id)
            ->where('order_id',$request->order_id)
            ->delete();
        }

        return response()->json(['message'=>"delete success!"]);
    }
    public function deleteOrder(request $request){
        orders::where('id',$request->id)->delete();
        order_detail::where('order_id',$request->id)
        ->delete();
        return response()->json(['message'=>'Delete order success!']);
    }
    public function restore(){
        return view("admin.restore");
    }
    public function handleRestore(request $request){
        $request->validate([

            'file'  => 'required|mimes:zip|max:2048',
        ]);
        $file=$request->file('file');
        $fileName=$file->getClientOriginalName();
        $zipFile=storage_path('app/laravel/'.$fileName);
        // dd($zipFile);
        $zip = new ZipArchive;
        $res = $zip->open($zipFile);
        // dd($res);
        if($res!=9){
            dd('nguyen huu dinh');
            $zip->extractTo(storage_path('app/laravel'));
            $zip->close();
            $sql= storage_path('app\laravel\db-dumps\mysql-demo.sql');

            //  DB::statement(file_get_contents($sql));
             $status=DB::unprepared(file_get_contents($sql));
            //  Storage::disk('storage')->delete('db-dumps');
            //  dd($status);
            // for ($i = 0; $i < $zip->numFiles; $i++) {
            //     $entry = $zip->getNameIndex($i);
            //     dd($entry);
            // }
            // dd($zip->getFromName());
            // dd($res);
            // dd(DB::unprepared(file_get_contents($sql)));
            // dd(DB::unprepared(file_get_contents($sql)));
            return response()->json(['success'=>'File Uploaded Successfully']);
        }
        else{
            return redirect()->back()->with('errors','Invalid file');
        }

    }
}
