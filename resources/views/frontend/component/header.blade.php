<div id="header" class="pc-header uk-visible-large uk-position-relative">
    <div class="header-upper">
        <div class="uk-container uk-container-center">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div class="contact-info">
                    <ul class="uk-list uk-flex uk-flex-middle uk-clearfix">
                        <li class="it">
                            <span>{{ $system['text_1'] }}</span> :
                            <a href="tel:{{ $system['contact_hotline_hn'] }}" class="hl">{{ $system['contact_hotline_hn'] }}</a>
                        </li>
                        <li class="it">
                            <span>{{ $system['text_2'] }}</span> :
                            <a href="tel:{{ $system['contact_hotline_dn'] }}" class="hl">{{ $system['contact_hotline_dn'] }}</a>
                        </li>
                    </ul>
                </div>
                <div class="contact-social">
                    <a href="{{ $system['social_zalo'] }}" class="zl">
                        <span>
                            <img src="/frontend/resources/img/zalo.webp" alt="">
                        </span>
                        Zalo
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-lower">
        <div class="uk-container uk-container-center">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <a href="" class="logo image img-cover">
                    <img src="{{ $system['homepage_logo'] }}" alt="">
                </a>
                @include('frontend.component.navigation')
                <div class="search">
                    <a href="#" class="txt-sr">
                        <div class="hd-link-icon">

                        </div>
                        <div class="hd-link-title">Tìm kiếm</div>
                    </a>
                    <div class="header-search hide">
                        <p>
                            Tìm kiếm
                            <span class="btnCloseSearch"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </p>
                        <div class="seach-form">
                            <form action="{{ write_url('tim-kiem') }}" class="fr">
                                <input type="text" name="keyword" class="ip-sr" placeholder="Tìm kiếm sản phẩm...">
                                <button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mobile-header uk-hidden-large">
    <div class="mobile-upper" data-uk-sticky>
        <div class="uk-container uk-container-center">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div class="mobile-logo">
                    <a href="." title="{{ $system['seo_meta_title'] }}">
                        <img src="{{ $system['homepage_logo'] }}" alt="Mobile Logo">
                    </a>
                </div>
                <div class="mobile-widget">
                    <div class="uk-flex uk-flex-middle">
                        <div class="btn-search">
                            <a href="" class="image img-cover">
                                <img src="https://khaihoanphuquoc.com.vn/template/images/svg/hd-search.svg" alt="">
                            </a>
                            <div class="header-form">
                                <form action="{{ write_url('tim-kiem') }}" class="form-search" method="">
                                    <div class="form-wrap">
                                        <div class="form-full">
                                            <input type="text" class="btn-search" placeholder="Nhập từ khóa...">
                                        </div>
                                        <div class="form-full"> 
                                            <button class="form-btn" type="submit">
                                                <img src="https://khaihoanphuquoc.com.vn/template/images/svg/hd-search.svg" alt="">
                                                Tìm kiếm
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="btn-menu">
                            <a href="#mobileCanvas" class="mobile-menu-button" data-uk-offcanvas>
                                <svg class="menu-svg" viewBox="0 0 100 100">
                                    <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
                                    </path>
                                    <path d="m 30,50 h 40"></path>
                                    <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<div id="mobileCanvas" class="uk-offcanvas offcanvas" >
    <div class="uk-offcanvas-bar" >
        @if(isset($menu['mobile']))
		<ul class="l1 uk-nav uk-nav-offcanvas uk-nav uk-nav-parent-icon" data-uk-nav>
			@foreach ($menu['mobile'] as $key => $val)
            @php
                $name = $val['item']->languages->first()->pivot->name;
                $canonical = ($val['item']->languages->first()->pivot->canonical) != '.' ?  write_url($val['item']->languages->first()->pivot->canonical, true, true) : '';
            @endphp
			<li class="l1 {{ (count($val['children']))?'uk-parent uk-position-relative':'' }}">
                <?php echo (isset($val['children']) && is_array($val['children']) && count($val['children']))?'<a href="#" title="" class="dropicon"></a>':''; ?>
				<a href="{{ $canonical }}" title="{{ $name }}" class="l1">{{ $name }}</a>
				@if(count($val['children']))
                    <ul class="l2 uk-nav-sub">
                        @foreach ($val['children'] as $keyItem => $valItem)
                        @php
                            $name_2 = $valItem['item']->languages->first()->pivot->name;
                            $canonical_2 = write_url($valItem['item']->languages->first()->pivot->canonical, true, true);
                        @endphp
                        <li class="l2">
                            <a href="{{ $canonical_2 }}" title="{{ $name_2 }}" class="l2">{{ $name_2 }}</a>
                        </li>
                        @endforeach
                    </ul>
				@endif
			</li>
			@endforeach
		</ul>
		@endif
	</div>
</div>