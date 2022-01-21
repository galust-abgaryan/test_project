<?php

namespace App\Http\ViewComposers\Crud;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class PaginateComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $currentRouteName = $currentRouteName ?? Route::currentRouteName();
        $paginateConfig = $view->items->paginateConfig;
        $actions = $view->items->actions ?? [];
        $view->with(compact('currentRouteName', 'paginateConfig', 'actions'));
    }
}
