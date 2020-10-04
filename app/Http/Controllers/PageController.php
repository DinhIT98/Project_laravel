<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\orders;
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
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,GROUP_CONCAT(path) as path'))
        ->where('category_id',9)
        // ->select('dt_products.id','product_name','price','status','warranty','path')
        ->groupBy('imageupload.content_id')
        ->limit(4)
        ->get();
        $watchs=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,GROUP_CONCAT(path) as path'))
        ->where('category_id',8)
        // ->select('dt_products.id','product_name','price','status','warranty','path')
        ->groupBy('imageupload.content_id')
        ->limit(4)
        ->get();
        $tops=DB::table('order_detail')
        ->select(DB::raw('sum(product_qty) as soluong,product_name,product_price,product_image'))
        ->groupBy('product_id')
        ->orderBy('soluong','DESC')
        ->limit(3)
        ->get();
        $hots=DB::table('order_detail')
        ->select(DB::raw('sum(product_qty) as soluong,product_name,product_price,product_image'))
        ->groupBy('product_id')
        ->orderBy('soluong','DESC')
        ->get()
        ->random(4);
        // $data=json_decode($images,true);
        // dd($products);

        return view('home',['hots'=>$hots,'tops'=>$tops,'watchs'=>$watchs,'laptop'=>$laptop,'smartphone'=>$smartphone,'products'=>$products,'category_1'=>$category_1,'category_2'=>$category_2]);
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
        $category_1=DB::table('dt_categories')
        ->where('level',1)
        ->select('id','name')
        ->get();
        $category_2=DB::table('dt_categories')
        ->where('level',2)
        ->select('parent_id','name')
        ->get();
        $tops=DB::table('order_detail')
        ->select(DB::raw('sum(product_qty) as soluong,product_name,product_price,product_image'))
        ->groupBy('product_id')
        ->orderBy('soluong','DESC')
        ->limit(3)
        ->get();
        $hots=DB::table('order_detail')
        ->select(DB::raw('sum(product_qty) as soluong,product_name,product_price,product_image'))
        ->groupBy('product_id')
        ->orderBy('soluong','DESC')
        ->get()
        ->random(4);
        $products=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->where('category_id',$cate)
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,GROUP_CONCAT(path) as path'))
        ->groupBy('imageupload.content_id')
        ->get();
        $cate_name=DB::table('dt_categories')
        ->where('id',$cate)
        ->select('name')
        ->get();
        $cate_name=json_decode($cate_name,true);
        
        return view('product_category',['cate_name'=>$cate_name,'hots'=>$hots,'tops'=>$tops,'products'=>$products,'category_1'=>$category_1,'category_2'=>$category_2]);
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
        // dd(session('cart'));
        return view('cart',['category_1'=>$category_1,'category_2'=>$category_2]);

    }
    public function checkout_store(request $request){

        $data=[$request->quantity,$request->total,$request->product_id,$request->name,$request->phone,$request->email,$request->address];
        if($request){
            $order=new orders();
            $order->user_name=$request->name;
            $order->user_phone=$request->phone;
            $order->user_email=$request->email;
            $order->user_address=$request->address;
            $order->total_price=$request->quantity*$request->total;
            $order->save();
            return redirect()->to('/home');
        }

    }
    public function addToCart($id){
        $data=DB::table('dt_products')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->where('dt_products.id',$id)
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,description,GROUP_CONCAT(path) as path'))
        ->groupBy('imageupload.content_id')
        ->get();
        $data=json_decode($data,true);
        $cart=session()->get('cart');
        if(!$cart){
            $cart=[
                $id=>[
                    'name'=>$data[0]['product_name'],
                    'price'=>$data[0]['price'],
                    'status'=>$data[0]['status'],
                    'warranty'=>$data[0]['warranty'],
                    'image'=>$data[0]['path'],
                    'quantity'=>1

                ]
                ];
            session()->put('cart',$cart);
            return redirect()->back();
        }
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }
        $cart[$id] = [
            'name'=>$data[0]['product_name'],
            'price'=>$data[0]['price'],
            'status'=>$data[0]['status'],
            'warranty'=>$data[0]['warranty'],
            'image'=>$data[0]['path'],
            'quantity'=>1
        ];

        session()->put('cart', $cart);
        return redirect()->back();
    }
    public function removeCart($id){
        $cart=session('cart');
        unset($cart[$id]);
        session()->put('cart',$cart);
        return redirect()->back();
    }
    public function sanPhamBanChay(){
        $tops=DB::table('order_detail')
        ->select(DB::raw('sum(product_qty) as soluong,product_name,product_price,product_image'))
        ->groupBy('product_id')
        ->orderBy('soluong','DESC')
        ->get()
        ->random(4);
        dd($tops);
    }
    public function checkoutCart(){
        $category_1=DB::table('dt_categories')
        ->where('level',1)
        ->select('id','name')
        ->get();
        $category_2=DB::table('dt_categories')
        ->where('level',2)
        ->select('parent_id','name')
        ->get();
        return view('checkoutCart',['category_1'=>$category_1,'category_2'=>$category_2]);
    }
    public function test(){
        session('cart')['18']['quantity']++;
        echo session('cart')['18']['quantity'];
    }



}
