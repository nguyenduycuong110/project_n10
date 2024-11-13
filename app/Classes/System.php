<?php
namespace App\Classes;

class System{

    public function config(){
        $data['homepage'] = [
            'label' => 'Thông tin chung',
            'description' => 'Cài đặt đầy đủ thông tin chung của website. Tên thương hiệu hiệu website, Logo, Favicon, vv...',
            'value' => [
                'company' => ['type' => 'text', 'label' => 'Tên công ty'],
                'brand' => ['type' => 'text', 'label' => 'Tên thương hiệu'],
                'slogan' => ['type' => 'text', 'label' => 'Slogan'],
                'logo' => ['type' => 'images', 'label' => 'Logo Website', 'title' => 'Click vào ô phía dưới để tải logo'],
                'logo_footer' => ['type' => 'images', 'label' => 'Logo chân trang', 'title' => 'Click vào ô phía dưới để tải logo'],
                'favicon' => ['type' => 'images', 'label' => 'Favicon', 'title' => 'Click vào ô phía dưới để tải logo'],
                'copyright' => ['type' => 'text', 'label' => 'Copyright'],
                'website' => [
                    'type' => 'select', 
                    'label' => 'Tình trạng website',
                    'option' => [
                        'open' => 'Mở cửa website',
                        'close' => 'Website đang bảo trì'
                    ]
                ],
                'short_intro' => ['type' => 'editor', 'label' => 'Giới thiệu ngắn'],
            ]
        ];

        $data['contact'] = [
            'label' => 'Thông tin liên hệ',
            'description' => 'Cài đặt thông tin liên hệ của website ví dụ: Địa chỉ công ty, Văn phòng giao dịch, Hotline, Bản đồ, vv...',
            'value' => [
                'office' => ['type' => 'text', 'label' => 'Địa chỉ công ty'],
                // 'hotline' => ['type' => 'text', 'label' => 'Hotline'],
                'hotline_hn' => ['type' => 'text', 'label' => 'Hotline Showroom Hà Nội'],
                'sh_1_hn' => ['type' => 'text', 'label' => 'Showroom 1 Hà Nội'],
                'sh_2_hn' => ['type' => 'text', 'label' => 'Showroom 2 Hà Nội'],
                'hotline_dn' => ['type' => 'text', 'label' => 'Hotline Showroom Đà Nẵng'],
                'sh_dn' => ['type' => 'text', 'label' => 'Showroom Đà Nẵng'],
                'technical_phone' => ['type' => 'text', 'label' => 'Hotline kỹ thuật'],
                'sell_phone' => ['type' => 'text', 'label' => 'Hotline kinh doanh'],
                'phone' => ['type' => 'text', 'label' => 'Số cố định'],
                'fax' => ['type' => 'text', 'label' => 'Fax'],
                'time' => ['type' => 'text', 'label' => 'Thời gian hoạt động'],
                'email' => ['type' => 'text', 'label' => 'Email'],
                'tax' => ['type' => 'text', 'label' => 'Mã số thuế'],
                'website' => ['type' => 'text', 'label' => 'Website'],
                'map' => [
                    'type' => 'textarea', 
                    'label' => 'Bản đồ', 
                    'link' => [
                        'text' => 'Hướng dẫn thiết lập bản đồ',
                        'href' => 'https://manhan.vn/hoc-website-nang-cao/huong-dan-nhung-ban-do-vao-website/',
                        'target' => '_blank'
                    ]
                ],
            ]
        ];

        $data['seo'] = [
            'label' => 'Cấu hình SEO dành cho trang chủ',
            'description' => 'Cài đặt đầy đủ thông tin về SEO của trang chủ website. Bao gồm tiêu đề SEO, Từ Khóa SEO, Mô Tả SEO, Meta images',
            'value' => [
                'meta_title' => ['type' => 'text', 'label' => 'Tiêu đề SEO'],
                'meta_keyword' => ['type' => 'text', 'label' => 'Từ khóa SEO'],
                'meta_description' => ['type' => 'textarea', 'label' => 'Mô tả SEO'],
                'meta_images' => ['type' => 'images', 'label' => 'Ảnh SEO'],
            ]
        ];

        $data['social'] = [
            'label' => 'Cấu hình Mạng xã hội dành cho trang chủ',
            'description' => 'Cài đặt đầy đủ thông tin về Mạng xã hội của trang chủ website. Bao gồm tiêu đề Mạng xã hội, Từ Khóa SEO, Mô Tả SEO, Meta images',
            'value' => [
                'zalo' => ['type' => 'text', 'label' => 'Zalo'],
                'facebook' => ['type' => 'text', 'label' => 'Facebook'],
                'youtube' => ['type' => 'text', 'label' => 'Youtube'],
                'twitter' => ['type' => 'text', 'label' => 'Twitter'],
                'tiktok' => ['type' => 'text', 'label' => 'Tiktok'],
                'instagram' => ['type' => 'text', 'label' => 'Instagram'],
            ]
        ];

        $data['background'] = [
            'label' => 'Cấu hình background',
            'description' => 'Cài đặt đầy đủ Background',
            'value' => [
                '1' => ['type' => 'images', 'label' => 'Background_1'],
                '2' => ['type' => 'images', 'label' => 'Background_2'],
                '3' => ['type' => 'images', 'label' => 'Background_3'],
                '4' => ['type' => 'images', 'label' => 'Background_4'],
                '5' => ['type' => 'images', 'label' => 'Background_5'],
                '6' => ['type' => 'images', 'label' => 'Background_6'],
                '7' => ['type' => 'images', 'label' => 'Background_7'],
                '8' => ['type' => 'images', 'label' => 'Background_8'],
                '9' => ['type' => 'images', 'label' => 'Background_9'],
                '10' => ['type' => 'images', 'label' => 'Background_10'],
                '11' => ['type' => 'images', 'label' => 'Background_11'],
            ]
        ];

        $data['text'] = [
            'label' => 'Cấu hình background',
            'description' => 'Cài đặt đầy đủ Background',
            'value' => [
                '1' => ['type' => 'text', 'label' => 'Text_1'],
                '2' => ['type' => 'text', 'label' => 'Text_2'],
                '3' => ['type' => 'text', 'label' => 'Text_3'],
                '4' => ['type' => 'text', 'label' => 'Text_4'],
                '5' => ['type' => 'text', 'label' => 'Text_5'],
                '6' => ['type' => 'text', 'label' => 'Text_6'],
                '7' => ['type' => 'text', 'label' => 'Text_7'],
                '8' => ['type' => 'text', 'label' => 'Text_8'],
                '9' => ['type' => 'text', 'label' => 'Text_9'],
                '10' => ['type' => 'text', 'label' => 'Text_10'],
                '11' => ['type' => 'text', 'label' => 'Text_11'],
            ]
        ];


        return $data;
    }
	
}
