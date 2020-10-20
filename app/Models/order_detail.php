<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class order_detail extends Model
{
    use HasFactory;
    protected $table="order_detail";
    protected $primaryKey = 'order_id';
    public function orders(){
        return $this->belongsTo('App\Models\order_detail', 'id','order_id');
    }
    public function dt_products(){
        return $this->hasMany('App\Models\dt_products','product_id');
    }
    public function getTops(){
        return DB::table('order_detail')
        ->select(DB::raw('sum(product_qty) as soluong,product_id,order_detail.product_name,product_price,product_image'))
        ->join('dt_products','dt_products.id','=','order_detail.product_id')
        ->groupBy('product_id')
        ->orderBy('soluong','DESC')
        ->limit(3)
        ->get();
    }
    public function getHots(){
        return DB::table('order_detail')
        ->select(DB::raw('sum(product_qty) as soluong,product_id,order_detail.product_name,product_price,product_image'))
        ->join('dt_products','dt_products.id','=','order_detail.product_id')
        ->groupBy('product_id')
        ->orderBy('soluong','DESC')
        ->get()
        ->random(4);
    }
    public function insert($order_id,$product_code,$product_name,$product_image,$product_price,$product_qty,$product_id){
        $this->order_id=$order_id;
        $this->product_code=$product_code;
        $this->product_name=$product_name;
        $this->product_image=$product_image;
        $this->product_price=$product_price;
        $this->product_qty=$product_qty;
        $this->product_id=$product_id;
        $this->save();
    }

}
