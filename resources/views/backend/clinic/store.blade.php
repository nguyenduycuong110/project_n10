@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
@include('backend.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('clinic.store') : route('clinic.update', $clinic->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin chung của phòng khám</p>
                        <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Phòng khám <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{ old('name', ($clinic->name) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Mã phòng khám <span class="text-danger">(*)</span></label>
                                    <div class="code">
                                        <input 
                                            type="text"
                                            name="code"
                                            value="{{ old('code', ($clinic->code) ?? '' ) }}"
                                            class="form-control"
                                            placeholder=""
                                            autocomplete="off"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Khoa bệnh <span class="text-danger">(*)</span></label>
                                    @if(isset($departments))
                                        <select name="department_id" id="" class="setupSelect2 form-control department position" data-target="doctors">
                                            <option value="0">Chọn khoa</option>
                                            @if(isset($departments))
                                                @foreach($departments as $department)
                                                    <option 
                                                        value="{{ $department->id }}"
                                                        @if(old('department_id') == $department->id) selected @endif
                                                    >
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Bác sỹ phụ trách <span class="text-danger">(*)</span></label>
                                    <select name="user_id" class="form-control setupSelect2 doctors">
                                        <option value="0">Chọn bác sĩ phụ trách</option>
                                    </select>
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
<script>
    var department_id = '{{ (isset($clinic->department_id)) ? $clinic->department_id : old('department_id') }}'
    var user_id = '{{ (isset($clinic->user_id)) ? $clinic->user_id : old('user_id') }}'
</script>