<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Candidatejob extends Model 
{
    public $table = 'candidate_job_specific_details';

    protected $fillable = [
        'candidate_id',
        'job_id',
        'hourly_rate'
    ];

}
