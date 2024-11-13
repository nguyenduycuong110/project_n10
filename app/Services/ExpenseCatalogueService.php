<?php

namespace App\Services;

use App\Services\Interfaces\ExpenseCatalogueServiceInterface;
use App\Repositories\Interfaces\ExpenseCatalogueRepositoryInterface as ExpenseCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class ExpenseCataloguetService
 * @package App\Services
 */
class ExpenseCatalogueService extends BaseService implements ExpenseCatalogueServiceInterface 
{
    protected $expenseCatalogueRepository;

    public function __construct(
        ExpenseCatalogueRepository $expenseCatalogueRepository
    ){
        $this->expenseCatalogueRepository = $expenseCatalogueRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish')
        ];
        $perPage = $request->integer('perpage');
        $expenseCatalogues = $this->expenseCatalogueRepository->expenseCataloguePagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'expense/catalogue/index'], 
        );
        
        return $expenseCatalogues;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $expenseCatalogue = $this->expenseCatalogueRepository->create($payload);
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
            $expenseCatalogue = $this->expenseCatalogueRepository->update($id, $payload);
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
            $expenseCatalogue = $this->expenseCatalogueRepository->delete($id);
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
            'publish',
        ];
    }


}
