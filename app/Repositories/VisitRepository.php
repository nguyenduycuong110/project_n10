<?php

namespace App\Repositories;

use App\Models\Visit;
use App\Repositories\Interfaces\VisitRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class VisitService
 * @package App\Services
 */
class VisitRepository extends BaseRepository implements VisitRepositoryInterface
{
    protected $model;

    public function __construct(
        Visit $model
    ){
        $this->model = $model;
    }
    
    public function visitPagination(
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
                $query->where('code', 'LIKE', '%'.$condition['keyword'].'%');
            }
            if(isset($condition['publish']) && $condition['publish'] != 0){
                $query->where('publish', '=', $condition['publish']);
            }
            return $query;
        })->with('departments','clinics','patients');
        if(!empty($join)){
            $query->join(...$join);
        }

        return $query->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function getAll($id = 0){
        return $this->model->select([
            'visits.id',
            'visits.status',
            'visits.created_at',
            'visits.symptoms',
            'tb2.name as patient_name',
            'tb2.birthday as patient_birthday',
            'tb2.gender as patient_gender',
            'tb2.address as patient_address',
            'tb2.patient_phone',
            'tb3.name as department_name',
            'tb4.name as clinic_name',
            'tb4.code as clinic_code',
            'tb5.name as doctor_name'
        ])
        ->join('patients as tb2','tb2.id','=','visits.patient_id')
        ->join('departments as tb3','tb3.id','=','visits.department_id')
        ->join('clinics as tb4','tb4.id','=','visits.clinic_id')
        ->join('users as tb5','tb5.id','=','visits.user_id')
        ->where('visits.id', '=' , $id)
        ->get();
    }

}
