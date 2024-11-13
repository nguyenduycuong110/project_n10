@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
@include('backend.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('patient.store') : route('patient.update', $patient->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin chung của bệnh nhân</p>
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
                                    <label for="" class="control-label text-left">Tên bệnh nhân <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{ old('name', ($patient->name) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Mã bệnh nhân<span class="text-danger"> (*)</span></label>
                                    <div class="code">
                                        <input 
                                            type="text"
                                            name="code"
                                            value="{{ old('code', ($patient->code) ?? 'BN'.time() ) }}"
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
                                    <label for="" class="control-label text-left">Mã CCCD / CMND <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="cid"
                                        value="{{ old('cid', ($patient->cid) ?? '' ) }}"
                                        class="form-control "
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Mã BHYT</label>
                                    <input 
                                        type="text"
                                        name="bhyt"
                                        value="{{ old('bhyt', ($patient->bhyt) ?? '' ) }}"
                                        class="form-control "
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Giới tính <span class="text-danger">(*)</span></label>
                                    @if(__('messages.gender'))
                                        @php
                                            $gender= request('gender') ?: old('gender');
                                        @endphp
                                        <select name="gender" id="" class="form-control setupSelect2">
                                            <option value="0">Chọn giới tính</option>
                                            @foreach (__('messages.gender') as $key => $val)
                                                <option 
                                                    value="{{ $key }}"
                                                    {{ $key == $gender || isset($patient) && $key == $patient->gender ? 'selected' : '' }}
                                                >
                                                    {{ $val }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ngày sinh </label>
                                    <input 
                                        type="date"
                                        name="birthday"
                                        value="{{ old('birthday', (isset($patient->birthday)) ? date('Y-m-d', strtotime($patient->birthday)) : '') }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Thành Phố <span class="text-danger">(*)</span</label>
                                    <select name="province_id" class="form-control setupSelect2 province location" data-target="districts">
                                        <option value="0">[Chọn Thành Phố]</option>
                                        @if(isset($provinces))
                                            @foreach($provinces as $province)
                                                <option 
                                                    @if(old('province_id') == $province->code || isset($patient) && $patient->province_id ==  $province->code) selected @endif 
                                                    value="{{ $province->code }}"
                                                >
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Địa chỉ</label>
                                    <input 
                                        type="text"
                                        name="address"
                                        value="{{ old('address', ($patient->address) ?? '' ) }}"
                                        class="form-control "
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">SĐT bệnh nhân</label>
                                    <input 
                                        type="text"
                                        name="patient_phone"
                                        value="{{ old('patient_phone', ($patient->patient_phone) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">SĐT người thân</label>
                                    <input 
                                        type="text"
                                        name="guardian_phone"
                                        value="{{ old('guardian_phone', ($patient->guardian_phone) ?? '' ) }}"
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
        <hr>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>
