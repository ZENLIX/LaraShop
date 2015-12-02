<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class NPCity extends Model
{
    //
    protected $table = 'NPCity';
    protected $fillable = [ 'name', 'ref'];
        public $timestamps = false;
}
