@if(!is_null($asidePost))
<aside class="aside">
    <div class="aside-news">
        <div class="aside-heading">Bài viết gần đây</div>
        <div class="aside-body">
            @foreach($asidePost as $key => $post)
                @php 
                    $name = $post->languages->first()->pivot->name;
                    $description = $post->languages->first()->pivot->description;
                    $canonical = write_url($post->languages->first()->pivot->canonical);
                    $image = image($post->image);
                    $time = convertDateTime($post->created_at, 'd/m/Y');
                    if($key > 10) break;
                @endphp
                <div class="aside-post-item uk-clearfix">
                    <a href="{{ $canonical }}" class="image img-cover"><img src="{{ $image }}" alt="{{ $name }}"></a>
                    <div class="info">
                        <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
                        <div class="time">
                            <i class="fa fa-calendar"></i>
                            {{ $time }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</aside>
@endif