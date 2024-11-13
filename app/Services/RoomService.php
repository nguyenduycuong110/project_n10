<?php

namespace App\Services;

use App\Services\Interfaces\RoomServiceInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface as RoomRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class RoomService
 * @package App\Services
 */
class RoomService extends BaseService implements RoomServiceInterface 
{
    protected $roomRepository;
    

    public function __construct(
        RoomRepository $roomRepository
    ){
        $this->roomRepository = $roomRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'department_id' => $request->input('department_id')
        ];
        $perPage = $request->integer('perpage');
        $rooms = $this->roomRepository->roomPagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'room/index'], 
        );
        
        return $rooms;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $room = $this->roomRepository->create($payload);
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
            $room = $this->roomRepository->update($id, $payload);
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
            $room = $this->roomRepository->delete($id);
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
            'department_id',
            'code',
            'name', 
            'publish',
        ];
    }


}
