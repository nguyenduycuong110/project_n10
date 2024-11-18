<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th>STT</th>
            <th>Thông tin bệnh nhân</th>
            <th>Giới tính</th>
            <th>Triệu chứng chính</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody class="patient-list">
        @if(isset($listPatient) && is_object($listPatient))
            @foreach($listPatient as $patient)
                <tr>
                    <td>
                        <input type="checkbox" value="{{ $patient->id }}" class="input-checkbox checkBoxItem">
                    </td>
                    <td>
                        
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
                        <a href="" class="btn btn-success" ><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
