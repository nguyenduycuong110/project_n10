<?php

namespace App\Repositories;

use App\Models\ExpenseCatalogue;
use App\Repositories\Interfaces\ExpenseCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class ExpenseCatalogueService
 * @package App\Services
 */
class ExpenseCatalogueRepository extends BaseRepository implements ExpenseCatalogueRepositoryInterface
{
    protected $model;

    public function __construct(
        ExpenseCatalogue $model
    ){
        $this->model = $model;
    }
    
    public function expenseCataloguePagination(
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
