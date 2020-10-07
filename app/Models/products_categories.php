<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products_categories extends Model
{
    use HasFactory;
    protected $table="products_categories";
    protected $primaryKey = 'product_id,category_id';
    public function insert($product_id,$category_id){
        $this->product_id=$product_id;
        $this->category_id=$category_id;
        $this->save();

    }
}
