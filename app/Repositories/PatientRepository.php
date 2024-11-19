<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class PatientService
 * @package App\Services
 */
class PatientRepository extends BaseRepository implements PatientRepositoryInterface
{
    protected $model;

    public function __construct(
        Patient $model
    ){
        $this->model = $model;
    }
    
    public function patientPagination(
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
                ->orWhere('code', 'LIKE', '%'.$condition['keyword'].'%')
                ->orWhere('patient_phone', 'LIKE', '%'.$condition['keyword'].'%')
                ->orWhere('cid', 'LIKE', '%'.$condition['keyword'].'%')
                ->orWhere('bhyt', 'LIKE', '%'.$condition['keyword'].'%');
            }
            if(isset($condition['publish']) && $condition['publish'] != 0){
                $query->where('publish', '=', $condition['publish']);
            }
            return $query;
        })->with('provinces');
        if(!empty($join)){
            $query->join(...$join);
        }

        $query->orderBy($orderBy[0], $orderBy[1]);

        return $query->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL').'/'.$extend['path']);
    }


    public function listPatient(
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

                ->orWhere('code', 'LIKE', '%'.$condition['keyword'].'%')

                ->orWhere('patient_phone', 'LIKE', '%'.$condition['keyword'].'%')

                ->orWhere('cid', 'LIKE', '%'.$condition['keyword'].'%')

                ->orWhere('bhyt', 'LIKE', '%'.$condition['keyword'].'%');

            }

            if(isset($condition['publish']) && $condition['publish'] != 0){
                $query->where('publish', '=', $condition['publish']);
            }

            $query->whereDate('created_at','=', now()->toDateString());

            return $query;

        })->with('provinces');

        if(!empty($join)){
            $query->join(...$join);
        }

        $query->orderBy($orderBy[0], $orderBy[1]);

        return $query->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL').'/'.$extend['path']);
    }

    public function findNewPatient($time){
        return $this->model->select(
            'patients.id',
            'patients.code',
            'patients.name',
            'patients.patient_phone',
            'patients.gender',
            'patients.cid',
            'patients.birthday',
            'tb2.name as province_name'
        )
        ->join('provinces as tb2', 'tb2.code', '=', 'patients.province_id')
        ->where('patients.created_at', '>', $time)
        ->get();
    }

}
