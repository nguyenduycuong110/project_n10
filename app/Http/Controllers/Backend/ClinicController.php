<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ClinicServiceInterface  as ClinicService;
use App\Repositories\Interfaces\ClinicRepositoryInterface  as ClinicRepository;
use App\Repositories\Interfaces\DepartmentRepositoryInterface  as DepartmentRepository;
use App\Http\Requests\Clinic\StoreClinicRequest;
use App\Http\Requests\Clinic\UpdateClinicRequest;

class ClinicController extends Controller
{
    protected $clinicService;
    protected $clinicRepository;

    public function __construct(
        ClinicService $clinicService,
        ClinicRepository $clinicRepository,
        DepartmentRepository $departmentRepository
    ){
        $this->clinicService = $clinicService;
        $this->clinicRepository = $clinicRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'clinic.index');

        $clinics = $this->clinicService->paginate($request);

        $config = $this->config();

        $template = 'backend.clinic.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'clinics',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'clinic.create');

        $departments =  $this->departmentRepository->all();

        $config = $this->config();

        $config['method'] = 'create';

        $template = 'backend.clinic.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'departments'
        ));
    }

    public function store(StoreClinicRequest $request){
        if($this->clinicService->create($request)){
            return redirect()->route('clinic.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('clinic.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'clinic.update');

        $clinic = $this->clinicRepository->findById($id);

        $departments =  $this->departmentRepository->all();

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.clinic.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'clinic',
            'departments'
        ));
    }

    public function update($id, UpdateClinicRequest $request){
        if($this->clinicService->update($id, $request)){
            return redirect()->route('clinic.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('clinic.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'clinic.destroy');

        $config = $this->config();
    
        $clinic = $this->clinicRepository->findById($id);

        $template = 'backend.clinic.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'clinic',
            'config',
        ));
    }

    public function destroy($id){
        if($this->clinicService->destroy($id)){
            return redirect()->route('clinic.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('clinic.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function config(){
        return  [
            'js' => [
                'backend/library/finder.js',
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'Clinic',
            'seo' => __('messages.clinic')
        ];
    }
    

}
