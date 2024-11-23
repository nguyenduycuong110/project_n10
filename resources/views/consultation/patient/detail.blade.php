@extends('consultation.component.layout')

@section('content')
    <div class="row mt20 visit">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <h5>{{ __('messages.info_patient') }} </h5>
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
                                                        name="name"
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
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins bl">
                        <div class="ibox-title">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <h5>Dịch vụ khám </h5>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="search-model-box">
                                <input type="hidden" name="patient_id" value="{{ $infoVisit->patient_id }}">
                                <i class="fa fa-search"></i>
                                <input type="text" class="form-control search-model" placeholder="Tìm kiếm dịch vụ...">
                                <div class="ajax-search-result"></div>
                            </div>
                            <div class="search-model-result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
