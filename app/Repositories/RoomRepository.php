<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class RoomService
 * @package App\Services
 */
class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    protected $model;

    public function __construct(
        Room $model
    ){
        $this->model = $model;
    }
    
    public function roomPagination(
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
            if(isset($condition['department_id']) && $condition['department_id'] != 0){
                $query->where('department_id', '=', $condition['department_id']);
            }
            return $query;
        })->with('departments')->withCount('beds');
        if(!empty($join)){
            $query->join(...$join);
        }

        return $query->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function getAllRoom(){
        return $this->model->select([
            'rooms.id',
            'rooms.code',
            'rooms.name',
            'rooms.publish',
            'tb2.name as department_name'
        ])
        ->join('departments as tb2','tb2.id','=','rooms.department_id')
        ->get();
    }


}
