<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','cover','urlhash'];


    public function products() {
   return $this->hasMany('larashop\Products', 'categories_id');
}


}
