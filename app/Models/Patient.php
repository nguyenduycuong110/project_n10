<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Patient extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, QueryScopes;

    protected $fillable = [
        'id',
        'province_id',
        'code',
        'name', 
        'gender',
        'birthday',
        'address',
        'cid',
        'bhyt',
        'patient_phone',
        'guardian_phone',
        'created_at'
    ];

    public function provinces(){
        return $this->hasMany(Province::class, 'code', 'province_id');
    }

    protected $table = 'patients';

}