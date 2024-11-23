<?php

namespace App\Http\Controllers\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\VisitRepositoryInterface as VisitRepository;
use App\Repositories\Interfaces\PatientRepositoryInterface as PatientRepository;
use App\Services\Interfaces\VisitServiceInterface as VisitService;
use Carbon\Carbon;

class ConsultationController
{
    protected $userRepository;
    protected $visitRepository;
    protected $patientRepository;
    protected $visitService;
    
    public function __construct(
        UserRepository $userRepository,
        VisitRepository $visitRepository,
        PatientRepository $patientRepository,
        VisitService $visitService
    ){
        $this->userRepository = $userRepository;
        $this->visitRepository = $visitRepository;
        $this->patientRepository = $patientRepository;
        $this->visitService = $visitService;
    }

    public function index(Request $request){

        $user = Auth::guard('consultation')->user();

        $infoClinic = $this->userRepository->getInfo($user->id);

        $listPatient = $this->visitService->paginatePatientOfClinic($request, $infoClinic->clinic_id);

        $config = $this->config();

        return view('consultation.index', compact(
            'infoClinic',
            'listPatient',
            'config'
        ));
    }

    public function detail($id){

        $user = Auth::guard('consultation')->user();

        $infoClinic = $this->userRepository->getInfo($user->id);

        $infoVisit = $this->visitRepository->getInfo($infoClinic->clinic_id , $id);

        $infoVisit['patient_birthday'] = Carbon::parse($infoVisit->patient_birthday)->age;

        $infoVisit['patient_gender'] = __('messages.gender')[$infoVisit->patient_gender];

        $config = $this->config();

        return view('consultation.patient.detail', compact(
            'config',
            'infoVisit'
        ));

    }

    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'https://vphome24.com/backend/js/plugins/slimscroll/jquery.slimscroll.min.js',
                'https://vphome24.com/backend/js/bootstrap.min.js',
                'consultation/js/consultation.js',
            ]
        ];
    }
    
    
}
