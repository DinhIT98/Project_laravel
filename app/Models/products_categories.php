<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products_categories extends Model
{
    use HasFactory;
    protected $table="products_categories";
    protected $primaryKey = 'product_id,category_id';
}
