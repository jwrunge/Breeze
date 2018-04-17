<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //Mass assignables
    protected $fillable = [
        'group_id', 'group_name'
    ];
}
