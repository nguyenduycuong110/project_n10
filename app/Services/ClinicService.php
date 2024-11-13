<?php

namespace App\Services;

use App\Services\Interfaces\ClinicServiceInterface;
use App\Repositories\Interfaces\ClinicRepositoryInterface as ClinicRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class ClinicService
 * @package App\Services
 */
class ClinicService extends BaseService implements ClinicServiceInterface 
{
    protected $clinicRepository;
    

    public function __construct(
        ClinicRepository $clinicRepository
    ){
        $this->clinicRepository = $clinicRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish')
        ];
        $perPage = $request->integer('perpage');
        $clinics = $this->clinicRepository->clinicPagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'clinic/index'], 
        );
        
        return $clinics;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $clinic = $this->clinicRepository->create($payload);
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
            $clinic = $this->clinicRepository->update($id, $payload);
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
            $clinic = $this->clinicRepository->delete($id);
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
            'code',
            'name', 
            'department_id',
            'user_id',
            'publish',
        ];
    }


}
