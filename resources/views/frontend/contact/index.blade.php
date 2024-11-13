@extends('frontend.homepage.layout')
@section('content')
    <div class="contact-page">
        <div class="page-breadcrumb background">      
            <div class="uk-container uk-container-center">
                <ul class="uk-list uk-clearfix">
                    <li><a href="/"><i class="fi-rs-home mr5"></i>{{ __('frontend.home') }}</a></li>
                    <li><a href="{{ route('distribution.list.index') }}" title="Hệ thống phân phối">Liên Hệ</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

