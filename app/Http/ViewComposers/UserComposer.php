<?php  
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserComposer
{

    public function __construct(
       
    ){
       
    }

    public function compose(View $view)
    {
        $user = Auth::guard('web')->user();
        $view->with('userAuth', $user);
    }


}