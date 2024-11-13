<?php   
return [
    'module' => [
        [
            'title' => 'Dashboard',
            'icon' => 'fa fa-database',
            'name' => ['dashboard'],
            'route' => 'dashboard/index',
            'class' => 'special'
        ],
        [
            'title' => 'QL Nhóm Nhân viên',
            'icon' => 'fa fa-user',
            'name' => ['user','permission'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Nhân viên',
                    'route' => 'user/catalogue/index'
                ],
                [
                    'title' => 'QL Nhân viên',
                    'route' => 'user/index'
                ],
                [
                    'title' => 'QL Chức vụ',
                    'route' => 'position/index'
                ],
                [
                    'title' => 'QL Quyền',
                    'route' => 'permission/index'
                ]
            ]
        ],
        [
            'title' => 'QL Bệnh nhân',
            'icon' => 'fa fa-instagram',
            'name' => ['patient'],
            'subModule' => [
                [
                    'title' => 'QL Bệnh nhân',
                    'route' => 'patient/index'
                ]
            ]
        ],
        [
            'title' => 'QL Phiếu khám Bệnh',
            'icon' => 'fa fa-github',
            'name' => ['visit'],
            'subModule' => [
                [
                    'title' => 'QL Phiếu khám Bệnh',
                    'route' => 'visit/index'
                ]
            ]
        ],
        [
            'title' => 'QL Khoa bệnh',
            'icon' => 'fa fa-database',
            'name' => ['department'],
            'subModule' => [
                [
                    'title' => 'QL Khoa bệnh',
                    'route' => 'department/index'
                ],
            ]
        ],
        [
            'title' => 'QL Phòng khám',
            'icon' => 'fa fa-instagram',
                'name' => ['clinic'],
                'subModule' => [
                    [
                        'title' => 'QL Phòng khám',
                        'route' => 'clinic/index'
                    ],
                ]
            ],
        [
            'title' => 'QL Phòng bệnh',
            'icon' => 'fa fa-github',
                'name' => ['room'],
                'subModule' => [
                    [
                        'title' => 'QL Phòng bệnh',
                        'route' => 'room/index'
                    ],
                ]
            ],
        [
            'title' => 'QL Giường bệnh',
            'icon' => 'fa fa-instagram',
            'name' => ['bed'],
            'subModule' => [
                [
                    'title' => 'QL Giường bệnh',
                    'route' => 'bed/index'
                ],
            ]
        ],
        [
            'title' => 'QL Dịch vụ khám',
            'icon' => 'fa fa-github',
            'name' => ['expense'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Dịch vụ',
                    'route' => 'expense/catalogue/index'
                ],
                [
                    'title' => 'QL Dịch vụ',
                    'route' => 'expense/index'
                ],
            ]
        ],
        [
            'title' => 'QL Sản phẩm',
            'icon' => 'fa fa-product-hunt',
            'name' => ['product'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Sản phẩm',
                    'route' => 'product/catalogue/index'
                ],
                [
                    'title' => 'QL Sản phẩm',
                    'route' => 'product/index'
                ],
            ]
        ],





























        // [
        //     'title' => 'QL Sản Phẩm',
        //     'icon' => 'fa fa-cube',
        //     'name' => ['product','attribute'],
        //     'subModule' => [
        //         [
        //             'title' => 'QL Nhóm Sản Phẩm',
        //             'route' => 'product/catalogue/index'
        //         ],
        //         [
        //             'title' => 'QL Sản phẩm',
        //             'route' => 'product/index'
        //         ],
        //         [
        //             'title' => 'QL Loại thuộc tính',
        //             'route' => 'attribute/catalogue/index'
        //         ],
        //         [
        //             'title' => 'QL thuộc tính',
        //             'route' => 'attribute/index'
        //         ],

        //     ]
        // ],
        // [
        //     'title' => 'QL Banner & Slide',
        //     'icon' => 'fa fa-picture-o',
        //     'name' => ['slide'],
        //     'subModule' => [
        //         [
        //             'title' => 'Cài đặt Slide',
        //             'route' => 'slide/index'
        //         ],
        //     ]
        // ],
        // [
        //     'title' => 'QL Menu',
        //     'icon' => 'fa fa-bars',
        //     'name' => ['menu'],
        //     'subModule' => [
        //         [
        //             'title' => 'Cài đặt Menu',
        //             'route' => 'menu/index'
        //         ],
        //     ]
        // ],
        // [
        //     'title' => 'Cấu hình chung',
        //     'icon' => 'fa fa-file',
        //     'name' => ['language', 'generate', 'system', 'widget'],
        //     'subModule' => [
        //         [
        //             'title' => 'QL Ngôn ngữ',
        //             'route' => 'language/index'
        //         ],
        //         [
        //             'title' => 'QL Module',
        //             'route' => 'generate/index'
        //         ],
        //         [
        //             'title' => 'Cấu hình hệ thống',
        //             'route' => 'system/index'
        //         ],
        //         [
        //             'title' => 'Quản lý Widget',
        //             'route' => 'widget/index'
        //         ],
                
        //     ]
        // ]
    ],
];
