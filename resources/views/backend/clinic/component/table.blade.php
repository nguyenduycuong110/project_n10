<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Mã phòng khám</th>
        <th>Phòng khám</th>
        <th>Khoa bệnh</th>
        <th>Bác sĩ phụ trách</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($clinics) && is_object($clinics))
            @foreach($clinics as $clinic)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $clinic->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    {{ $clinic->code }}
                </td>
                <td>
                    {{ $clinic->name }}
                </td>
                <td>
                    @if(isset($clinic->departments))
                        {{ $clinic->departments->name }}
                    @endif
                </td>
                <td class="text-center dc">
                    @if(isset($clinic->users))
                        {{ $clinic->users->name }}
                    @endif
                </td>
                <td class="text-center js-switch-{{ $clinic->id }}"> 
                    <input type="checkbox" value="{{ $clinic->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($clinic->publish == 2) ? 'checked' : '' }} data-modelId="{{ $clinic->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('clinic.edit', $clinic->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('clinic.delete', $clinic->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $clinics->links('pagination::bootstrap-4') }}
