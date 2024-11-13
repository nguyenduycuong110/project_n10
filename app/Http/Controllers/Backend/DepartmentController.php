<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\DepartmentServiceInterface  as DepartmentService;
use App\Repositories\Interfaces\DepartmentRepositoryInterface  as DepartmentRepository;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    protected $departmentService;
    protected $departmentRepository;

    public function __construct(
        DepartmentService $departmentService,
        DepartmentRepository $departmentRepository
    ){
        $this->departmentService = $departmentService;
        $this->departmentRepository = $departmentRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'department.index');

        $departments = $this->departmentService->paginate($request);

        $config = $this->config();

        $template = 'backend.department.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'departments',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'department.create');

        $config = $this->config();

        $config['method'] = 'create';

        $template = 'backend.department.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    public function store(StoreDepartmentRequest $request){
        if($this->departmentService->create($request)){
            return redirect()->route('department.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('department.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'department.update');

        $department = $this->departmentRepository->findById($id);

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.department.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'department',
        ));
    }

    public function update($id, UpdateDepartmentRequest $request){
        if($this->departmentService->update($id, $request)){
            return redirect()->route('department.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('department.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'department.destroy');

        $config = $this->config();
    
        $department = $this->departmentRepository->findById($id);

        $template = 'backend.department.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'department',
            'config',
        ));
    }

    public function destroy($id){
        if($this->departmentService->destroy($id)){
            return redirect()->route('department.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('department.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
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
            'model' => 'Department',
            'seo' => __('messages.department')
        ];
    }
    

}
