<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Mã phòng</th>
        <th>Tên phòng</th>
        <th class="text-center">Tổng số giường</th>
        <th>Khoa bệnh</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($rooms) && is_object($rooms))
            @foreach($rooms as $room)
                <tr >
                    <td>
                        <input type="checkbox" value="{{ $room->id }}" class="input-checkbox checkBoxItem">
                    </td>
                    <td>
                        {{ $room->code }}
                    </td>
                    <td>
                        {{ $room->name }}
                    </td>
                    <td class="text-center">
                        {{ $room->beds_count }}
                    </td>
                    <td class="text-center dc"> 
                        {{ $room->departments->name }}
                    </td>
                    @php
                        $statusName = __('messages.status_room')[$room->publish]['name'];
                        $statusCode = __('messages.status_room')[$room->publish]['code'];
                    @endphp
                    <td class="text-center js-switch-{{ $room->id }}"> 
                        <span class="tb-color" style="background: {{ $statusCode }} ">{{ $statusName }}</span>
                    <td class="text-center"> 
                        <a href="{{ route('room.edit', $room->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('room.delete', $room->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $rooms->links('pagination::bootstrap-4') }}
