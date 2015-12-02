<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name','title','keywords','description','description_full','values','cover','price','price_old','label','isset','urlhash','categories_id' ];


    public function recommendProd() {
   return $this->hasMany('larashop\recommendsProducts', 'product_id');
}


    public function recommendProds() // those who follow me
{
        //$this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    return $this->belongsToMany('larashop\recommendsProducts', 'recommendsProducts', 'product_id', 'product_id_recommend');
}

        public function category()
  {
    return $this->hasOne('larashop\Categories', 'id', 'categories_id');
  }


    public function comments() {
   return $this->hasMany('larashop\Comments', 'product_id');
}


}
