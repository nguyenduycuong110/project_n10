<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\UserServiceInterface  as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface  as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\PositionRepositoryInterface as PositionRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\DepartmentRepositoryInterface as DepartmentRepository;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;
    protected $positionRepository;
    protected $departmentRepository;
    protected $userCatalogueRepository;

    public function __construct(
        UserService $userService,
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository,
        PositionRepository $positionRepository,
        UserCatalogueRepository $userCatalogueRepository,
        DepartmentRepository $departmentRepository,
    ){
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'user.index');
        $users = $this->userService->paginate($request);
        $userCatalogues = $this->userCatalogueRepository->all();
        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'User'
        ];
        $config['seo'] = config('apps.user');
        $template = 'backend.user.user.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'users',
            'userCatalogues'
        ));
    }

    public function create(){
        $this->authorize('modules', 'user.create');
        $provinces = $this->provinceRepository->all();
        $positions = $this->positionRepository->all();
        $userCatalogues = $this->userCatalogueRepository->all();
        $departments = $this->departmentRepository->all();
        $config = $this->config();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
        $template = 'backend.user.user.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'positions',
            'userCatalogues',
            'departments'
        ));
    }

    public function store(StoreUserRequest $request){
        if($this->userService->create($request)){
            return redirect()->route('user.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'user.update');
        $user = $this->userRepository->findById($id);
        $positions = $this->positionRepository->all();
        $userCatalogues = $this->userCatalogueRepository->all();
        $departments = $this->departmentRepository->all();
        $provinces = $this->provinceRepository->all();
        $config = $this->config();
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $template = 'backend.user.user.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'positions',
            'user',
            'userCatalogues',
            'departments'
        ));
    }

    public function update($id, UpdateUserRequest $request){
        if($this->userService->update($id, $request)){
            return redirect()->route('user.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'user.destroy');
        $config['seo'] = config('apps.user');
        $user = $this->userRepository->findById($id);
        $template = 'backend.user.user.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'user',
            'config',
        ));
    }

    public function destroy($id){
        if($this->userService->destroy($id)){
            return redirect()->route('user.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                
            ]
        ];
    }

}
