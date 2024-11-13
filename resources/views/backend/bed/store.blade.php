@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
@include('backend.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('bed.store') : route('bed.update', $bed->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12 mb15">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Tên giường bệnh <span class="text-danger">(*)</span></label>
                                            <input 
                                                type="text"
                                                name="name"
                                                value="{{ old('name', ($bed->name) ?? '' ) }}"
                                                class="form-control"
                                                placeholder=""
                                                autocomplete="off"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb15">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Mã giường bệnh </label>
                                            <div class="code">
                                                <input 
                                                    type="text"
                                                    name="code"
                                                    value="{{ old('code', ($bed->code) ?? '' ) }}"
                                                    class="form-control"
                                                    placeholder=""
                                                    autocomplete="off"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12 mb15">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Phòng<span class="text-danger">(*)</span></label>
                                            @if(isset($rooms))
                                                <select name="room_id" id="" class="setupSelect2 form-control">
                                                    <option value="0">Chọn phòng</option>
                                                    @foreach($rooms as $key => $val)
                                                        <option 
                                                            value="{{ $val->id }}"
                                                            {{ 
                                                                $val->id == old('room_id', (isset($bed->room_id)) ? $bed->room_id : '') ? 'selected' : '' 
                                                            }}
                                                        >
                                                            {{ $val->name }} - Khoa {{ $val->department_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox w">
                    <div class="ibox-title">
                        <h5>Chọn tình trạng</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-row color-box">
                                    @if(__('messages.status_room'))
                                        @foreach(__('messages.status_room') as $k => $v)
                                            <div class="wizard-form-checkbox">
                                                <input 
                                                    id="{{ $v['id'] }}" 
                                                    name="publish" 
                                                    type="checkbox" 
                                                    value="{{ $v['id'] }}" 
                                                    {{ (old('publish') == $v['id']) ? 'checked' : '' }} 
                                                    @if(isset($bed))
                                                        {{ $bed->publish  == $v['id'] ? 'checked' : '' }} 
                                                    @endif
                                                >
                                                <label 
                                                    data-id="{{ $v['id'] }}" 
                                                    for="{{ $v['id'] }}" 
                                                    class="color {{ isset($bed) && __('messages.status_room')[$bed->publish]['id'] == $v['id'] ? 'active' : '' }}" 
                                                    style="background: {{ $v['code'] }}"
                                                >
                                                    {{ $v['name'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>
