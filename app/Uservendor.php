<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Uservendor extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $table = 'user_vendor';


    protected $fillable = [
        'user_id',
        'vender_id'
    ];

}
