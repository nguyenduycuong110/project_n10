<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th class="text-center">STT</th>
            <th>Thông tin bệnh nhân</th>
            <th>Giới tính</th>
            <th>Triệu chứng chính</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody class="patient-clinic">
        @if(isset($listPatient) && is_object($listPatient))
            @foreach($listPatient as $key => $patient)
                <tr>
                    <td>
                        <input type="checkbox" value="" class="input-checkbox checkBoxItem">
                    </td>
                    <td class="text-center stt">
                        {{ $key + 1 }}
                    </td>
                    <td>
                        <p>{{ $patient->patient_name }} - {{ \Carbon\Carbon::parse($patient->patient_birthday)->age }} tuổi</p>
                        <p>Mã bệnh nhân : {{ $patient->code }}</p>
                        <p>SĐT bệnh nhân : {{ $patient->patient_phone }}</p>
                    </td>
                    <td>
                        {{ __('messages.gender')[$patient->patient_gender] }}
                    </td>
                    <td>
                        {{ $patient->symptoms }}
                    </td>
                    <td class="text-center"> 
                        <a href="{{ route('consultation.patient.detail',['id' => $patient->id]) }}" class="btn btn-success" ><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $listPatient->links('pagination::bootstrap-4') }}
