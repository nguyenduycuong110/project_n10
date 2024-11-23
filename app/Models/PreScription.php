<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class PreScription extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, QueryScopes;

    protected $fillable = [
        'id',
        'patient_id',
        'user_id',
        'created_at'
    ];

    protected $table = 'prescriptions';

    public function prescription_product(){
        return $this->belongsToMany(Product::class, 'prescription_product' ,'prescription_id','product_id')->withPivot('created_at');
    }

}