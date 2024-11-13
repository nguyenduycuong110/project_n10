<div id="modalProblem" class="modal fade">
    <form action="" class="form create-menu-catalogue" method="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Nội dung vấn đề</h4>
                </div>
                <div class="modal-body">
                    <div class="form-error text-success"></div>
                    <div class="row">
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="col-lg-12 mb10">
                            <textarea type="text" class="form-control h100" value="" name="symptoms" placeholder="Nội dung vấn đề"></textarea>
                            <div class="error symptoms"></div>
                        </div>
                        <div class="col-lg-12 mb10">
                            <select name="department_id" id="" class="form-control sl-department">
                                <option value="0">Chọn khoa</option>
                                @if(isset($departments))
                                    @foreach($departments as $k => $v)
                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="error department_id"></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="list-clinic">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" name="create" value="create" class="btn btn-primary btn-visit">Lưu lại</button>
                </div>
            </div>
        </div>
    </form>
</div>
