<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Mã giường bệnh</th>
        <th>Tên giường bệnh</th>
        <th class="text-center">Phòng bệnh</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($beds) && is_object($beds))
            @foreach($beds as $bed)
                <tr >
                    <td>
                        <input type="checkbox" value="{{ $bed->id }}" class="input-checkbox checkBoxItem">
                    </td>
                    <td>
                        {{ $bed->code }}
                    </td>
                    <td>
                        {{ $bed->name }}
                    </td>
                    <td class="text-center">
                        {{ $bed->rooms->name }}
                    </td>
                    @php
                        $statusName = __('messages.status_room')[$bed->publish]['name'];
                        $statusCode = __('messages.status_room')[$bed->publish]['code'];
                    @endphp
                    <td class="text-center js-switch-{{ $bed->id }}"> 
                        <span class="tb-color" style="background: {{ $statusCode }} ">{{ $statusName }}</span>
                    <td class="text-center"> 
                        <a href="{{ route('bed.edit', $bed->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('bed.delete', $bed->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $beds->links('pagination::bootstrap-4') }}
