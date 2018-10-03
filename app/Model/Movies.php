<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model {

    protected $table = 'movies';
    protected $fillable = ['name', 'description', 'release_date', 'rating', 'ticket_price', 'country', 'genre', 'photo', 'slug'];
    protected $hidden = ['created_at', 'updated_at'];

}
