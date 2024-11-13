<?php

namespace App\Http\Controllers\Backend\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ExpenseServiceInterface  as ExpenseService;
use App\Repositories\Interfaces\ExpenseRepositoryInterface  as ExpenseRepository;
use App\Repositories\Interfaces\ExpenseCatalogueRepositoryInterface  as ExpenseCatalogueRepository;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;

class ExpenseController extends Controller
{
    protected $expenseService;
    protected $expenseRepository;
    protected $expenseCatalogueRepository;
    
    public function __construct(
        ExpenseService $expenseService,
        ExpenseRepository $expenseRepository,
        ExpenseCatalogueRepository $expenseCatalogueRepository
    ){
        $this->expenseService = $expenseService;
        $this->expenseRepository = $expenseRepository;
        $this->expenseCatalogueRepository = $expenseCatalogueRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'expense.index');

        $expenses = $this->expenseService->paginate($request);
        
        $expenseCatalogues = $this->expenseCatalogueRepository->all();

        $config = $this->config();

        $template = 'backend.expense.expense.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'expenses',
            'expenseCatalogues',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'expense.create');

        $expenseCatalogues = $this->expenseCatalogueRepository->all();

        $config = $this->config();

        $config['method'] = 'create';

        $template = 'backend.expense.expense.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'expenseCatalogues'
        ));
    }

    public function store(StoreExpenseRequest $request){
        if($this->expenseService->create($request)){
            return redirect()->route('expense.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('expense.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'expense.update');

        $expense = $this->expenseRepository->findById($id);

        $expenseCatalogues = $this->expenseCatalogueRepository->all();

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.expense.expense.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'expense',
            'expenseCatalogues'
        ));
    }

    public function update($id, UpdateExpenseRequest $request){
        if($this->expenseService->update($id, $request)){
            return redirect()->route('expense.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('expense.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'expense.destroy');

        $config = $this->config();
    
        $expense = $this->expenseRepository->findById($id);

        $template = 'backend.expense.expense.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'expense',
            'config',
        ));
    }

    public function destroy($id){
        if($this->expenseService->destroy($id)){
            return redirect()->route('expense.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('expense.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function config(){
        return  [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'Expense',
            'seo' => __('messages.expense')
        ];
    }
    

}
