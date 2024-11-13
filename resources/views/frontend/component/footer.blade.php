<footer class="footer">
    <div class="uk-container uk-container-center">
        <div class="footer-pc">
            <div class="uk-grid uk-grid-large">
                <div class="uk-width-medium-1-2">
                    <div class="ft-contact">
                        <a href="" class="image img-cover ft-logo">
                            <img src="{{ $system['homepage_logo'] }}" alt="">
                        </a>
                        <div class="ft-desc">
                            <span>{{ $system['homepage_company'] }}</span>
                        </div>
                        <div class="ft-info">
                            <div class="ft-info-1">
                                <div class="ft-info-label">{{ $system['text_1'] }}</div>
                                <div class="sh">
                                    <div class="showroom-it">
                                        <div class="ft-txt">Showroom 1 :</div>
                                        <ul class="uk-list">
                                            <li>
                                                <a href="">
                                                    <i class="fa fa-map-marker"></i>
                                                    {{  $system['contact_sh_1_hn'] }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <i class="fa fa-phone"></i>
                                                    Số điện thoại : {{  $system['contact_hotline_hn'] }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="showroom-it">
                                        <div class="ft-txt">Showroom 2 :</div>
                                        <ul class="uk-list">
                                            <li>
                                                <a href="">
                                                    <i class="fa fa-map-marker"></i>
                                                    {{  $system['contact_sh_2_hn'] }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <i class="fa fa-phone"></i>
                                                    Số điện thoại : {{  $system['contact_hotline_hn'] }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="ft-info-2">
                                <div class="ft-info-label">{{ $system['text_2'] }}</div>
                                <ul class="uk-list">
                                    <li>
                                        <a href="">
                                            <i class="fa fa-map-marker"></i>
                                            {{  $system['contact_sh_dn'] }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-phone"></i>
                                            Số điện thoại : {{  $system['contact_hotline_dn'] }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="wr">
                        <div class="uk-grid uk-grid-medium">
                            <div class="uk-width-medium-1-2">
                                <div class="ft-nav">
                                    <h2 class="heading-1">{{ $system['text_4'] }}</h2>
                                    <ul class="uk-list ft-mn">
                                        @if(isset($menu['menu-footer']))
                                            @foreach($menu['menu-footer'] as $key => $val)
                                                @php
                                                    $name = $val['item']->languages->first()->pivot->name;
                                                    $canonical = $val['item']->languages->first()->pivot->canonical;
                                                @endphp
                                                    <li><a href="{{ write_url($canonical) }}" title="{{ $name }}">{{ $name }}</a></li>
                                            @endforeach 
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="ft-nav">
                                    <h2 class="heading-1">{{ $system['text_5'] }}</h2>
                                    <ul class="uk-list ft-mn ft-sc">
                                        <li>
                                            <a href="" class="sc">
                                                <i class="fa fa-facebook"></i>
                                                Facebook
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="sc">
                                                <i class="fa fa-youtube-play"></i>
                                                Youtube
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="bg image img-zoomin">
                                        <img src="{{ $system['background_8'] }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ft-cer">
                            <div class="uk-flex">
                                <a href="" class="image img-zoomin">
                                    <img src="{{ $system['background_9'] }}" alt="">
                                </a>
                                <a href="" class="image img-zoomin">
                                    <img src="{{ $system['background_10'] }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="uk-container uk-container-center">
            <div class="txt">
                <p>{{ $system['homepage_copyright'] }}</p>
            </div>
        </div>
    </div>
</footer>
