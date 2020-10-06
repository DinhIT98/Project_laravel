<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageupload extends Model
{
    use HasFactory;
    protected $table="imageupload";
    protected $primaryKey = 'id';

    public function dt_products(){
        return $this->belongsTo('App\Models\dt_products', 'id','content_id');
    }
}
