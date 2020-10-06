<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\orders;
use App\Models\order_detail;
use App\Models\dt_products;
use App\Models\dt_categories;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PageController extends Controller
{
    public function show_product(){
        $products=dt_products::with('imageupload')->paginate(8);
        $category= new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();
        $smartphone=dt_products::with('imageupload','products_categories')->get();
        $laptop=dt_products::with('imageupload','products_categories')->get();
        $watchs=dt_products::with('imageupload','products_categories')->get();
        $order_detail=new order_detail();
        $tops=$order_detail->getTops();
        $hots=$order_detail->getHots();
        return view('home',['hots'=>$hots,'tops'=>$tops,'watchs'=>$watchs,'laptop'=>$laptop,'smartphone'=>$smartphone,'products'=>$products,'category_1'=>$category_1,'category_2'=>$category_2]);
    }
    public function show_detail($id){
        $category=new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();
        $product=dt_products::with('imageupload')->where('id',$id)->get();
        return view('detail',['product'=>$product,'category_1'=>$category_1,'category_2'=>$category_2]);
    }
    public function showProductByCategory($cate){
        $category= new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();
        $order_detail=new order_detail();
        $tops=$order_detail->getTops();
        $hots=$order_detail->getHots();
        $products=DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->where('category_id',$cate)
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,GROUP_CONCAT(path) as path'))
        ->groupBy('imageupload.content_id')
        ->get();
        // $products=dt_products::with(['imageupload','products_categories'=>function ( Builder $query) {
        //     return $query->where('category_id ', '=',9);
        // }]) ;
        // dd($products);
        // print_r($products);
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
        $category= new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();
        $product=dt_products::with('imageupload')->where('id',$id)->get();
        return view('checkout',['product'=>$product,'category_1'=>$category_1,'category_2'=>$category_2]);

    }
    public function cart(){
        $category= new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();
        return view('cart',['category_1'=>$category_1,'category_2'=>$category_2]);

    }
    public function checkout_store(request $request){


        if($request){

            $order=new orders();
            $order->insert($request->name,$request->phone,$request->email,$request->address,$request->quantity*$request->total);

            $order_id=orders::selectRaw('max(id)')->get();
            $id=$order_id[0]['max(id)'];

            $order_detail=new order_detail();
            $order_detail->order_id=$id;
            $order_detail->product_code=$request->product_code;
            $order_detail->product_name=$request->product_name;
            $order_detail->product_image=$request->product_image;
            $order_detail->product_price=$request->product_price;
            $order_detail->product_qty=$request->quantity;
            $order_detail->product_id=$request->product_id;

            $order_detail->save();
            return redirect()->to('/');
        }

    }
    public function addToCart($id){
        $data=dt_products::with('imageupload')->where('id',$id)->get();
        $image=$data[0]->imageupload;
        $path =$image[0]->path;
        $data=json_decode($data,true);
        $cart=session()->get('cart');
        if(!$cart){
            $cart=[
                $id=>[
                    'name'=>$data[0]['product_name'],
                    'price'=>$data[0]['price'],
                    'status'=>$data[0]['status'],
                    'warranty'=>$data[0]['warranty'],
                    'image'=>$path,
                    'quantity'=>1

                ]
                ];
            session()->put('cart',$cart);
            echo '<script>alert("add to cart success!")</script>';
            return redirect()->back();
        }
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            echo '<script>alert("add to cart success!")</script>';
            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }
        $cart[$id] = [
            'name'=>$data[0]['product_name'],
            'price'=>$data[0]['price'],
            'status'=>$data[0]['status'],
            'warranty'=>$data[0]['warranty'],
            'image'=>$path,
            'quantity'=>1
        ];

        session()->put('cart', $cart);
        echo "<script>alert('add to cart success!'')</script>";
        return redirect()->back();
    }
    public function removeCart($id){
        $cart=session('cart');
        unset($cart[$id]);
        session()->put('cart',$cart);
        return redirect()->back();
    }
    public function checkoutCart(){
        $category= new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();
        return view('checkoutCart',['category_1'=>$category_1,'category_2'=>$category_2]);
    }
    public function test(){
        // $datas=dt_products::with('Image')->get();
        // foreach($datas as $data){
        //     dd($data->imageupload);
        // }
        // foreach($data as $img){
        //     echo $img;
        // }

        $data=dt_products::with('imageupload','products_categories')->inRandomOrder(10)->get();
        // dd($data[0]->imageupload);
        dd($data);
        foreach($data[0]->imageupload as $img){
            print_r($img);
        }

    }



}
