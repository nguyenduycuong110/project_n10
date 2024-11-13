<?php

namespace App\Services;

use App\Services\Interfaces\DepartmentServiceInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface as DepartmentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class DepartmentService
 * @package App\Services
 */
class DepartmentService extends BaseService implements DepartmentServiceInterface 
{
    protected $departmentRepository;
    

    public function __construct(
        DepartmentRepository $departmentRepository
    ){
        $this->departmentRepository = $departmentRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish')
        ];
        $perPage = $request->integer('perpage');
        $departments = $this->departmentRepository->departmentPagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'department/index'], 
        );
        
        return $departments;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $department = $this->departmentRepository->create($payload);
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
            $department = $this->departmentRepository->update($id, $payload);
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
            $department = $this->departmentRepository->delete($id);
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
            'location',
            'phone',
            'description',
            'publish',
        ];
    }


}
