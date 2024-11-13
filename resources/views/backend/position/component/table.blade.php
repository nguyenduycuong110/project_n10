<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Chức vụ</th>
        <th>Mô tả</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($positions) && is_object($positions))
            @foreach($positions as $position)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $position->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    {{ $position->name }}
                </td>
                <td class="text-center dc">
                    {{ $position->description }}
                </td>
                <td class="text-center js-switch-{{ $position->id }}"> 
                    <input type="checkbox" value="{{ $position->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($position->publish == 2) ? 'checked' : '' }} data-modelId="{{ $position->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('position.edit', $position->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('position.delete', $position->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $positions->links('pagination::bootstrap-4') }}
