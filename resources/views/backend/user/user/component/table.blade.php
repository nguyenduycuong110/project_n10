<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Thông tin</th>
        <th>Số chứng chỉ</th>
        <th class="text-center">Nhóm nhân viên</th>
        <th class="text-center">Khoa bệnh</th>
        <th class="text-center">Chức vụ</th>
        <th class="text-center">Trạng thái</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($users) && is_object($users))
            @foreach($users as $user)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $user->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    <p class="mb5">Họ tên : {{ $user->name }}</p>
                    <p class="mb5">SĐT : {{ $user->phone }}</p>
                    <p class="mb5">Email : {{ $user->email }}</p>
                    <p class="mb0">Ngày sinh : {{ convertDateTime($user->birthday,'d/m/Y') }}</p>
                </td>
                <td>
                    {{ $user->certificate }}
                </td>
                <td class="text-center">
                    {{ $user->user_catalogues->name }}
                </td>
                <td class="text-center">
                    @if(isset($user->departments))
                        {{ $user->departments->name }}
                    @endif
                </td>
                <td class="text-center">
                    @if(isset($user->positions))
                        {{ $user->positions->name }}
                    @endif
                </td>
                <td class="text-center js-switch-{{ $user->id }}"> 
                    <input type="checkbox" value="{{ $user->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($user->publish == 2) ? 'checked' : '' }} data-modelId="{{ $user->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $users->links('pagination::bootstrap-4') }}
