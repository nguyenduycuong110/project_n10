<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PositionServiceInterface  as PositionService;
use App\Repositories\Interfaces\PositionRepositoryInterface  as PositionRepository;
use App\Http\Requests\Position\StorePositionRequest;
use App\Http\Requests\Position\UpdatePositionRequest;

class PositionController extends Controller
{
    protected $positionService;
    protected $positionRepository;

    public function __construct(
        PositionService $positionService,
        PositionRepository $positionRepository
    ){
        $this->positionService = $positionService;
        $this->positionRepository = $positionRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'position.index');

        $positions = $this->positionService->paginate($request);

        $config = $this->config();

        $template = 'backend.position.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'positions',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'position.create');

        $config = $this->config();

        $config['method'] = 'create';

        $template = 'backend.position.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    public function store(StorePositionRequest $request){
        if($this->positionService->create($request)){
            return redirect()->route('position.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('position.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'position.update');

        $position = $this->positionRepository->findById($id);

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.position.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'position',
        ));
    }

    public function update($id, UpdatePositionRequest $request){
        if($this->positionService->update($id, $request)){
            return redirect()->route('position.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('position.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'position.destroy');

        $config = $this->config();
    
        $position = $this->positionRepository->findById($id);

        $template = 'backend.position.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'position',
            'config',
        ));
    }

    public function destroy($id){
        if($this->positionService->destroy($id)){
            return redirect()->route('position.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('position.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
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
            'model' => 'Position',
            'seo' => __('messages.position')
        ];
    }
    

}
