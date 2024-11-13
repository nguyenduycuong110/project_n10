<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\RoomServiceInterface  as RoomService;
use App\Repositories\Interfaces\RoomRepositoryInterface  as RoomRepository;
use App\Repositories\Interfaces\DepartmentRepositoryInterface  as DepartmentRepository;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;

class RoomController extends Controller
{
    protected $roomService;
    protected $roomRepository;
    protected $departmentRepository;

    public function __construct(
        RoomService $roomService,
        RoomRepository $roomRepository,
        DepartmentRepository $departmentRepository
    ){
        $this->roomService = $roomService;
        $this->roomRepository = $roomRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index(Request $request){

        $this->authorize('modules', 'room.index');

        $rooms = $this->roomService->paginate($request);

        $departments = $this->departmentRepository->all();

        $config = $this->config();

        $template = 'backend.room.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'rooms',
            'departments',
            'config'
        ));
    }

    public function create(){

        $this->authorize('modules', 'room.create');

        $departments = $this->departmentRepository->all();

        $config = $this->config();

        $config['method'] = 'create';

        $template = 'backend.room.store';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'departments'
        ));
    }

    public function store(StoreRoomRequest $request){
        if($this->roomService->create($request)){
            return redirect()->route('room.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('room.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){

        $this->authorize('modules', 'room.update');

        $room = $this->roomRepository->findById($id);

        $departments = $this->departmentRepository->all();

        $config = $this->config();

        $config['method'] = 'edit';

        $template = 'backend.room.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'departments',
            'config',
            'room',
        ));
    }

    public function update($id, UpdateRoomRequest $request){
        if($this->roomService->update($id, $request)){
            return redirect()->route('room.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('room.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){

        $this->authorize('modules', 'room.destroy');

        $config = $this->config();
    
        $room = $this->roomRepository->findById($id);

        $template = 'backend.room.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'room',
            'config',
        ));
    }

    public function destroy($id){
        if($this->roomService->destroy($id)){
            return redirect()->route('room.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('room.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
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
            'model' => 'Room',
            'seo' => __('messages.room')
        ];
    }
    

}
