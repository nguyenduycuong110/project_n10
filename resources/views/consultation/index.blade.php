@extends('consultation.component.layout')

@section('content')
    <div class="row mt20">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <input type="hidden" name="clinic_id" value="{{ $infoClinic->clinic_id }}">
                        <h5>{{ __('messages.list_patient') }} - {{ $infoClinic->clinic_name }} - KHOA {{ $infoClinic->department_name }} </h5>
                    </div>
                </div>
                <div class="ibox-content">
                    @include('consultation.component.filter')
                    @include('consultation.component.table')
                </div>
            </div>
        </div>
    </div>
    
@endsection