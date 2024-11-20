<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Repositories\Interfaces\PatientRepositoryInterface as PatientRepository;
use App\Repositories\Interfaces\ClinicRepositoryInterface as ClinicRepository;
use App\Repositories\Interfaces\VisitRepositoryInterface as VisitRepository;


class ReceptionController extends Controller
{
    
    protected $patientRepository;
    protected $clinicRepository;
    protected $visitRepository;

    public function __construct(
        PatientRepository $patientRepository,
        ClinicRepository $clinicRepository,
        VisitRepository $visitRepository
    ){
        $this->patientRepository = $patientRepository;
        $this->clinicRepository = $clinicRepository;
        $this->visitRepository = $visitRepository;
    }

    public function getPatient(Request $request){

        $time = $request->last_check_time;

        $patients = $this->patientRepository->findNewPatient($time);

        if(is_null($patients) || $patients->isEmpty()) {
            return response()->json([
                'patients' => []
            ]);
        }

        $temp = [];

        if(!is_null($patients)){
            foreach($patients as $key => $val){
                $temp[] = [
                    'id' => $val->id,
                    'code' => $val->code,
                    'name' => $val->name,
                    'birthday' => Carbon::parse($val->birthday)->age,
                    'cid' => $val->cid,
                    'gender' => __('messages.gender')[$val->gender],
                    'patient_phone' => $val->patient_phone,
                    'province_name' => $val->province_name
                ];
            }
        }

        return response()->json(
            [
                'patients' => $temp,
            ]
        );
        
    }

    public function getClinic(Request $request){

        $department_id = $request->input('department_id');

        $clinics = $this->clinicRepository->getInfoClinic($department_id);

        if(is_null($clinics) || $clinics->isEmpty()) {
            return response()->json([
                'clinics' => []
            ]);
        }

        return response()->json([
            'clinics' => $clinics
        ]);
        
    }

    public function createVisit(Request $request){
        $payload = [
            'code' => 'PKB'.time(),
            'patient_id' => $request->input('patient_id'),
            'user_id' => $request->input('user_id'),
            'department_id' => $request->input('department_id'),
            'clinic_id' => $request->input('clinic_id'),
            'symptoms' => $request->input('symptoms')
        ];

        $visit = $this->visitRepository->create($payload);

        $temp = $this->visitRepository->getAll($visit->id);

        $infoVisit = [];

        if(isset($temp)){
            foreach($temp as $k => $v){
                $infoVisit[] = [
                    'id' => $v->id,
                    'status_v' => $v->status,
                   'status' => __('messages.status')[$v->status]['name'],
                   'status_code' => __('messages.status')[$v->status]['code'],
                   'created_at' => convertDateTime($v->created_at, 'H:i,d/m/Y'),
                   'symptoms' => $v->symptoms,
                   'patient_name' => $v->patient_name,
                   'patient_birthday' => convertDateTime($v->patient_birthday, 'd/m/Y'),
                   'patient_gender' => __('messages.gender')[$v->patient_gender],
                   'patient_address' => $v->patient_address,
                   'patient_phone' => $v->patient_phone,
                   'department_name' => $v->department_name,
                   'clinic_name' => $v->clinic_name,
                   'clinic_code' => $v->clinic_code,
                   'doctor_name' => $v->doctor_name
                ];
            }
        }

        if($visit){
            return response()->json([
                'status' => 200,
                'visit' => $infoVisit,
            ]);
        }
            
    }

    public function getVisit(Request $request){

        $visit_id = $request->input('visit_id');

        $temp = $this->visitRepository->getAll($visit_id);

        $infoVisit = [];

        if(isset($temp)){
            foreach($temp as $k => $v){
                $infoVisit[] = [
                    'id' => $v->id,
                   'status' => __('messages.status')[$v->status]['name'],
                   'status_code' => __('messages.status')[$v->status]['code'],
                   'created_at' => convertDateTime($v->created_at, 'H:i,d/m/Y'),
                   'symptoms' => $v->symptoms,
                   'patient_name' => $v->patient_name,
                   'patient_birthday' => convertDateTime($v->patient_birthday, 'd/m/Y'),
                   'patient_gender' => __('messages.gender')[$v->patient_gender],
                   'patient_address' => $v->patient_address,
                   'patient_phone' => $v->patient_phone,
                   'department_name' => $v->department_name,
                   'clinic_name' => $v->clinic_name,
                   'clinic_code' => $v->clinic_code,
                   'doctor_name' => $v->doctor_name
                ];
            }
        }

        return response()->json([
            'status' => 200,
            'visit' => $infoVisit,
        ]);

        
    }

}
