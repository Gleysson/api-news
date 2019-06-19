<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'id_type_news','title','description','body','image'
    ];

    protected $guarded = [
        'id','id_journalists', 'created_at', 'update_at'
    ];
    
}
