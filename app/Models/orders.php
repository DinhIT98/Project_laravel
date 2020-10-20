<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $primaryKey = 'id';
    protected $attributes = [
        'status' =>'Mới đặt hàng'
    ];
    public function order_detail(){
        return $this->hasMany('App\Models\order_detail','order_id');
    }
    public function insert($user_name,$user_phone,$user_email,$user_address,$total_price){
        $this->user_name=$user_name;
        $this->user_phone=$user_phone;
        $this->user_email=$user_email;
        $this->user_address=$user_address;
        $this->total_price=$total_price;
        $this->save();
    }
}
