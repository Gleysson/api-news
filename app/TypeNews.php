<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeNews extends Model
{
    protected $table = 'type_news';

    protected $guarded = [
        'id', 'created_at', 'update_at'
    ];

    protected $fillable = [
        'name'
    ];
}
