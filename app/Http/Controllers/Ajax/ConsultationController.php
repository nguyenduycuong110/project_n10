<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\VisitRepositoryInterface as VisitRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\ExpenseRepositoryInterface as ExpenseRepository;
use App\Repositories\Interfaces\PatientRepositoryInterface as PatientRepository;

class ConsultationController extends Controller
{
    
    protected $visitRepository;
    protected $expenseRepository;
    protected $userRepository;
    protected $patientRepository;

    public function __construct(
        VisitRepository $visitRepository,
        ExpenseRepository $expenseRepository,
        UserRepository $userRepository,
        PatientRepository $patientRepository
    ){
        $this->visitRepository = $visitRepository;
        $this->expenseRepository = $expenseRepository;
        $this->userRepository = $userRepository;
        $this->patientRepository = $patientRepository;
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

    public function findExpense(Request $request){

        $condition = [
            'keyword' => $request->input('keyword')
        ];

        $object = $this->expenseRepository->searchExpense($condition);

        return response()->json($object); 

    }

    public function createService(Request $request){

        $patient_id = $request->input('patient_id');

        $patient = $this->patientRepository->findById($patient_id);

        $user = Auth::guard('consultation')->user();

        $infoClinic = $this->userRepository->getInfo($user->id);

        $payload = [
            'patient_name' => $patient->name,
            'patient_gender' => __('messages.gender')[$patient->gender],
            'patient_birthday' => Carbon::parse($patient->birthday)->age,
            'patient_address' => $patient->address,
            'area' => $infoClinic->clinic_name . ' - Khoa ' . $infoClinic->department_name,
            'expense_name' => $request->input('expense_name'),
            'expense_price' => $request->input('expense_price')
        ];

        return response()->json($payload);
        
    }

    

}
