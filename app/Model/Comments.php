<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

    protected $table = 'comments';
    protected $fillable = ['name', 'comments'];

//    protected $hidden = ['created_at', 'updated_at'];
}
