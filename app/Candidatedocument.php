<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Candidate;

class Candidatedocument extends Model 
{
    public $table = 'candidate_documents';

    protected $fillable = [
        'candidate_id',
        'is_cv',
        'document'
    ];

    /*public function candidate():BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }*/

}
