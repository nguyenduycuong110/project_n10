<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Tên dịch vụ</th>
        <th class="text-right">Giá(vnđ)</th>
        <th class="text-center">Nhóm dịch vụ</th>
        <th>Mô tả</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($expenses) && is_object($expenses))
            @foreach($expenses as $expense)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $expense->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    {{ $expense->name }}
                </td>
                <th style="width:200px;">
                    <input type="text" 
                        name="price" 
                        value="{{ convert_price($expense->price, true)  }}" 
                        class="form-control sort-price text-right int" 
                        data-id="{{ $expense->id }}" 
                        data-model="{{ $config['model'] }}"
                    >
                </th>
                <td class="text-center">
                    @if(isset($expense->expense_catalogues))
                        {{ $expense->expense_catalogues->name }}
                    @endif
                </td>
                <td class="text-center dc">
                    {{ $expense->description }}
                </td>
                <td class="text-center js-switch-{{ $expense->id }}"> 
                    <input type="checkbox" value="{{ $expense->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($expense->publish == 2) ? 'checked' : '' }} data-modelId="{{ $expense->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('expense.delete', $expense->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $expenses->links('pagination::bootstrap-4') }}
