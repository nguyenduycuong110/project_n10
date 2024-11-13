<?php

namespace App\Http\Controllers\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\DepartmentRepositoryInterface as DepartmentRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\PatientRepositoryInterface as PatientRepository;
use App\Repositories\Interfaces\VisitRepositoryInterface as VisitRepository;
use App\Services\Interfaces\PatientServiceInterface as PatientService;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;


class ReceptionController 
{
    protected $departmentRepository;
    protected $patientRepository;
    protected $visitRepository;
    protected $provinceRepository;
    protected $patientService;
    
    public function __construct(
        DepartmentRepository $departmentRepository,
        VisitRepository $visitRepository,
        PatientRepository $patientRepository,
        ProvinceRepository $provinceRepository,
        PatientService $patientService
    ){
        $this->departmentRepository = $departmentRepository;
        $this->visitRepository = $visitRepository;
        $this->patientRepository = $patientRepository;
        $this->provinceRepository = $provinceRepository;
        $this->patientService = $patientService;
    }

    public function index(Request $request){
        $config = $this->config();
        $patients = $this->patientService->paginateReception($request);
        return view('reception.index', compact(
            'config',
            'patients'
        ));
    }

    public function createPatient(){
        $provinces = $this->provinceRepository->all();
        $config = $this->config();
        return view('reception.patient.create', compact(
            'provinces',
            'config'
        ));
    }

    public function storePatient(StorePatientRequest $request){
        if($this->patientService->create($request)){
            return redirect()->route('reception.patient.create')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('reception.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function patientVisit($id){

        $config = $this->config();

        $provinces = $this->provinceRepository->all();

        $departments = $this->departmentRepository->all();

        $visits = $this->visitRepository->findByCondition([
            ['patient_id', '=' , $id]
        ], true);

        
        $patient = $this->patientRepository->findById($id);

        return view('reception.patient.visit', compact(
           'config',
           'provinces',
           'departments',
           'patient',
           'visits'
        ));
    }

    public function updateVisit($id, UpdatePatientRequest $request){
        if($this->patientService->update($id, $request)){
            return redirect()->route('reception.patient.visit',['id' => $id])->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('reception.patient.visit',['id' => $id])->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'js' => [
                'reception/js/reception.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'https://vphome24.com/backend/js/plugins/slimscroll/jquery.slimscroll.min.js',
                'https://vphome24.com/backend/js/bootstrap.min.js'
            ]
        ];
    }

    
}
