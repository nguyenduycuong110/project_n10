<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Room extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, QueryScopes;

    protected $fillable = [
        'id',
        'code',
        'name',
        'department_id',
        'publish'
    ];

    protected $table = 'rooms';

    public function departments(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function beds(){
        return $this->hasMany(Bed::class, 'room_id', 'id');
    }

}