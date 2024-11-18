<?php

namespace App\Http\Controllers\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\VisitRepositoryInterface as VisitRepository;

class ConsultationController
{
    
    protected $userRepository;
    protected $visitRepository;
    
    public function __construct(
        UserRepository $userRepository,
        VisitRepository $visitRepository
    ){
        $this->userRepository = $userRepository;
        $this->visitRepository = $visitRepository;
    }

    public function index(Request $request){

        $user = Auth::guard('consultation')->user();

        $infoClinic = $this->userRepository->getInfo($user->id);

        $listPatient = $this->visitRepository->getPatientByClinic($infoClinic->clinic_id);

        $config = $this->config();

        return view('consultation.index', compact(
            'infoClinic',
            'listPatient',
            'config'
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
