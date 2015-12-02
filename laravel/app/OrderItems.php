<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    //

    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $fillable = [ 'order_id', 'product_id', 'qty'];

    public function product()
  {
    return $this->hasOne('larashop\Products', 'id', 'product_id');
  }

}
