@extends('frontend.homepage.layout')

@section('content')
    <div id="homepage" class="homepage">
        @include('frontend.component.slide')
        <div class="bg-wr">
            @if(isset($widgets['category']))
                <div class="panel-category mb40">
                    <div class="uk-container uk-container-center">
                        <div class="uk-grid uk-grid-small">
                            @foreach ($widgets['category']->object as $key => $val)
                                <div class="uk-width-small-1-9 mb5">
                                    <div class="category-item">
                                        @php
                                            $image = $val->image;
                                            $name = $val->languages->first()->pivot->name;
                                            $canonical = write_url($val->languages->first()->pivot->canonical);
                                        @endphp
                                        <a href="{{ $canonical }}" class="image img-cover img-zoomin">
                                            <div class="cate-img">
                                                <img src="{{ $image }}" alt="">
                                            </div>
                                            <span>{{ $name }}</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($widgets['product-catalogue']))
               <div class="panel-product-catalogue">
                   <div class="uk-container uk-containe-center">
                        @foreach($widgets['product-catalogue']->object as $key => $val)
                            <div class="product-catalogue mb30">
                                @php
                                    $parentCanonical = write_url($val->languages->first()->pivot->canonical);
                                    $parentName = $val->languages->first()->pivot->name;
                                @endphp
                                <div class="panel-head">
                                    <h2 class="heading-1">
                                        <a href="{{ $parentCanonical }}">{{ $parentName }}</a>
                                    </h2>
                                    @if(isset($val->childrens))
                                        <ul class="uk-list uk-flex uk-flex-middile uk-clearfix">
                                            @foreach($val->childrens as $k => $v)
                                                @php
                                                    $catName = $v->languages->first()->pivot->name;
                                                    $catCanonical = write_url($v->languages->first()->pivot->canonical);
                                                @endphp
                                                <li>
                                                    <a href="{{ $catCanonical }}" class="" title="">{{ $catName }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                @if(isset($val->products))
                                    <div class="panel-body">
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">
                                                @foreach($val->products as $keyAttr => $valAttr)
                                                    <div class="swiper-slide">
                                                        @include('frontend.component.product-item', ['product'  => $valAttr])
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                   </div>
               </div>
            @endif
            @if(isset($widgets['construction']))
               <div class="panel-construction mb40">
                    <div class="uk-container uk-container-center">
                        <div class="wrapper">
                            <div class="panel-head">
                                @php
                                    $prName = $widgets['construction']->object->first()->languages->first()->pivot->name;
                                    $prCanonical = write_url($widgets['construction']->object->first()->languages->first()->pivot->canonical);
                                @endphp
                                <h2 class="heading-1">
                                    <a href="{{ $prCanonical }}" title="">{{ $prName  }}</a>
                                </h2>
                            </div>
                            @if(isset($widgets['construction']->object[0]))
                                <div class="panel-body">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            @foreach($widgets['construction']->object[0]->posts as $k => $v)
                                                <div class="swiper-slide">
                                                    @php
                                                        $image = $v->image;
                                                        $name = $v->languages->first()->pivot->name;
                                                        $canonical = write_url($v->languages->first()->pivot->canonical);
                                                    @endphp
                                                    <a href="{{ $canonical }}" class="construction-item">
                                                        <div class="thumb image img-cover img-zoomin">
                                                            <img src="{{ $image }}" alt="">
                                                        </div>
                                                        <h4 class="heading-3">{{ $name }}</h4>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
               </div>
            @endif
            @if(isset($widgets['introduce']))
                <div class="panel-introduce mb40">
                    <div class="uk-container uk-container-center">
                        <div class="panel-head">
                            <h2 class="heading-1">{{ $widgets['introduce']->name  }}</h2>
                        </div>
                        @if(isset($widgets['introduce']->object))
                            <div class="panel-body">
                                @php
                                    $content = $widgets['introduce']->object[0]->languages->first()->pivot->content;
                                @endphp
                                <div class="content">
                                    {!! $content !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            @php
                $slideKeyword = App\Enums\SlideEnum::BRAND;
            @endphp
            @if(count($slides[$slideKeyword]['item']))
                <div class="panel-brand">
                    <div class="uk-container uk-container-center">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($slides[$slideKeyword]['item'] as $key => $val)
                                    <div class="swiper-slide">
                                        <div class="brand-item">
                                            <a href="" class="image img-cover">
                                                <img src="{{ $val['image'] }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
