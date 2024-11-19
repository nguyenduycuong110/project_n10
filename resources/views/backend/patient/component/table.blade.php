<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th>Thông tin bệnh nhân</th>
            <th>Giới tính</th>
            <th>Mã CCCD/CMND</th>
            <th>Tỉnh / Thành phố</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($patients) && is_object($patients))
            @foreach($patients as $patient)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $patient->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    <p>{{ $patient->name }} - {{ \Carbon\Carbon::parse($patient->birthday)->age }} tuổi</p>
                    <p>Mã bệnh nhân : {{ $patient->code }}</p>
                    <p>SĐT bệnh nhân : {{ $patient->patient_phone }}</p>
                </td>
                <td>
                    {{ __('messages.gender')[$patient->gender] }}
                </td>
                <td class="text-center dc">
                    {{ $patient->cid }}
                </td>
                <th>
                    @if(isset($patient->provinces))
                        {{ $patient->provinces->first()->name }}
                    @endif
                </th>
                <td class="text-center"> 
                    <a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('patient.delete', $patient->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $patients->links('pagination::bootstrap-4') }}