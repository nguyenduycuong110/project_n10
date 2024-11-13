@extends('reception.component.layout')

@section('content')
    <div class="row mt20">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <h5>{{ __('messages.list_patient') }} </h5>
                    </div>
                </div>
                <div class="ibox-content">
                    @include('reception.component.filter')
                    @include('reception.component.table')
                </div>
            </div>
        </div>
    </div>
    
@endsection