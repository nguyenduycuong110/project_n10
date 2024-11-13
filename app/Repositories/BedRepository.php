<?php

namespace App\Repositories;

use App\Models\Bed;
use App\Repositories\Interfaces\BedRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class BedService
 * @package App\Services
 */
class BedRepository extends BaseRepository implements BedRepositoryInterface
{
    protected $model;

    public function __construct(
        Bed $model
    ){
        $this->model = $model;
    }
    
    public function bedPagination(
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
            if(isset($condition['room_id']) && $condition['room_id'] != 0){
                $query->where('room_id', '=', $condition['room_id']);
            }
            return $query;
        })->with('rooms');
        if(!empty($join)){
            $query->join(...$join);
        }

        return $query->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }


}
