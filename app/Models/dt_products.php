<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class dt_products extends Model
{
    use HasFactory;
    protected $fillable = ['product_code','product_name','description','price','status','warranty'];
    protected $table="dt_products";
    protected $primaryKey="id";
    public function imageupload(){
        return $this->hasMany('App\Models\imageupload','content_id');
    }
    public function products_categories(){
        return $this->hasMany('App\Models\products_categories','product_id');
    }
    public function order_detail(){
        return $this->hasMany('App\Models\order_detail','product_id');
    }
    public function getImageAttribute(){
        $image = imageupload::where('content_id',$this->id)->select('path')->first();
        return $image;

    }
    public function insert($product_code,$product_name,$description,$price,$status,$warranty){
        $this->product_code=$product_code;
        $this->product_name=$product_name;
        $this->description=$description;
        $this->price=$price;
        $this->status=$status;
        $this->warranty=$warranty;
        $this->save();

    }
    public function getProductsByCategory($cate){
        return DB::table('dt_products')
        ->join('products_categories','dt_products.id','=','products_categories.product_id')
        ->join('imageupload','imageupload.content_id','=','dt_products.id')
        ->where('category_id',$cate)
        ->select(DB::raw('dt_products.id,product_name,price,status,warranty,GROUP_CONCAT(path) as path'))
        ->groupBy('imageupload.content_id')
        ->get();
    }

}
