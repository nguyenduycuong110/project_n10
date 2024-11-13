@extends('frontend.homepage.layout')
@section('content')
    <div class="post-catalogue page-wrapper  system">
        @include('frontend.component.breadcrumb', ['model' => $postCatalogue, 'breadcrumb' => $breadcrumb])
        <div class="uk-container uk-container-center">
            <div class="project-container">
                <h1 class="heading-1"><span>{{ $postCatalogue->name }}</span></h1>
                <div class="system mb40">
                    <div class="uk-grid uk-grid-medium">
                        <div class="uk-width-medium-2-5">
                            <div class="sys-wr">
                                <form action="">
                                    <div class="sl-box">
                                        <div class="uk-grid uk-grid-medium">
                                            <div class="uk-width-medium-1-3">
                                                <div class="form-ip">
                                                    <select name="province_id" class="form-control nice-select province location" data-target="districts">
                                                        <option value="">Chọn Tỉnh</option>
                                                        @foreach($provinces as $key => $item)
                                                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-3">
                                                <div class="form-ip">
                                                    <select name="district_id" class="form-control districts nice-select location" data-target="wards">
                                                        <option value="0">Quận/Huyện</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-3">
                                                <a href="" class="btn-search">Tìm</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="system-lft">
                                        @if(isset($agency))
                                            <div class="list-system">
                                                @foreach($agency as $key => $val)
                                                    <div class="system-item">
                                                        <h2 class="heading-1">{{  $val->name }}</h2>
                                                        <div class="col">
                                                            <a href="">
                                                                <div class="icon">
                                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M7.50065 9.16667C7.50065 10.5474 8.61994 11.6667 10.0007 11.6667C11.3814 11.6667 12.5007 10.5474 12.5007 9.16667C12.5007 7.78595 11.3814 6.66667 10.0007 6.66667M10.0007 17.5C6.31875 15.8333 3.33398 12.8486 3.33398 9.16667C3.33398 5.48477 6.31875 2.5 10.0007 2.5C13.6825 2.5 16.6673 5.48477 16.6673 9.16667C16.6673 11.6211 15.3409 13.7658 13.3658 15.4167" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                </div>
                                                                {{ $val->address }}
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <a href="">
                                                                <div class="icon">
                                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.8554 17.4941C16.7269 17.5727 17.5031 16.8519 17.4995 15.9887V13.7306C17.5087 13.3614 17.3816 13.0018 17.1425 12.72C16.468 11.9255 14.1546 11.4173 13.2376 11.6125C12.5228 11.7646 12.0227 12.4824 11.5338 12.9703C10.6718 12.4812 9.8776 11.8902 9.16672 11.213M7.0085 8.45403C7.49742 7.96608 8.21656 7.46697 8.36901 6.75357C8.56427 5.83981 8.05678 3.54124 7.26776 2.86403C6.99024 2.62584 6.63539 2.49648 6.26937 2.50007H4.00676C3.14465 2.50088 2.4274 3.27412 2.50589 4.14099C2.50091 10.4563 6.66778 15.6399 12.5 17.0894" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                </div>
                                                                {{ $val->phone }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="uk-width-medium-3-5">
                            <div class="map-office">
                                {!! $system['contact_map'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-quote">
            <div class="uk-grid uk-grid-collapse">
                <div class="uk-width-medium-1-2">
                    <a href="" class="image img-cover">
                        <img src="{{ $system['background_5'] }}" alt="">
                    </a>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="quote">
                        <div class="text-content">
                            <div class="register">Đăng ký</div>
                            <div class="title">Nhận ngay</div>
                            <div class="news">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <div class="txt">Mức giá ưu đãi mới nhất</div>
                                    <div class="phone">
                                        <a href="tel:{{ $system['contact_hotline'] }}">Gọi ngay : {{ $system['contact_sell_phone'] }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-contact">
                            <form action="" class="frm-ct">
                                <div class="uk-grid uk-grid-medium">
                                    <div class="uk-width-medium-1-2">
                                        <div class="form-ip">
                                            <label for="">Họ và tên : <span>(*)</span> </label>
                                            <input type="text" name="name" class="form-row" placeholder="Nhập thông tin">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <div class="form-ip">
                                            <label for="">Nhập điện thoại : <span>(*)</span> </label>
                                            <input type="text" name="phone" class="form-row" placeholder="Nhập thông tin">
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-medium mb15">
                                    <div class="uk-width-medium-1-2">
                                        <div class="form-ip">
                                            <label for="">Email : <span>(*)</span> </label>
                                            <input type="text" name="email" class="form-row" placeholder="Nhập thông tin">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <div class="form-ip">
                                            <label for="">Dòng sản phẩm : <span>(*)</span> </label>
                                            <select name="content" class="form-control nice-select">
                                                <option value="">Chọn dòng sản phẩm</option>
                                                @foreach($products as $key => $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-ip mb20">
                                    <label for="">Nội dung : <span>(*)</span> </label>
                                    <textarea type="text" name="content" class="form-row" placeholder="Nhập thông tin"></textarea>
                                </div>
                                <a href="" class="btn-contact">
                                    Xác nhận
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

