@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
@include('backend.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('room.store') : route('room.update', $room->id);
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
                                            <label for="" class="control-label text-left">Tên phòng <span class="text-danger">(*)</span></label>
                                            <input 
                                                type="text"
                                                name="name"
                                                value="{{ old('name', ($room->name) ?? '' ) }}"
                                                class="form-control"
                                                placeholder=""
                                                autocomplete="off"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb15">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Mã phòng</label>
                                            <div class="code">
                                                <input 
                                                    type="text"
                                                    name="code"
                                                    value="{{ old('code', ($room->code) ?? '' ) }}"
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
                                            <label for="" class="control-label text-left">Khoa<span class="text-danger">(*)</span></label>
                                            @if(isset($departments))
                                                <select name="department_id" id="" class="setupSelect2 form-control">
                                                    <option value="0">Chọn khoa</option>
                                                    @foreach($departments as $key => $val)
                                                        <option 
                                                            value="{{ $val->id }}"
                                                            {{ 
                                                                $val->id == old('department_id', (isset($room->department_id)) ? $room->department_id : '') ? 'selected' : '' 
                                                            }}
                                                        >
                                                            {{ $val->name }}
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
                                                    @if(isset($room))
                                                        {{ $room->publish  == $v['id'] ? 'checked' : '' }} 
                                                    @endif
                                                >
                                                <label 
                                                    data-id="{{ $v['id'] }}" 
                                                    for="{{ $v['id'] }}" 
                                                    class="color {{ isset($room) && __('messages.status_room')[$room->publish]['id'] == $v['id'] ? 'active' : '' }}" 
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
