<?php  
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReceptionComposer
{

    public function __construct(
       
    ){
       
    }

    public function compose(View $view)
    {
        $reception = Auth::guard('reception')->user();
        $view->with('receptionAuth', $reception);
    }


}