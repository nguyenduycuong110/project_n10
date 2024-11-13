<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Expense extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, QueryScopes;

    protected $fillable = [
        'id',
        'expense_catalogue_id',
        'name',
        'price',
        'description',
        'publish'
    ];

    public function expense_catalogues(){
        return $this->belongsTo(ExpenseCatalogue::class,'expense_catalogue_id','id');
    }

    protected $table = 'expenses';

}