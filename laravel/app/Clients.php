<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    //
    protected $fillable = [ 'name', 'email', 'tel'];
}
