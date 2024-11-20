<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Repositories\Interfaces\VisitRepositoryInterface as VisitRepository;


class ConsultationController extends Controller
{
    
    protected $visitRepository;

    public function __construct(
        VisitRepository $visitRepository
    ){
        $this->visitRepository = $visitRepository;
    }

    public function getPatient(Request $request){

        $time = $request->last_check_time;

        $clinic_id = $request->clinic_id;

        $patients = $this->visitRepository->findNewPatients($time , $clinic_id);

        if(is_null($patients) || $patients->isEmpty()) {
            return response()->json([
                'patients' => []
            ]);
        }

        $temp = [];

        if(!is_null($patients)){
            foreach($patients as $key => $val){
                $temp[] = [
                    'symptoms' => $val->symptoms,
                    'patient_name' => $val->patient_name,
                    'patient_code' => $val->patient_code,
                    'patient_phone' => $val->patient_phone,
                    'patient_gender' => __('messages.gender')[$val->patient_gender],
                    'patient_birthday' => Carbon::parse($val->patient_birthday)->age
                ];
            }
        }

        return response()->json(
            [
                'patients' => $temp,
            ]
        );


    }

    

}
