<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class ProductOptions extends Model
{
    //

    protected $table = 'product_options';
    protected $fillable = [ 'product_id', 'option_id'];


        public function option()
  {
    return $this->hasOne('larashop\Options', 'id', 'option_id');
  }



}
