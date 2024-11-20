<?php

namespace App\Repositories;

use App\Models\Clinic;
use App\Repositories\Interfaces\ClinicRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class ClinicService
 * @package App\Services
 */
class ClinicRepository extends BaseRepository implements ClinicRepositoryInterface
{
    protected $model;

    public function __construct(
        Clinic $model
    ){
        $this->model = $model;
    }
    
    public function clinicPagination(
        array $column = ['*'], 
        array $condition = [], 
        int $perPage = 1,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
        array $relations = [],
    ){

        $query = $this->model->select($column)->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%')
                ->orWhere('code', 'LIKE', '%'.$condition['keyword'].'%');
            }
            if(isset($condition['publish']) && $condition['publish'] != 0){
                $query->where('publish', '=', $condition['publish']);
            }
            return $query;
        })->with('departments','users');
        if(!empty($join)){
            $query->join(...$join);
        }

        return $query->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function getInfoClinic(int $department_id = 0){
        return $this->model->select([
            'clinics.id',
            'clinics.user_id',
            'clinics.code',
            'clinics.name',
            DB::raw('COUNT(tb2.id) as patient_count')
        ])
        ->leftJoin('visits as tb2', function($join){
            $join->on('tb2.clinic_id', '=' , 'clinics.id')
                ->where('tb2.status', config('apps.general.status_open'));
        })
        ->groupBy('clinics.id')
        ->where('clinics.department_id', $department_id)
        ->get();

    }


}
