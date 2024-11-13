<form action="">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            @include('reception.component.perpage')
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @php
                        $publish = request('publish') ?: old('publish');
                    @endphp
                    <div class="uk-search uk-flex uk-flex-middle mr10">
                        <div class="input-group">
                            <input 
                                type="text" 
                                name="keyword" 
                                value="{{ request('keyword') ?: old('keyword') }}" 
                                placeholder="{{ __('messages.placeholder') }}" class="form-control"
                            >
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">{{ __('messages.search') }}
                                </button>
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('reception.patient.create') }}" class="btn btn-danger btn-new-wd"><i class="fa fa-plus mr5"></i>{{ __('messages.create_patient') }}</a>
                </div>
            </div>
        </div>
    </div>
</form>
