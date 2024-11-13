<?php

namespace App\Services;

use App\Services\Interfaces\VisitServiceInterface;
use App\Repositories\Interfaces\VisitRepositoryInterface as VisitRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class VisitService
 * @package App\Services
 */
class VisitService extends BaseService implements VisitServiceInterface 
{
    protected $visitRepository;
    
    public function __construct(
        VisitRepository $visitRepository
    ){
        $this->visitRepository = $visitRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish')
        ];
        $perPage = $request->integer('perpage');
        $visits = $this->visitRepository->visitPagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'visit/index'], 
        );
        
        return $visits;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $visit = $this->visitRepository->create($payload);
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
            $visit = $this->visitRepository->update($id, $payload);
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
            $visit = $this->visitRepository->delete($id);
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
            'patient_id',
            'clinic_id',
            'department_id',
            'symptoms',
            'status'
        ];
    }


}
