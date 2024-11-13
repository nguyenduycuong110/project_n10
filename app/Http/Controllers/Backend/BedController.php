<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\BedServiceInterface  as BedService;
use App\Repositories\Interfaces\BedRepositoryInterface  as BedRepository;
use App\Repositories\Interfaces\RoomRepositoryInterface  as RoomRepository;
use App\Http\Requests\Bed\StoreBedRequest;
use App\Http\Requests\Bed\UpdateBedRequest;

class BedController extends Controller
{
    protected $bedService;
    protected $bedRepository;
    protected $roomRepository;

    public function __construct(
        BedService $bedService,
        BedRepository $bedRepository,
        RoomRepository $roomRepository
    ){
        $this->bedService = $bedService;
        $this->bedRepository = $bedRepository;
        $this->roomRepository = $roomRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'bed.index');

        $beds = $this->bedService->paginate($request);

        $rooms = $this->roomRepository->getAllRoom();

        $config = $this->config();

        $template = 'backend.bed.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'beds',
            'rooms',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'bed.create');

        $config = $this->config();

        $rooms = $this->roomRepository->getAllRoom();

        $config['method'] = 'create';

        $template = 'backend.bed.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'rooms'
        ));
    }

    public function store(StoreBedRequest $request){
        if($this->bedService->create($request)){
            return redirect()->route('bed.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('bed.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'bed.update');

        $bed = $this->bedRepository->findById($id);

        $rooms = $this->roomRepository->getAllRoom();

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.bed.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'bed',
            'rooms'
        ));
    }

    public function update($id, UpdateBedRequest $request){
        if($this->bedService->update($id, $request)){
            return redirect()->route('bed.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('bed.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'bed.destroy');

        $config = $this->config();
    
        $bed = $this->bedRepository->findById($id);

        $template = 'backend.bed.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'bed',
            'config',
        ));
    }

    public function destroy($id){
        if($this->bedService->destroy($id)){
            return redirect()->route('bed.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('bed.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function config(){
        return  [
            'js' => [
                'backend/library/finder.js',
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'Bed',
            'seo' => __('messages.bed')
        ];
    }
    

}
