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
}
