@extends('consultation.component.layout')

@section('content')
    <form action="{{ route('consultation.patient.update',[$infoVisit->id]) }}" method="POST">
        @csrf
        <div class="row mt20 visit">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                            <h5>{{ __('messages.info_patient') }} </h5>
                            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="box ibox">
                                        <div class="ibox-content">
                                            <div class="row mb15">
                                                <div class="col-lg-3">
                                                    <div class="form-row">
                                                        <label for="" class="control-label text-left">Họ tên</label>
                                                        <input 
                                                            type="text"
                                                            value="{{ $infoVisit->patient_name }}"
                                                            class="form-control"
                                                            placeholder=""
                                                            autocomplete="off"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-row">
                                                        <label for="" class="control-label text-left">Tuổi </label>
                                                        <input 
                                                            type="text"
                                                            value="{{ $infoVisit->patient_birthday }}"
                                                            class="form-control"
                                                            placeholder=""
                                                            autocomplete="off"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-row">
                                                        <label for="" class="control-label text-left">Giới tính </label>
                                                        <input 
                                                            type="text"
                                                            value="{{ $infoVisit->patient_gender }}"
                                                            class="form-control"
                                                            placeholder=""
                                                            autocomplete="off"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-row">
                                                        <label for="" class="control-label text-left">Triệu chứng </label>
                                                        <input 
                                                            type="text"
                                                            value="{{ $infoVisit->symptoms }}"
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
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <h5>Dịch vụ khám </h5>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="search-model-box">
                                    <input type="hidden" name="patient_id" value="{{ $infoVisit->patient_id }}">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control search-model" placeholder="Tìm kiếm dịch vụ...">
                                    <div class="ajax-search-result"></div>
                                </div>
                                <div class="search-model-result"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <h5>Kê đơn thuốc </h5>
                                    <div class="text-right ">
                                        <button 
                                            class="btn-print" 
                                            type="submit" name="send" 
                                            value="send"
                                        >
                                            + In đơn thuốc
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="search-model-box">
                                    <input type="hidden" name="patient_id" value="{{ $infoVisit->patient_id }}">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control search-product" placeholder="Tìm kiếm thuốc...">
                                    <div class="ajax-search-product"></div>
                                </div>
                                <div class="search-model-product"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row mb20">
            <div class="col-lg-6">
                <div class="ibox-title">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <h5>Trạng thái phiếu khám</h5>
                    </div>
                </div>
                <div class="ibox-content check">
                    <div class="ip wizard-form-checkbox">
                        <input name="status" id="{{ config('apps.general.status_open') }}" type="checkbox" value="{{ config('apps.general.status_open') }}" checked>
                        <label for="{{ config('apps.general.status_open') }}" style="background: #f8ac59">Đang xử lý</label>
                    </div>
                    <div class="ip wizard-form-checkbox">
                        <input name="status" id="{{ config('apps.general.status_close') }}" type="checkbox" value="{{ config('apps.general.status_close') }}">
                        <label for="{{ config('apps.general.status_close') }}" style="background: #18a689;">Đã khám xong</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
