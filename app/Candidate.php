<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Candidate extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public $table = 'candidates';


    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'gender',
        'birth_date',
        'address',
        'zipcode',
        'created_at',
        'updated_at'
    ];

    
}
