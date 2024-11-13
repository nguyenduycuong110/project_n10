<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Mã khoa</th>
        <th>Khoa</th>
        <th>Số điện thoại</th>
        <th>Vị trí</th>
        <th>Mô tả</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($departments) && is_object($departments))
            @foreach($departments as $department)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $department->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    {{ $department->code }}
                </td>
                <td>
                    {{ $department->name }}
                </td>
                <td>
                    {{ $department->phone }}
                </td>
                <td>
                    {{ $department->location }}
                </td>
                <td class="text-center dc">
                    {{ $department->description }}
                </td>
                <td class="text-center js-switch-{{ $department->id }}"> 
                    <input type="checkbox" value="{{ $department->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($department->publish == 2) ? 'checked' : '' }} data-modelId="{{ $department->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('department.edit', $department->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('department.delete', $department->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $departments->links('pagination::bootstrap-4') }}
