<?php

namespace App\Http\ViewComposers\Crud;

use Illuminate\View\View;

class SearchComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $search = $view->paginateConfig->where('search', true);
        $searchDetails = $view->paginateConfig->whereNotNull('searchDetails')->pluck('searchDetails');
        $searchDetails = $searchDetails->sortBy('order');
        foreach ($searchDetails as $detail) {
            if (!empty($detail['composer'])) {
                $composer = \App::make($detail['composer']);
                $composer->compose($view);
            }
        }
        $view->with(compact('search', 'searchDetails'));
    }
}
