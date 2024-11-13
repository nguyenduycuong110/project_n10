<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\VisitServiceInterface  as VisitService;
use App\Repositories\Interfaces\VisitRepositoryInterface  as VisitRepository;
use App\Http\Requests\Visit\StoreVisitRequest;
use App\Http\Requests\Visit\UpdateVisitRequest;

class VisitController extends Controller
{
    protected $visitService;
    protected $visitRepository;

    public function __construct(
        VisitService $visitService,
        VisitRepository $visitRepository
    ){
        $this->visitService = $visitService;
        $this->visitRepository = $visitRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'visit.index');

        $visits = $this->visitService->paginate($request);

        $config = $this->config();

        $template = 'backend.visit.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'visits',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'visit.create');

        $config = $this->config();

        $config['method'] = 'create';

        $template = 'backend.visit.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    public function store(StoreVisitRequest $request){
        if($this->visitService->create($request)){
            return redirect()->route('visit.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('visit.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'visit.update');

        $visit = $this->visitRepository->findById($id);

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.visit.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'visit',
        ));
    }

    public function update($id, UpdateVisitRequest $request){
        if($this->visitService->update($id, $request)){
            return redirect()->route('visit.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('visit.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'visit.destroy');

        $config = $this->config();
    
        $visit = $this->visitRepository->findById($id);

        $template = 'backend.visit.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'visit',
            'config',
        ));
    }

    public function destroy($id){
        if($this->visitService->destroy($id)){
            return redirect()->route('visit.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('visit.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function config(){
        return  [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'Visit',
            'seo' => __('messages.visit')
        ];
    }
    

}
