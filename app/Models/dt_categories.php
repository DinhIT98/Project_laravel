<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dt_categories extends Model
{
    use HasFactory;
    protected $table="dt_categories";
    protected $primaryKey="id";

    public function getCategory_1(){
        return $this->where('level',1)
        ->select('id','name')
        ->get();
    }
    public function getCategory_2(){
        return $this->where('level',2)
        ->select('id','name','parent_id')
        ->get();
    }
    public function insert($name,$level,$parent_id){
        $this->name=$name;
        $this->level=$level;
        $this->parent_id=$parent_id;
        $this->save();

    }
    public function getCategoryById($id){
        return $this->where('id',$id)
            ->select('name')
            ->get();
    }
}
