<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = 'gallery';
    protected $fillable = [ 'filename', 'sort_id'];
}
