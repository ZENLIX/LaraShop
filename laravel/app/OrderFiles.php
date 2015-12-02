<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class OrderFiles extends Model
{
    //

    protected $table = 'order_files';
    protected $fillable = [ 'order_id', 'name', 'hash', 'mime', 'extension', 'status', 'image'];

}


