<?php 
namespace App\Enums;


enum SlideEnum: string {
    
    const MAIN = 'main-slide';
    const BRAND = 'brand';
    const COMMIT = 'commit';
    public static function toArray(){
        return [
            self::MAIN => 'main-slide',
            self::BRAND => 'brand',
            self::COMMIT => 'commit',
        ];
    }

}