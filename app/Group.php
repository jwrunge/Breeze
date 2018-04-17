<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //Circumvent Lumen's insistence on primary keys being auto-increment only
    protected $primaryKey = 'group_id';
    public $incrementing = false;

    //Mass assignables
    protected $fillable = [
        'group_id', 'group_name'
    ];

    //Relationship to People
    public function members() {
        return $this->hasMany('App\People');
    }
}
