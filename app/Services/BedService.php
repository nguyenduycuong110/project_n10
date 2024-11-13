<?php

namespace App\Services;

use App\Services\Interfaces\BedServiceInterface;
use App\Repositories\Interfaces\BedRepositoryInterface as BedRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class BedService
 * @package App\Services
 */
class BedService extends BaseService implements BedServiceInterface 
{
    protected $bedRepository;
    

    public function __construct(
        BedRepository $bedRepository
    ){
        $this->bedRepository = $bedRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'room_id' => $request->input('room_id')
        ];
        $perPage = $request->integer('perpage');
        $beds = $this->bedRepository->bedPagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'bed/index'], 
        );
        return $beds;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $bed = $this->bedRepository->create($payload);
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
            $bed = $this->bedRepository->update($id, $payload);
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
            $bed = $this->bedRepository->delete($id);
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
            'room_id',
            'code',
            'name', 
            'publish',
        ];
    }


}
