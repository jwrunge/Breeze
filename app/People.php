<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //Mass assignables
    protected $fillable = [
        'person_id', 'first_name', 'last_name', 'email_address', 'group_id', 'state'
    ];
}
