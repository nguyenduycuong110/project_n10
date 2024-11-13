<div class="product-item">
    @php
        $image = $product->image;
        $price = $product->price;
        $album = json_decode($product->album, true);
        $name = $product->languages->first()->pivot->name;
        $canonical = write_url($product->languages->first()->pivot->canonical);
    @endphp
    <div class="image-content">
        <a href="{{ $canonical }}" class="image img-cover mb10 img-zoomin">
            <img src="{{ $image }}" alt="">
        </a>
        <div class="ic-3 mb10">
            <div class="tg">
                <img src="{{ $system['background_3'] }}" alt="">
            </div>
            <div class="tg">
                <img src="{{ $system['background_4'] }}" alt="">
            </div>
            <div class="tg">
                <img src="{{ $system['background_5'] }}" alt="">
            </div>
            <div class="tg">
                <img src="{{ $system['background_6'] }}" alt="">
            </div>
        </div>
        <div class="ic-4">
            <div class="guarantee">
                <img src="{{ $system['background_7'] }}" alt="">
                <span>{{ $system['text_3'] }}</span>
            </div>
        </div>
        @if(isset($album))
            <div class="album">
                @foreach($album as $a => $b)
                    <a href="{{ $canonical }}" class="image img-scaledown">
                        <img src="{{ $b }}" alt="">
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="text-content">
        <h4 class="heading-3">
            <a href="">
                {{ $name }}
            </a>
        </h4>
        <div class="product-price">
            <div class="current-price">
                {{ convert_price($price, true) }} <span>đ</span>
            </div>
        </div>
    </div>
</div>