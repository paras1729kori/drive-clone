<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //table name
    protected $table = 'folders';

    //primary key
    public $primaryKey = 'id';

    //timestamps
    public $timestamps = true;
}
