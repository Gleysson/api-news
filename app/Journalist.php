<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journalist extends Model
{
    
    protected $table = 'journalists';

    protected $fillable = [
        'name','lastname','email','password'
    ];

    protected $guarded = [
        'id', 'created_at', 'update_at'
    ];

    protected $hidden = [
        'password'
    ];


}
