@php
    $slideKeyword = App\Enums\SlideEnum::MAIN;
@endphp
@if(count($slides[$slideKeyword]['item']))
    <div class="panel-slide page-setup mb10" data-setting="{{ json_encode($slides[$slideKeyword]['setting']) }}">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($slides[$slideKeyword]['item'] as $key => $val )
                    <div class="swiper-slide">
                        <div class="slide-item">
                            <a class="image img-cover"><img src="{{ $val['image'] }}" alt="{{ $val['name'] }}"></a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class="swiper-pagination"></div> --}}
        </div>
    </div>
@endif