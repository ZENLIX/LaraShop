<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class NPUnit extends Model
{
    //
    protected $table = 'NPUnit';
    protected $fillable = [ 'name', 'ref'];
    public $timestamps = false;
}
