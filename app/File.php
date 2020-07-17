<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //table name
    protected $table = 'files';

    //primary key
    public $primaryKey = 'id';

    //timestamps
    public $timestamps = true;

    //Relatioship for User
    public function userfils(){
        return $this->belongsTo('App\User','created_by','id');
    }
}
