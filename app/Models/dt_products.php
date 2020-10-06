<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dt_products extends Model
{
    use HasFactory;
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
        $image = imageupload::where('content_id',$this->id)->first();
        return $image->path;

    }
}
