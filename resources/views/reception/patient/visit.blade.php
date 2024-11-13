@extends('reception.component.layout')

@section('content')
    <div class="row mt20 visit">
        <div class="col-lg-12">
            @include('backend.dashboard.component.formError')
            <form action="{{ route('reception.patient.updateVisit',['id' => $patient->id]) }}" method="post" class="box">
                @csrf
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                            <h5>{{ __('messages.info_patient') }} </h5>
                            <div class="text-right mb15">
                                <button class="btn btn-primary" type="submit" name="send" value="send">{{ __('messages.save') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div class="row mb15">
                                                <div class="col-lg-3">
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
                                                <div class="col-lg-3">
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
                                                <div class="col-lg-3">
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
                                                <div class="col-lg-3">
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
                                                <div class="col-lg-4">
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
                                                <div class="col-lg-4">
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
                                                                        {{ $key == $gender || $key == $patient->gender ? 'selected' : '' }}
                                                                    >
                                                                        {{ $val }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-row">
                                                        <label for="" class="control-label text-left">Tỉnh / Thành Phố <span class="text-danger">(*)</span></label>
                                                        <select name="province_id" class="form-control setupSelect2 province location" data-target="districts">
                                                            <option value="0">[Chọn Thành Phố]</option>
                                                            @if(isset($provinces))
                                                                @foreach($provinces as $province)
                                                                    <option 
                                                                        @if(old('province_id') == $province->code || $patient->province_id == $province->code) selected @endif 
                                                                        value="{{ $province->code }}"
                                                                    >
                                                                        {{ $province->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb15">
                                                <div class="col-lg-4">
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
                                                <div class="col-lg-4">
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
                                                <div class="col-lg-4">
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
                        </div>
                        </form>
                    </div>
                </div>
            </form>
            <div class="ibox float-e-margins problem">
                <div class="ibox-title">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <h5>{{ __('messages.problem_patient') }} </h5>
                        <div class="text-right mb15">
                            <button 
                                class="btn btn-primary btn-status" 
                                type="submit" name="send" 
                                value="send"
                                {{-- data-toggle="modal" 
                                data-target="#modalProblem" --}}
                            >
                                {{ __('messages.create_problem') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-6 list-problem">
                                @if(isset($visits))
                                    @foreach($visits as $k => $v)
                                        <div 
                                            class="visit-item mb10" 
                                            style="border-left : 3px solid {{ __('messages.status')[$v->status]['code'] }}" 
                                            data-visit="{{ $v->id }}"
                                            data-status="{{ $v->status }}"
                                        >
                                            <h2 class="heading-1"> 
                                                Bệnh nhân : {{ $v->symptoms }} - {{ convertDateTime($v->created_at , 'H:i , d/m/Y') }} - ({{ $v->clinics->code }}) {{ $v->clinics->name }} - Khoa : {{ $v->departments->name }}
                                            </h2>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <div class="txt visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('reception.patient.component.modal')
@endsection