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

    // Relationship b/w folder and file
    public function p_files(){
        return $this->belongsTo('App\Folder', 'parent_folder', 'id');
    }
}
