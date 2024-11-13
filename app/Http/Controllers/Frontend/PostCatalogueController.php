<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Services\Interfaces\WidgetServiceInterface as WidgetService;
use App\Services\Interfaces\SlideServiceInterface as SlideService;
use App\Repositories\Interfaces\ProductRepositoryInterface  as ProductRepository;
use App\Repositories\Interfaces\AgencyRepositoryInterface  as AgencyRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface  as ProvinceRepository;
use App\Models\System;
use App\Enums\SlideEnum;

class PostCatalogueController extends FrontendController
{
    protected $language;
    protected $system;
    protected $postCatalogueRepository;
    protected $provinceRepository;
    protected $postCatalogueService;
    protected $productRepository;
    protected $agencyRepository;
    protected $postService;
    protected $slideService;
    protected $widgetService;

    public function __construct(
        AgencyRepository $agencyRepository,
        ProvinceRepository $provinceRepository,
        ProductRepository $productRepository,
        PostCatalogueRepository $postCatalogueRepository,
        PostCatalogueService $postCatalogueService,
        PostService $postService,
        SlideService $slideService,
        WidgetService $widgetService,
    ){
        $this->agencyRepository = $agencyRepository;
        $this->provinceRepository = $provinceRepository;
        $this->productRepository = $productRepository;
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->postCatalogueService = $postCatalogueService;
        $this->postService = $postService;
        $this->slideService = $slideService;
        $this->widgetService = $widgetService;
        parent::__construct(); 
    }


    public function index($id, $request, $page = 1){
        $products = $this->productRepository->getAllProduct(1);
        $provinces = $this->provinceRepository->all();
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($id, $this->language);
        $breadcrumb = $this->postCatalogueRepository->breadcrumb($postCatalogue, $this->language);
        $posts = $this->postService->paginate(
            $request, 
            $this->language, 
            $postCatalogue, 
            $page,
            ['path' => $postCatalogue->canonical],
        );

        $widgets = $this->widgetService->getWidget([
            ['keyword' => 'post-catalogue-value', 'object' => true],
            ['keyword' => 'vision', 'object' => true],
            ['keyword' => 'post-catalogue-why', 'object' => true],
            ['keyword' => 'staff', 'object' => true],
            ['keyword' => 'home-project-done', 'object' => true],
            ['keyword' => 'achivement', 'object' => true],
            ['keyword' => 'orientation', 'object' => true],
        ], $this->language);

        $slides = $this->slideService->getSlide(
            [ SlideEnum::MAIN,  'banner'], $this->language);

        if($postCatalogue->canonical == 'gioi-thieu'){
            $template = 'frontend.post.catalogue.intro';
        }else if($postCatalogue->canonical == 'he-thong-cua-hang'){
            $template = 'frontend.post.catalogue.system';
        }else{
            $template = 'frontend.post.catalogue.index';
        }

        $config = $this->config();
        $system = $this->system;
        $seo = seo($postCatalogue, $page);
        return view($template, compact(
            'config',
            'seo',
            'system',
            'breadcrumb',
            'postCatalogue',
            'posts',
            'widgets',
            'slides',
            'products',
            'provinces'
        ));
    }


   

    private function config(){
        return [
            'language' => $this->language,
            'js' => [
                'backend/library/location.js'
            ]
        ];
    }

}
