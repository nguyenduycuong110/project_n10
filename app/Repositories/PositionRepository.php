<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class PositionService
 * @package App\Services
 */
class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    protected $model;

    public function __construct(
        Position $model
    ){
        $this->model = $model;
    }
    
    public function positionPagination(
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
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%');
            }
            if(isset($condition['publish']) && $condition['publish'] != 0){
                $query->where('publish', '=', $condition['publish']);
            }
            return $query;
        });
        if(!empty($join)){
            $query->join(...$join);
        }

        return $query->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }


}
