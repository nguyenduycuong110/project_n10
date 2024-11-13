<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PatientServiceInterface  as PatientService;
use App\Repositories\Interfaces\PatientRepositoryInterface  as PatientRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface  as ProvinceRepository;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;

class PatientController extends Controller
{
    protected $patientService;
    protected $patientRepository;
    protected $provinceRepository;

    public function __construct(
        PatientService $patientService,
        PatientRepository $patientRepository,
        ProvinceRepository $provinceRepository,
    ){
        $this->patientService = $patientService;
        $this->patientRepository = $patientRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'patient.index');

        $patients = $this->patientService->paginate($request);
        
        $config = $this->config();

        $template = 'backend.patient.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'patients',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'patient.create');

        $config = $this->config();
        
        $provinces = $this->provinceRepository->all();

        $config['method'] = 'create';

        $template = 'backend.patient.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces'
        ));
    }

    public function store(StorePatientRequest $request){
        if($this->patientService->create($request)){
            return redirect()->route('patient.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('patient.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'patient.update');

        $patient = $this->patientRepository->findById($id);

        $provinces = $this->provinceRepository->all();

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.patient.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'patient'
        ));
    }

    public function update($id, UpdatePatientRequest $request){
        if($this->patientService->update($id, $request)){
            return redirect()->route('patient.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('patient.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'patient.destroy');

        $config = $this->config();
    
        $patient = $this->patientRepository->findById($id);

        $template = 'backend.patient.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'patient',
            'config',
        ));
    }

    public function destroy($id){
        if($this->patientService->destroy($id)){
            return redirect()->route('patient.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('patient.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
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
            'model' => 'Patient',
            'seo' => __('messages.patient')
        ];
    }
    

}
