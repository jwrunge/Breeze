<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //Circumvent Lumen's insistence on primary keys being auto-increment only
    protected $primaryKey = 'person_id';
    public $incrementing = false;

    //Mass assignables
    protected $fillable = [
        'person_id', 'first_name', 'last_name', 'email_address', 'group_id', 'state'
    ];

    //Relationship to Groups
    public function group() {
        return $this->belongsTo('App\Group');
    }
}
