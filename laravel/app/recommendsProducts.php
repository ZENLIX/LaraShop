<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class recommendsProducts extends Model
{
    //
    protected $table = 'recommendsProducts';
    protected $fillable = [ 'product_id', 'product_id_recommend'];



    public function product()
  {
    return $this->hasOne('larashop\Products', 'id', 'product_id_recommend');
  }


}
