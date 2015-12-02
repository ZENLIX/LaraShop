<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name','email','msg','product_id','approve' ];


    public function product()
  {
    return $this->belongsTo('larashop\Products', 'product_id');
  }

}
