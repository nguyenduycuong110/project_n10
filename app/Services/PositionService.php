<?php

namespace App\Services;

use App\Services\Interfaces\PositionServiceInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface as PositionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class PositionService
 * @package App\Services
 */
class PositionService extends BaseService implements PositionServiceInterface 
{
    protected $positionRepository;
    
    public function __construct(
        PositionRepository $positionRepository
    ){
        $this->positionRepository = $positionRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish')
        ];
        $perPage = $request->integer('perpage');
        $positions = $this->positionRepository->positionPagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'position/index'], 
        );
        
        return $positions;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $position = $this->positionRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }


    public function update($id, $request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send']);
            $position = $this->positionRepository->update($id, $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try{
            $position = $this->positionRepository->delete($id);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

   
    
    private function paginateSelect(){
        return [
            'id',
            'name', 
            'description',
            'publish'
        ];
    }


}
