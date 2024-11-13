@extends('frontend.homepage.layout')
@section('content')
    <div class="post-catalogue page-wrapper intro-wrapper" id="{{ $postCatalogue->canonical }}">
        @if(!empty($postCatalogue->image))
            <span class="image img-cover bg"><img src="{{ image($postCatalogue->image) }}" alt=""></span>
        @endif
        @include('frontend.component.breadcrumb', ['model' => $postCatalogue, 'breadcrumb' => $breadcrumb])
        <div class="uk-container uk-container-center pt30 pb30">
            <div class="post-container">
                <h1 class="heading-1"><span>{{ $postCatalogue->name }}</span></h1>
                @if(!is_null($posts))
                <div class="uk-grid uk-grid-small">
                    @foreach($posts as $key => $post)
                    @php
                        $name = $post->languages->first()->pivot->name;
                        $description = $post->languages->first()->pivot->description;
                        $image = image($post->image);
                        $canonical = write_url($post->languages->first()->pivot->canonical);
                    @endphp
                    <div class="uk-width-small-1-1 uk-width-small-1-4 mb20">
                        <div class="blog-item uk-clearfix">
                            <a href="{{ $canonical }}" class="image img-cover img-zoomin"><img src="{{ $image }}" alt="{{ $name }}"></a>
                            <div class="info">
                                <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
                                <div class="description">
                                    {!! $description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                @include('frontend.component.pagination', ['model' => $posts])
            </div>
        </div>

    </div>
@endsection

