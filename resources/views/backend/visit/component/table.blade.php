<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Mã phiếu khám</th>
        <th>Thông tin bệnh nhân</th>
        <th>Triệu chứng chính</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($visits) && is_object($visits))
            @foreach($visits as $visit)
                <tr >
                    <td>
                        <input type="checkbox" value="{{ $visit->id }}" class="input-checkbox checkBoxItem">
                    </td>
                    <td>
                        {{ $visit->code }}
                    </td>
                    <td>
                        <p>{{ $visit->patients->name }} - {{ \Carbon\Carbon::parse($visit->patients->birthday)->age }} tuổi</p>
                        <p>SĐT bệnh nhân : {{ $visit->patients->patient_phone  }}</p>
                        <p>Mã CCCD / CMND : {{ $visit->patients->cid  }}</p>
                    </td>
                    <td>
                        {{ $visit->symptoms }}
                    </td>
                    <td class="text-center js-switch-{{ $visit->id }}"> 
                        {{ __('messages.status')[$visit->status]['name'] }}
                    </td>
                    <td class="text-center"> 
                        <a href="{{ route('visit.edit', $visit->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $visits->links('pagination::bootstrap-4') }}
