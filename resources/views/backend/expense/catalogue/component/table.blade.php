<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Tên nhóm dịch vụ</th>
        <th>Mô tả</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($expenseCatalogues) && is_object($expenseCatalogues))
            @foreach($expenseCatalogues as $expenseCatalogue)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $expenseCatalogue->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    {{ $expenseCatalogue->name }}
                </td>
                <td class="text-center dc">
                    {{ $expenseCatalogue->description }}
                </td>
                <td class="text-center js-switch-{{ $expenseCatalogue->id }}"> 
                    <input type="checkbox" value="{{ $expenseCatalogue->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($expenseCatalogue->publish == 2) ? 'checked' : '' }} data-modelId="{{ $expenseCatalogue->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('expense.catalogue.edit', $expenseCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('expense.catalogue.delete', $expenseCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $expenseCatalogues->links('pagination::bootstrap-4') }}
