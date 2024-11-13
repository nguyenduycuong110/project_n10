<?php

namespace App\Services;

use App\Services\Interfaces\ExpenseServiceInterface;
use App\Repositories\Interfaces\ExpenseRepositoryInterface as ExpenseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class ExpenseService
 * @package App\Services
 */
class ExpenseService extends BaseService implements ExpenseServiceInterface 
{
    protected $expenseRepository;

    public function __construct(
        ExpenseRepository $expenseRepository
    ){
        $this->expenseRepository = $expenseRepository;
    }

    public function paginate($request){
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'expense_catalogue_id' => $request->input('expense_catalogue_id')
        ];
        $perPage = $request->integer('perpage');
        $expenses = $this->expenseRepository->expensePagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'expense/index'], 
        );
        
        return $expenses;
    }
 

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            $payload['price'] = convert_price(($payload['price']) ?? 0);
            $expense = $this->expenseRepository->create($payload);
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
            $payload['price'] = convert_price(($payload['price']) ?? 0);
            $expense = $this->expenseRepository->update($id, $payload);
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
            $expense = $this->expenseRepository->delete($id);
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
            'expense_catalogue_id',
            'price',
            'description',
            'publish',
        ];
    }


}
