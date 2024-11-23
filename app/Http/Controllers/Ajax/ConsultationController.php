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
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Models\PreScription;

class ConsultationController extends Controller
{
    
    protected $visitRepository;
    protected $expenseRepository;
    protected $userRepository;
    protected $productRepository;
    protected $patientRepository;

    public function __construct(
        VisitRepository $visitRepository,
        ExpenseRepository $expenseRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        PatientRepository $patientRepository
    ){
        $this->visitRepository = $visitRepository;
        $this->expenseRepository = $expenseRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
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


    public function findProduct(Request $request){

        $keyword = $request->input('keyword');

        $language_id = config('apps.general.vn');

        $products = $this->productRepository->search($keyword, $language_id);

        return response()->json($products);

    }

    public function createBill(Request $request){

        $payload = $request->input('productData');

        $totalPrice = $request->input('totalPrice');

        $patient_id = $request->input('patient_id');

        $temp = [
            'patient_id' => $patient_id,
            'user_id' => $request->input('user_id'),
        ];

        $prescription = PreScription::create($temp);

        $pivot = [];

        foreach($payload as $key => $val){
            $pivot[] = [
               'prescription_id' => $prescription->id,
               'product_id' => $val['id']
            ];
        }

        $prescription->prescription_product()->sync($pivot);

        $patient = $this->patientRepository->findById($patient_id);

        $object = [
            'patient_code' => $patient->code,
            'patient_name' => $patient->name,
            'patient_birthday' => Carbon::parse($patient->birthday)->age,
            'patient_gender' => __('messages.gender')[$patient->gender],
            'patient_address' => $patient->address,
            'patient_phone' => $patient->patient_phone,
            'payload' => $payload,
            'create' => 'Ngày ' . Carbon::parse($prescription->created_at)->format('d') . ' Tháng ' . Carbon::parse($prescription->created_at)->format('m') . ' Năm ' . Carbon::parse($prescription->created_at)->format('Y'),
            'total_price' => $totalPrice
        ];

        return response()->json($object);
        
        
    }
    

}
