<?php

namespace App\Services;

use App\Services\Interfaces\PatientServiceInterface;
use App\Repositories\Interfaces\PatientRepositoryInterface as PatientRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class PatientService
 * @package App\Services
 */
class PatientService extends BaseService implements PatientServiceInterface 
{
    protected $patientRepository;
    
    public function __construct(
        PatientRepository $patientRepository
    ){
        $this->patientRepository = $patientRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish')
        ];
        $perPage = $request->integer('perpage');
        $patients = $this->patientRepository->patientPagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'patient/index'], 
        );
        
        return $patients;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $patient = $this->patientRepository->create($payload);
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
            $patient = $this->patientRepository->update($id, $payload);
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
            $patient = $this->patientRepository->delete($id);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function paginateReception($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish')
        ];
        $perPage = $request->integer('perpage');
        $patients = $this->patientRepository->listPatient(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'reception/index'], 
        );
        
        return $patients;
    }
 

   
    
    private function paginateSelect(){
        return [
            'id',
            'code',
            'name', 
            'gender',
            'birthday',
            'address',
            'cid',
            'bhyt',
            'patient_phone',
            'guardian_phone',
            'province_id'
        ];
    }


}
