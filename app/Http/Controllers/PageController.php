<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\orders;
use App\Models\order_detail;
use App\Models\news;
use App\Models\dt_products;
use App\Models\dt_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

class PageController extends Controller
{
    public function show_product(){


        $products=dt_products::with('imageupload')->paginate(8);
        $smartphone=dt_products::with('imageupload','products_categories')->get();
        $laptop=dt_products::with('imageupload','products_categories')->get();
        $watchs=dt_products::with('imageupload','products_categories')->get();
        $order_detail=new order_detail();
        $tops=$order_detail->getTops();
        $hots=$order_detail->getHots();
        $news=news::limit(4)->get();
        $category= new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();

        // $products = Cache::remember('products', 1, function () {
        //     return  dt_products::with('imageupload')->paginate(8);
        // });
        // $smartphone=Cache::remember('smartphone', 1, function () {
        //     return dt_products::with('imageupload','products_categories')->get();

        // });

        // $laptop=Cache::remember('laptop', 1, function () {
        //     return dt_products::with('imageupload','products_categories')->get();

        // });

        // $watchs=Cache::remember('watch',1, function () {
        //     return dt_products::with('imageupload','products_categories')->get();

        // });

        // $tops=Cache::remember('tops', 1, function () {
        //     $order_detail=new order_detail();
        //     return $order_detail->getTops();

        // });
        // $hots=Cache::remember('tops', 1, function () {
        //     $order_detail=new order_detail();
        //     return $order_detail->getHots();

        // });

        return view('home',['news'=>$news,'hots'=>$hots,'tops'=>$tops,'watchs'=>$watchs,'laptop'=>$laptop,'smartphone'=>$smartphone,'products'=>$products,'category_1'=>$category_1,'category_2'=>$category_2]);
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
        $dt_products=new dt_products();
        $products=$dt_products->getProductsByCategory($cate);
        $news=news::limit(4)->get();
        // $products=dt_products::with(['imageupload','products_categories'=>function ( Builder $query) {
        //     return $query->where('category_id ', '=',9);
        // }]) ;
        // dd($products);
        // print_r($products);
        $category=new dt_categories();
        $cate_name=$category->getCategoryById($cate);
        $cate_name=json_decode($cate_name,true);
        return view('product_category',['news'=>$news,'cate_name'=>$cate_name,'hots'=>$hots,'tops'=>$tops,'products'=>$products,'category_1'=>$category_1,'category_2'=>$category_2]);
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
            $order_detail->insert($id,$request->product_code,$request->product_name,$request->product_image,$request->product_price,$request->quantity,$request->product_id);

            return redirect()->to('/')->with('success','Thank you for your order!');
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
                    'product_id'=>$data[0]['id'],
                    'product_code'=>$data[0]['product_code'],
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
            return redirect()->back()->with('message', 'Product added to cart successfully!');
        }
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            echo '<script>alert("add to cart success!")</script>';
            return redirect()->back()->with('message', 'Product added to cart successfully!');

        }
        $cart[$id] = [
            'product_id'=>$data[0]['id'],
            'product_code'=>$data[0]['product_code'],
            'name'=>$data[0]['product_name'],
            'price'=>$data[0]['price'],
            'status'=>$data[0]['status'],
            'warranty'=>$data[0]['warranty'],
            'image'=>$path,
            'quantity'=>1
        ];

        session()->put('cart', $cart);
        echo "<script>alert('add to cart success!'')</script>";
        return redirect()->back()->with('message', 'Product added to cart successfully!');
    }
    public function removeCart(request $request){
        $cart=session('cart');
        unset($cart[$request->id]);
        session()->put('cart',$cart);
        return redirect()->back()->with('message', 'Remove product successfully!');
    }
    public function checkoutCart(){
        $category= new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();
        return view('checkoutCart',['category_1'=>$category_1,'category_2'=>$category_2]);
    }
    public function checkoutCartStore(request $request){

        if($request){
            $quantity=$request->quantity;
            $order=new orders();
            $order->insert($request->name,$request->phone,$request->email,$request->address,$request->total);

            $order_id=orders::selectRaw('max(id)')->get();
            $id=$order_id[0]['max(id)'];


            $x=0;
            foreach(session('cart') as $key=>$val){
                $order_detail=new order_detail();
                $order_detail->insert($id,$val['product_code'],$val['name'],$val['image'],$val['price'],$quantity[$x],$val['product_id']);
                $x++;
            }
            session()->flush();


            return redirect()->to('/')->with('success','Thank you for your order!');
        }

    }
    public function test(){
        // $datas=dt_products::with('Image')->get();
        // dd($data);
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
    public function search(request $request){
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('dt_products')
            ->where('product_name', 'LIKE', "{$query}%")
            ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
               $output .= '
               <li><a href="/product/detail/'. $row->id .'">'.$row->product_name.'</a></li>
               ';
           }
           $output .= '</ul>';
           echo $output;
       }

    }
    // public function postCheckoutCart(request $request){
    //     $quantity=$request->quantity;
    //     $category= new dt_categories();
    //     $category_1=$category->getCategory_1();
    //     $category_2=$category->getCategory_2();
    //     return view('checkoutCart',['category_1'=>$category_1,'category_2'=>$category_2,'quantity'=>$quantity]);

    // }
    public function addToCartAjax(request $request){
        $id=$request->id;
        $data=dt_products::with('imageupload')->where('id',$id)->get();
        $image=$data[0]->imageupload;
        $path =$image[0]->path;
        $data=json_decode($data,true);
        $cart=session()->get('cart');
        if(!$cart){
            $cart=[
                $id=>[
                    'product_id'=>$data[0]['id'],
                    'product_code'=>$data[0]['product_code'],
                    'name'=>$data[0]['product_name'],
                    'price'=>$data[0]['price'],
                    'status'=>$data[0]['status'],
                    'warranty'=>$data[0]['warranty'],
                    'image'=>$path,
                    'quantity'=>1

                ]
                ];
            session()->put('cart',$cart);

            return response()->json(['message'=>'Product added to cart successfully!']);
        }
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return response()->json(['message'=>'Product added to cart successfully!']);

        }
        $cart[$id] = [
            'product_id'=>$data[0]['id'],
            'product_code'=>$data[0]['product_code'],
            'name'=>$data[0]['product_name'],
            'price'=>$data[0]['price'],
            'status'=>$data[0]['status'],
            'warranty'=>$data[0]['warranty'],
            'image'=>$path,
            'quantity'=>1
        ];

        session()->put('cart', $cart);
        return response()->json(['message'=>'Product added to cart successfully!']);
    }
    public function deleteAndCheckoutCart(request $request){
        if($request->button=="delete"){
            $cart=session('cart');
            unset($cart[$request->id]);
            session()->put('cart',$cart);
            return redirect()->back()->with('message', 'Remove product successfully!');
        }
        else{
            $quantity=$request->quantity;
            $category= new dt_categories();
            $category_1=$category->getCategory_1();
            $category_2=$category->getCategory_2();
            return view('checkoutCart',['category_1'=>$category_1,'category_2'=>$category_2,'quantity'=>$quantity]);
        }

    }
    public function getCart(){
        $quantity =count(session('cart'));
        return response()->json(['data'=>$quantity]);
    }
    public function updateCart(request $request){
        $cart=session('cart');
        $cart[$request->id]['quantity']=$request->quantity;
        session()->put('cart', $cart);

        return response()->json(['data'=>$request->quantity]);

    }
    public function getTotalCart(){
        $total=0;
        foreach (session('cart') as $key=>$val){
            $total+=($val['price']*$val['quantity']);
        }
        return response()->json(['total'=>$total]);
    }
    public function removeCartAjax(request $request){
        $cart=session('cart');
        unset($cart[$request->id]);
        session()->put('cart',$cart);
        $total=0; $x=0;
        foreach(session('cart') as $id=>$val){
            $total+=($val["price"]*$val["quantity"]);
            $path=explode(",", $val["image"]);


            echo '
        <tr>
          <td>
              <div class="row">
                  <div class="col-lg-2 Product-img">
                      <img src="images/'.$path[0].'" class="img-responsive"/>
                  </div>
                  <div class="col-lg-10">
                      <h4 class="nomargin">'.$val["name"].'</h4>
                      <p>'.$val["status"].'</p>
                      <p>'.$val["warranty"].'</p>
                  </div>
              </div>
          </td>
          <input type="text" id="price '.$id.'" hidden value="'.$val["price"].'">
          <input type="text" id="idCart '.$id .'" hidden value=" '.$id.'">
          <td>'.number_format($val["price"]).'đ </td>
          <td data-th="Quantity">
              <input type="number" name="quantity[]" id="'.$id.'" class="quantity form-control text-center" value="'.$val["quantity"].'" min="1">
          </td>
          <td id="total_price'.$id.'" class="price">'.$val["price"]*$val['quantity'].'</td>
          <td class="actions" data-th="" style="width:10%;">


          <input type="text" name="id" value="'.$id.' " hidden>
              <a id="'.$id.'" class="remove btn btn-danger btn-sm" name="button" value="delete" ><i class="fa fa-trash-o"></i></a>

          </td>
        </tr>';
        }

    }
    public function testNews(){
        $category= new dt_categories();
        $category_1=$category->getCategory_1();
        $category_2=$category->getCategory_2();
        $news=news::all();
        return view('news',['news'=>$news,'category_1'=>$category_1,'category_2'=>$category_2]);

    }




}
