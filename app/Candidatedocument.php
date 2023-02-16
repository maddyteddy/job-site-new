<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Candidatedocument extends Model 
{
    public $table = 'candidate_documents';

    protected $fillable = [
        'candidate_id',
        'is_cv',
        'document'
    ];

}
