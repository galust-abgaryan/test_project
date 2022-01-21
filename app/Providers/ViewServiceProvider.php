<?php

namespace App\Providers;

use App\Http\ViewComposers\Crud\PaginateComposer;
use App\Http\ViewComposers\Crud\SearchComposer;
use App\Http\ViewComposers\UserFormComposer;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootForms();
        $this->bootWeb();
    }

    /**
     *
     */
    public function bootWeb()
    {
        View::composer('partials.crud.paginateable', PaginateComposer::class);
        View::composer('partials.crud.search', SearchComposer::class);
        View::composer('web.users.partials.form', UserFormComposer::class);
    }

    /**
     *
     */
    protected function bootForms()
    {
        \Form::component('bsFile', 'components.forms.file', ['name', 'options' => []]);
        \Form::component('bsCheckbox', 'components.forms.checkbox', ['name', 'value' => 1, 'checked' => null, 'options' => []]);
        \Form::component('bsDate', 'components.forms.date', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('bsDatetime', 'components.forms.datetime', ['name', 'value' => null, 'options' => []]);
        \Form::component('bsText', 'components.forms.text', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('bsTextarea', 'components.forms.textarea', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('bsSubmit', 'components.forms.submit', ['value' => null, 'options' => []]);

        \Form::component(
            'bsSelect',
            'components.forms.select',
            [
                'name',
                'list' => [],
                'selected' => null,
                'selectAttributes' => [],
                'optionsAttributes' => [],
                'optgroupsAttributes' => []
            ]
        );
    }
}
