<?php

namespace App\Http\Controllers\Backend\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ExpenseCatalogueServiceInterface  as ExpenseCatalogueService;
use App\Repositories\Interfaces\ExpenseCatalogueRepositoryInterface  as ExpenseCatalogueRepository;
use App\Http\Requests\Expense\StoreExpenseCatalogueRequest;
use App\Http\Requests\Expense\UpdateExpenseCatalogueRequest;

class ExpenseCatalogueController extends Controller
{
    protected $expenseCatalogueService;
    protected $expenseCatalogueRepository;
    
    public function __construct(
        ExpenseCatalogueService $expenseCatalogueService,
        ExpenseCatalogueRepository $expenseCatalogueRepository
    ){
        $this->expenseCatalogueService = $expenseCatalogueService;
        $this->expenseCatalogueRepository = $expenseCatalogueRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'expense.catalogue.index');

        $expenseCatalogues = $this->expenseCatalogueService->paginate($request);

        $config = $this->config();

        $template = 'backend.expense.catalogue.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'expenseCatalogues',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'expense.catalogue.create');

        $config = $this->config();

        $config['method'] = 'create';

        $template = 'backend.expense.catalogue.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    public function store(StoreExpenseCatalogueRequest $request){
        if($this->expenseCatalogueService->create($request)){
            return redirect()->route('expense.catalogue.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('expense.catalogue.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'expense.catalogue.update');

        $expenseCatalogue = $this->expenseCatalogueRepository->findById($id);

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.expense.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'expenseCatalogue',
        ));
    }

    public function update($id, UpdateExpenseCatalogueRequest $request){
        if($this->expenseCatalogueService->update($id, $request)){
            return redirect()->route('expense.catalogue.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('expense.catalogue.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'expense.catalogue.destroy');

        $config = $this->config();
    
        $expenseCatalogue = $this->expenseCatalogueRepository->findById($id);

        $template = 'backend.expense.catalogue.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'expenseCatalogue',
            'config',
        ));
    }

    public function destroy($id){
        if($this->expenseCatalogueService->destroy($id)){
            return redirect()->route('expense.catalogue.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('expense.catalogue.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
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
            'model' => 'ExpenseCatalogue',
            'seo' => __('messages.expenseCatalogue')
        ];
    }
    

}
