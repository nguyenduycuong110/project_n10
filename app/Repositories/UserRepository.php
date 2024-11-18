<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(
        User $model
    ){
        $this->model = $model;
    }
    
    public function userPagination(
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
                    ->orWhere('cid', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('email', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('address', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('phone', 'LIKE', '%'.$condition['keyword'].'%');
            }
            if(isset($condition['publish']) && $condition['publish'] != 0){
                $query->where('publish', '=', $condition['publish']);
            }
            if(isset($condition['user_catalogue_id']) && $condition['user_catalogue_id'] != 0){
                $query->where('user_catalogue_id', '=', $condition['user_catalogue_id']);
            }
            return $query;
        })->with('user_catalogues','departments','positions');
        if(!empty($join)){
            $query->join(...$join);
        }

        return $query->paginate($perPage)
                    ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function getInfo($id = 0){
        return $this->model->select([
            'tb2.id as clinic_id',
            'tb2.name as clinic_name',
            'tb2.code as clinic_code',
            'tb3.name as department_name'
        ])
        ->join('clinics as tb2','tb2.user_id','=','users.id')
        ->join('departments as tb3','tb3.id','=','users.department_id')
        ->where('users.id', $id)
        ->first();
    }
}
