@extends('frontend.homepage.layout')
@section('content')
    <div class="product-catalogue page-wrapper pd-cl">
        @include('frontend.component.breadcrumb', ['model' => $productCatalogue, 'breadcrumb' => $breadcrumb])
        <div class="uk-container uk-container-center mt20">
            <div class="panel-head">
                <h1 class="heading-2"><span>{{ $productCatalogue->languages->first()->pivot->name }}</span></h1>
            </div>
            <a href="" class="bg image img-cover mb30 img-zoomin">
                <img src="{{  $system['background_11'] }}" alt="">
            </a>
            <div class="btn mb30">
                <a href="tel:{{ $system['contact_hotline_hn'] }}" class="btn-sp">{{ $system['text_7'] }}</a>
                <a href="" class="btn-sp" target="_blank">{{ $system['text_8'] }}</a>
            </div>
            @if(isset($widgets['products-hl'])) 
                <div class="panel-best-seller mb30 ">
                    <div class="panel-head mb20">
                        <h2 class="heading-1">{{ $widgets['products-hl']->name }}</h2>
                    </div>
                    @if(isset($widgets['products-hl']->object))
                        <div class="panel-body">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($widgets['products-hl']->object as $k => $v)
                                        <div class="swiper-slide">
                                            @include('frontend.component.product-item', ['product'  => $v])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            <div class="panel-body">
                <div class="wrapper ">
                    @if(!is_null($products))
                        <div class="product-list mb40">
                            <div class="uk-grid uk-grid-small">
                                @foreach($products as $product)
                                    <div class="uk-width-1-2 uk-width-small-1-2  uk-width-small-1-5 mb5">
                                        @include('frontend.component.product-item', ['product'  => $product])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="uk-flex uk-flex-center">
                            @include('frontend.component.pagination', ['model' => $products])
                        </div>
                    @endif
                    @if(!empty($productCatalogue->languages->first()->pivot->content))
                        <div class="product-catalogue-content">
                            <h2 class="heading-1">{{ $system['text_6'] }}</h2>
                            {!! $productCatalogue->languages->first()->pivot->content !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

