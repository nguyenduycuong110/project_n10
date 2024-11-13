@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
@include('backend.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('expense.store') : route('expense.update', $expense->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin chung của dịch vụ</p>
                        <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tên dịch vụ <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{ old('name', ($expense->name) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Nhóm dịch vụ <span class="text-danger">(*)</span></label>
                                    @if(isset($expenseCatalogues))
                                        <select name="expense_catalogue_id" id="" class="setupSelect2 form-control">
                                            <option value="0">Chọn nhóm dịch vụ</option>
                                            @foreach($expenseCatalogues as $key => $val)
                                                <option 
                                                    value="{{ $val->id }}"
                                                    {{ 
                                                        $val->id == old('expense_catalogue_id', (isset($expense->expense_catalogue_id)) ? $expense->expense_catalogue_id : '') ? 'selected' : '' 
                                                    }}
                                                >
                                                    {{ $val->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Giá <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="price"
                                        value="{{ old('price', ($expense->price) ?? '' ) }}"
                                        class="form-control int"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Mô tả </label>
                                    <div class="description">
                                        <input 
                                            type="text"
                                            name="description"
                                            value="{{ old('description', ($expense->description) ?? '' ) }}"
                                            class="form-control"
                                            placeholder=""
                                            autocomplete="off"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>
