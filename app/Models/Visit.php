<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Visit extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, QueryScopes;

    protected $fillable = [
        'id',
        'code',
        'user_id',
        'patient_id',
        'department_id',
        'clinic_id',
        'symptoms',
        'diagnosis',
        'notes',
        'status'
    ];

    protected $table = 'visits';

    public function departments(){
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function clinics(){
        return $this->belongsTo(Clinic::class,'clinic_id','id');
    }

    public function patients(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }

}